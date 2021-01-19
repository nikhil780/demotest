<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Master_model;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->master_model = new Master_model();
    }

    public function get_profile(Request $request)
    {
        $arr_profile = [];

        $user_id = '1';

        //$user_id = session('user_id');

        $wherearray = array('user_id' => $user_id);

        $arr_profile = DB::table('user_master')->where($wherearray)->first();
        //dd($arr_profile);
        if($arr_profile)
        {
            $success   = 1;
            $error      = 0;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'users' => $arr_profile);

        echo json_encode($data_arr);
    }

    public function update_profile(Request $request)
    {
        //dd($request->all());
        $user_id = '1';
        //$user_id = Session(íd);


        $email_address = $request->input('email_address');
        $first_name    = $request->input('first_name');
        $last_name     = $request->input('last_name');
        $gender        = $request->input('gender');
        $role_id       = $request->input('role_id');
       
        $data = $this->validate($request, [
                'email_address' => 'required',
                'first_name'    => 'required',
                'last_name'     => 'required',
                'gender'        => 'required',
                'role_id'       => 'required',
            ]);
      
      
        $usr_input  =   array( 
                                'email_address'      => $email_address,
                                'gender'             => $gender,
                                'first_name'         => $first_name,
                                'last_name'          => $last_name,
                                'role_id'            => $role_id,
                                'last_modified_on'   => date('Y-m-d H:i:s'),
                                //'last_modified_by' => $this->session->userdata('user_id'),
                                'last_modified_by'   => '1',
                            );
        $where     = array('user_id' => $user_id);
        $is_insert =  $this->master_model->updateRecord('user_master', $usr_input, $where);

        if($is_insert)
        {
            $success    = 1;
            $error      = 0;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error);
        echo json_encode($data_arr);
    }

}
