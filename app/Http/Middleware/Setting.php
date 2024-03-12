<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Setting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $permission = [];
        $p = [];

        if($user)
        {
            foreach($user->roles as $role)
            {
                foreach($role->permissions as $p)
                {
                    array_push($permission,$p);
                }
            }
            foreach($permission as $p)
            {
                array_push($per,$p->name);
            }
            if(!in_array('setting',$per)){
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
