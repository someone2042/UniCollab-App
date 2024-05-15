<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    //
    public function index(Group $group)
    {
        if (auth()->user()->id == $group->leader_id) {
            $taskscount = $group->tasks->where('status', 'submitted')->count();
        } else {
            $taskscount = auth()->user()->tasks->where('group_id', $group->id)->where('status', 'assigned')->count();
        }
        $userid = auth()->user()->id;
        $mescount = [];
        foreach ($group->members as $member) {
            $mescount[$member->id] = Message::where('sender_id', $member->id)
                ->where('receiver_id', $userid)->where('seen', false)->count();
        }
        return view('gemini.index', [
            'groups' => auth()->user()->memberships,
            'mainGroup' => $group,
            'members' => $group->members,
            'invitaion_count' => count($group->invitedBy),
            'messages' => $group->groupmessages,
            'taskcount' => $taskscount, 'mescount' => $mescount
        ]);
    }
    public function send(Request $request)
    {
        $apiKey = env('GOOGLE_API_KEY', ''); // Replace with your actual API key
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key=$apiKey";

        $requestData = [
            "contents" => [
                [
                    "role" => "user",
                    "parts" => [
                        [
                            "text" => "$request->content"
                        ]
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 1,
                "topK" => 64,
                "topP" => 0.95,
                "maxOutputTokens" => 8192,
                "stopSequences" => []
            ],
            "safetySettings" => [
                [
                    "category" => "HARM_CATEGORY_HARASSMENT",
                    "threshold" => "BLOCK_NONE"
                ],
                [
                    "category" => "HARM_CATEGORY_HATE_SPEECH",
                    "threshold" => "BLOCK_NONE"
                ],
                [
                    "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                    "threshold" => "BLOCK_NONE"
                ],
                [
                    "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                    "threshold" => "BLOCK_NONE"
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($apiUrl, $requestData);

        if ($response->successful()) {
            // Request was successful
            $responseData = $response->json();
            // Process the response from Gemini API
            return response()->json(['responseData' => $responseData]);
            // dd($responseData);
        } else {
            // Handle errors (e.g., log, display message)
            Log::error('Gemini API request failed: ' . $response->status());
            // dd($response);
        }
    }
}
