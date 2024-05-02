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
        $id = $request->route('group');
        $group = null;

        // Check if the ID is a valid Group model instance or a string
        if (is_object($id) && $id instanceof Group) {
            // The ID is a valid Group model instance
            // Use $id as the Group model object
            $group = $id;
        } else {
            // The ID is a string
            // Treat $id as a string value
            $group = Group::find($id);
        }

        // // Check if the authenticated user is a member of the group
        if ($group->members()->find(auth()->user()->id) != null) {
            return $next($request);
        }

        // User is not a member, redirect or throw an exception
        return abort(403, 'Unauthorized: You are not a member of this group.');
    }
}
