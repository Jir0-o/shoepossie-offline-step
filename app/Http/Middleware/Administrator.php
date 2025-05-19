<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administrator
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
        $user_id=session()->get('LoggedUser');
        $user_data=\App\Models\BackofficeLogin::join('backoffice_role','backoffice_role.role_id','=','backoffice_login.role_id')->where('login_id',$user_id)->get();
        foreach($user_data as $user){
            $role_name=$user->role_name;
        }
        
        if($role_name=='Administrator' || $role_name=='Super Administrator'){
            return $next($request);
        }else{
            return redirect('/backoffice/home')->with('fail','You must be Administrator');
        }

    }
}
