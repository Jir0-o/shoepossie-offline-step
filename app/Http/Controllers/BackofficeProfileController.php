<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;



use App\Models\BackofficeLogin;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;



class BackofficeProfileController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index($id)

    {

        $login_id = Crypt::decryptString($id);



        $backoffice_user = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')

            ->where('backoffice_login.login_id', '=', $login_id)

            ->select('backoffice_role.*', 'backoffice_login.*')

            ->get();



        return view('dashboard.profile.index', compact(['backoffice_user']));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function updatePassword(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'old_password' => 'required',

            'new_password' => 'required|min:5|max:30',

            're_write_password' => 'required|min:5|max:30'

        ]);



        if ($validator->fails()) {

            return response()->json([

                "validation_error" => true,

                "messages" => $validator->messages()

            ]);

        }



        $login_id = $request->session()->get("LoggedUser");

        $BackofficeLogin = BackofficeLogin::where('login_id', $login_id)->first();



        if (Hash::check($request->old_password, $BackofficeLogin->login_user_pass)) {



            $BackofficeLogin->login_user_pass = Hash::make($request->new_password);

            $BackofficeLogin->update();



            return response()->json(

                [

                    "success" => true,

                    "message" => "Password Changed Successfully !!"

                ],

                200

            );

        } else {

            return response()->json([

                "pass_error" => true,

                "message" => "Old Password Did Not Match !!"

            ], 200);

        }

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request)

    {

        $BackofficeLogin = BackofficeLogin::find($request->login_id);



        if ($request->file('user_image')) {

            $file = $request->file('user_image');

            $filename = date('YmdHi') . $file->getClientOriginalName();

            $file->move(public_path('backend/images/profile_picture/'), $filename);

        }



        $BackofficeLogin->user_image = $filename;

        $save = $BackofficeLogin->save();



        if ($save) {

            return redirect()->back()->with('success', 'Profile Updated successfully');

        } else {

            return redirect()->back()->with('fail', 'Something went wrong, failed to register');

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }

}

