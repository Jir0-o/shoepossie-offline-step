<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackofficeLogin;
use App\Models\BackofficeRole;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class BackofficeLoginController extends Controller
{
    public function index()
    {

        $backoffice_role = BackofficeRole::all();

        return view('dashboard.backoffice.register', compact(['backoffice_role']));
    }

    public function show()
    {

        $backoffice_users = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->select('backoffice_role.*', 'backoffice_login.*')
            ->get();

        return view('dashboard.backoffice.allBackofficeUser', compact(['backoffice_users']));
    }

    public function create(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'office_user_id' => 'required',
            'name' => 'required',
            'uname' => 'required',
            'backoffice_role' => 'required',
            'email' => 'required|email|unique:backoffice_login,user_email',
            'password' => 'required|min:5|max:30',
        ]);


        $user = new BackofficeLogin();
        $user->office_user_id = $request->office_user_id;
        $user->full_name = $request->name;
        $user->login_user_name = $request->uname;
        $user->user_email = $request->email;
        $user->role_id = $request->backoffice_role;
        $user->is_active = 1;
        $user->login_user_pass = Hash::make($request->password);

        $save = $user->save();

        if ($save) {
            return redirect()->route('backoffice.all-backoffice-user')->with('success', 'You are now registered successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }

    public function edit($id)
    {

        $id = Crypt::decryptString($id);

        $backoffice_users = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->select('backoffice_role.*', 'backoffice_login.*')
            ->where('backoffice_login.login_id', '=', $id)
            ->get();

        $backoffice_role = BackofficeRole::all();

        return view('dashboard.backoffice.editBackofficeUser', compact(['backoffice_users', 'backoffice_role']));
    }


    public function update(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'office_user_id' => 'required',
            'name' => 'required',
            'uname' => 'required',
            'backoffice_role' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:30',
        ]);


        $user = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->select('backoffice_role.*', 'backoffice_login.*')
            ->where('backoffice_login.login_id', '=', $request->login_id)
            ->first();

        $user->office_user_id = $request->office_user_id;
        $user->full_name = $request->name;
        $user->login_user_name = $request->uname;
        $user->user_email = $request->email;
        $user->role_id = $request->backoffice_role;
        $user->is_active = 1;
        $user->login_user_pass = Hash::make($request->password);

        $save = $user->save();

        if ($save) {
            return redirect()->route('backoffice.all-backoffice-user')->with('success', 'Information Updated successfully');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }


    public function check(Request $request)
    {
        //Validate Inputs
        //dd("reached");
        $request->validate([
            'email' => 'required|email|exists:backoffice_login,user_email',
            'password' => 'required|min:5|max:30'
        ], [
            'user_email.exists' => 'This email is not registered'
        ]);

        $BackofficeLogin = BackofficeLogin::where('user_email', '=', $request->email)
            ->where('is_active', '=', 1)
            ->first();

        $serialNumber = shell_exec('powershell "Get-CimInstance Win32_BaseBoard | Select-Object -ExpandProperty SerialNumber"');
        $serialNumber = trim($serialNumber);
        
        // if ($serialNumber != 'HC16218957'){
        //     return back()->with('fail', 'Something Wrong please contact With Unicorn Software and solutions');
        // }

        if (!$BackofficeLogin) {
            return back()->with('fail', 'We do not recognize your Email');
        } else {
            //check password
            if (Hash::check($request->password, $BackofficeLogin->login_user_pass)) {

                $request->session()->put('LoggedUser', $BackofficeLogin->login_id);
                return redirect('backoffice/home');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }



    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/backoffice/login');
        }
    }
}
