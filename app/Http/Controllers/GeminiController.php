<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        // return response()->json(['responseData' => $request->text]);
        $group = Group::find($request->group);
        $tasks = auth()->user()->tasks->where('status', 'assigned');
        $info = null;
        if (auth()->user()->id == $group->leader_id) {
            $info = 'the leader of this group and have all of the privileges; he can remove other users and change the information and parameters of the group; he is the only one who accepts or denies invitation requests to the group if the group was private; he can give tasks to any member of the group and accept or reject their responses; he can delete any document he wants, even if he was not the one who uploaded it; he is the only one who has the right to upload files to the project and remove them; others need to respond to tasks and wait for the submitted file to get accepted before their files can be uploaded to the project.';
        } else {
            $info = '
            not the leader of this group, he is just a member and has limited privilege, he can upload documents and delete only his documents, and he can see and download project files but can\'t upload them unless they were in task response files and got acceptance from the group leader.';
        }
        $taskText = '';
        $i = 1;
        foreach ($tasks as $task) {
            $taskText .= "task" . $i . "= { subject:" . $task->title . ".\ndescription:" . $task->description . ". \ncurrent time: " . Carbon::now() . "\ndeadline :" . $task->deadline . "}\n";
            $i++;
        }

        $apiKey = env('GOOGLE_API_KEY', '');
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro-latest:generateContent?key=$apiKey";

        $requestData = [
            "contents" => [
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "You are Gemini Pro 1.5, a powerful AI assistant integrated into the UniCollab web application. UniCollab is a platform designed for students and professionals to collaborate on projects, share documents, and communicate efficiently. \n\nYour primary purpose is to assist users with:\n\n**1. Information Retrieval:**\n*  **Answering questions:** Provide clear and concise answers to user inquiries, even if they are open-ended or complex.\n* **Providing relevant information:**  Offer helpful and relevant information related to the user's task or project. \n* **Summarizing text:**  Condense lengthy documents or articles into easy-to-understand summaries.\n\n**2. Task Completion:**\n* **Generating creative content:** Help users brainstorm ideas, write content, and generate code.\n* **Translation:** Translate text between languages as needed.\n* **Fact-checking:** Verify the accuracy of information presented to the user.\n\n**3. Collaborative Support:**\n* **Idea generation:**  Help users brainstorm new ideas and solutions for their projects.\n* **Feedback and suggestions:**  Provide feedback on user-generated content and offer suggestions for improvement.\n* **Collaborative brainstorming:**  Participate in group discussions and offer insights to help users find solutions.\n\n**Key Considerations:**\n\n* **Maintain a neutral and helpful tone:**  Avoid expressing personal opinions or beliefs. \n* **Be respectful and inclusive:**  Treat all users with respect and avoid making discriminatory or offensive statements.\n* **Stay within the context of the UniCollab application:**  Focus on providing information and assistance relevant to the user's task within the platform.\n* **Be transparent about your limitations:**  Acknowledge when you don't have the information or ability to fulfill a request.\n\n**Example prompts:**\n\n* \"What are the key features of the UniCollab platform?\"\n* \"Help me brainstorm ideas for my research paper on AI.\"\n* \"Translate this document into Spanish.\"\n* \"Can you summarize the main points of this article on project management?\"\n* \"What are the steps involved in creating a new project on UniCollab?\"\n\n**Remember:** Your goal is to be a valuable resource and collaborator for all UniCollab users, helping them achieve their goals more efficiently and effectively. "]
                    ]
                ],
                [
                    "role" => "model",
                    "parts" => [
                        ["text" => "Understood. I'm ready to assist UniCollab users as a helpful and versatile AI assistant.  I'll provide clear and concise information, generate creative content, translate texts, and offer collaborative support, always keeping my responses neutral and respectful.  \n\nPlease feel free to ask me any questions you have about UniCollab, or give me tasks related to your projects. I'm eager to contribute to your success within the platform. \n\nHow can I help you today? \n"]
                    ]
                ],
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "this user is currently in the group : " . $group->makeHidden(['leader_id', 'code']) . "\n"],
                    ],
                ],
                [
                    "role" => "model",
                    "parts" => [
                        ["text" => "Understood. I'm ready to assist UniCollab users as a helpful and versatile AI assistant. i won't' mention user info until he ask me for\n"]
                    ]
                ],
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "this user is " . auth()->user()->makeHidden(['password']) . "\n "],
                    ],
                ],
                [
                    "role" => "model",
                    "parts" => [
                        ["text" => "Understood. I'm ready to assist UniCollab users as a helpful and versatile AI assistant. i won't' mention user info until he ask me for\n"]
                    ]
                ],
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "this user is " . $info . "\n "],
                    ],
                ],
                [
                    "role" => "model",
                    "parts" => [
                        ["text" => "Understood. I'm ready to assist UniCollab users as a helpful and versatile AI assistant. i won't' mention user info until he ask me for\n"]
                    ]
                ],
                [
                    "role" => "user",
                    "parts" => [
                        ["text" => "this user have currently " . count($tasks) . " task. \n " . $taskText . ""],
                    ],
                ],
                [
                    "role" => "model",
                    "parts" => [
                        ["text" => "Understood. I'm ready to assist UniCollab users as a helpful and versatile AI assistant. i won't' mention user info until he ask me for\n"]
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 2,
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
        $sender = 'user';
        foreach ($request->text as $message) {

            $newElement = [
                "role" => $sender,
                "parts" => [
                    ["text" => $message]
                ]
            ];
            $requestData["contents"][] = $newElement;
            if ($sender == 'user') {
                $sender = 'model';
            } else {
                $sender = 'user';
            }
        }

        // return response()->json(['requestData' => $requestData]);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($apiUrl, $requestData);

        if ($response->successful()) {
            // Request was successful
            $responseData = $response->json();
            $responseData = $responseData['candidates'][0]['content']['parts'][0]['text'];
            $encodedResponse = $responseData;
            // Process the response from Gemini API
            return response()->json(['responseData' => $encodedResponse, 'requestData' =>  $requestData]);
            // dd($responseData);
        } else {
            // Handle errors (e.g., log, display message)
            Log::error('Gemini API request failed: ' . $response->status());
            // dd($response);
        }
    }
}
