<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
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

    public function index()
    {
        $users = DB::table('user_master')->where(['is_deleted'=>0])->get();
        //dd($users);

        $success   = 1;
        $error      = 0;

        $data_arr = array('success' => $success, 'error' => $error, 'users' => $users);

       //$data_arr = "abc";
        //print_r('21');

        echo json_encode($data_arr);

        //return response()->json($users);
    }
}
