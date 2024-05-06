<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Leader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request);
        if ($request->group_id != null) {
            $id = $request->group_id;
        } else {
            $id = $request->route('group');
        }
        // dd($id);
        $group = null;
        if (is_object($id) && $id instanceof Group) {
            // The ID is a valid Group model instance
            // Use $id as the Group model object
            $group = $id;
            // dd($group, 1);
        } else {
            // The ID is a string
            // Treat $id as a string value
            // dd($id);
            $group = Group::find($id);
            // dd($group, 2);
        }
        // dd($group);
        if ($group->leader_id !== auth()->user()->id) {
            abort(403, 'Unauthorized: You are not the leader of this group.');
        }
        return $next($request);
    }
}
