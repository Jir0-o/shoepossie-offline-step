<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BackofficeRole;
use App\Models\BackofficeLogin;

class OfficeStaff
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
        
        // $BackofficeRole=BackofficeLogin::join('backoffice_role','backoffice_role.role_id','=','backoffice_login.role_id')
        //                               ->select('backoffice_role.*','backoffice_login.*')->get();
                                       
            if($role_name!='Office Staff'){
                return redirect('/home')->with('fail','You must be Administrator');
            }
            return $next($request);
            
    }
}
