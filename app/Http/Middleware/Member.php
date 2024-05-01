<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Member
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($name);
        $group = $request->route('group');
        // $group = Group::find($id);
        // dd($group->members);

        // // Check if the authenticated user is a member of the group
        if ($group->members()->find(auth()->user()->id) != null) {
            return $next($request);
        }

        // User is not a member, redirect or throw an exception
        return abort(403, 'Unauthorized: You are not a member of this group.');
    }
}
