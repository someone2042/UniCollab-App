<?php

namespace App\Http\Middleware;

use App\Models\Group;
use Closure;
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

        // Check if the authenticated user is a member of the group
        if ($group->members()->find(auth()->user()->id) != null) {
            return $next($request);
        }

        // User is not a member, redirect or throw an exception
        return abort(403, 'Unauthorized: You are not a member of this group.');
    }
}
