<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorize
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
        // $currentURl = $request->url();
        
        // $path = parse_url($currentURl, PHP_URL_PATH);
        
        // $segments = explode('/', trim($path, '/'));
        
        $user = auth()->user();
        $permission = [];
        $per = [];

        if ($user) {
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
            
            
            if(!!array_search('user-management',$per)){
                
                return redirect()->back();
            }
        }
        

        return $next($request);
    }
}
