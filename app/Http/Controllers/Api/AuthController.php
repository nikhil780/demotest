<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        $user_email_id = $request->input('user_email_id');
        $user_password = $request->input('user_password');

        $data = $this->validate($request, [
                'user_email_id'=>'required|email',               
                'user_password'=>'required',
        
            ]);

        $where = array('email_address' => $user_email_id,'user_password' => md5($user_password),'is_deleted'=>'0');

        $arr_users = [];

        $users_cnt = DB::table('user_master')->where($where)->count();

        if($users_cnt>0)
        {
            $success   = 1;
            $error      = 0;
            $arr_users = DB::table('user_master')->where($where)->first();

        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'users' => $arr_users);

        echo json_encode($data_arr);

    }
}
