<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AutoCheckPermission
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
        $routeName = $request->route()->getName();

        $permission = Permission::whereRaw("FIND_IN_SET('$routeName', routes )")->first();
        //return dd($permission);
        if($permission){
            if(!$request->user()->can($permission->name)){
                abort(403);
            }
            return $next($request);
        }

           // Add a response return statement here
        return $next($request);
    }
}
