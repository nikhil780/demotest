<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Master_model;
use Illuminate\Http\Request;

class ContactController extends Controller
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

    public function index(Request $request)
    {
        $where        = array('is_deleted' => '0');
        $arr_contacts = [];
        $arr_contacts = DB::table('contact_config')->where($where)->get();
        //dd($arr_contacts);

        if($arr_contacts)
        {
            $success    = 1;
            $error      = 0;
            $arr_contacts = $arr_contacts;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'contacts' => $arr_contacts);
        echo json_encode($data_arr);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $contact_name          = $request->input('contact_name');
        $project_id_fk         = $request->input('project_id_fk');
        $location              = $request->input('location');
        $email_address         = $request->input('email_address');
       
        $alternate_email_address = $request->input('alternate_email_address');
        $address                 = $request->input('address');
        $mobile                  = $request->input('mobile');
        $alternate_mobile        = $request->input('alternate_mobile');
        $fax_number              = $request->input('fax_number');
       
        $data = $this->validate($request, [
                'contact_name'          =>'required',               
                'project_id_fk'         =>'required',
                'location'              =>'required',
                'email_address'         =>'required',
                'address'               =>'required',
                'mobile'                =>'required',        
            ]);
      

        $prj_input  =   array( 
                                'contact_name'            =>  $contact_name,
                                'project_id_fk'           =>  $project_id_fk,
                                'location'                =>  $location,
                                'email_address'           =>  $email_address,
                                'alternate_email_address' =>  $alternate_email_address,
                                'address'                 =>  $address,
                                'mobile'                  =>  $mobile,
                                'alternate_mobile'        =>  $alternate_mobile,
                                'fax_number'              =>  $fax_number,
                                'added_on' => date('Y-m-d H:i:s'),
                                //'added_by' => $this->session->userdata('user_id'),
                                'added_by' => '1',
                                'last_modified_on' => date('Y-m-d H:i:s'),
                                //'last_modified_by' => $this->session->userdata('user_id'),
                                'last_modified_by' => '1',
                                
                            );

        $is_insert =  $this->master_model->insertRecord('contact_config', $prj_input, false);

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

    public function edit(Request $request)
    {
        $contact_id = $request->input('contact_id');

        $where        = array('contact_id' => $contact_id);
        $arr_contacts = [];
        $arr_contacts = DB::table('contact_config')->where($where)->first();
        //dd($arr_contacts);

        if($arr_contacts)
        {
            $success    = 1;
            $error      = 0;
            $arr_contacts = $arr_contacts;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'contacts' => $arr_contacts);
        echo json_encode($data_arr);

    }

    public function update(Request $request)
    {
        $contact_id = $request->input('contact_id');

        $contact_name          = $request->input('contact_name');
        $project_id_fk         = $request->input('project_id_fk');
        $location              = $request->input('location');
        $email_address         = $request->input('email_address');
       
        $alternate_email_address = $request->input('alternate_email_address');
        $address                 = $request->input('address');
        $mobile                  = $request->input('mobile');
        $alternate_mobile        = $request->input('alternate_mobile');
        $fax_number              = $request->input('fax_number');
       
        $data = $this->validate($request, [
                'contact_name'          =>'required',               
                'project_id_fk'         =>'required',
                'location'              =>'required',
                'email_address'         =>'required',
                'address'               =>'required',
                'mobile'                =>'required',        
            ]);
      

        $cnt_input  =   array( 
                                'contact_name'            =>  $contact_name,
                                'project_id_fk'           =>  $project_id_fk,
                                'location'                =>  $location,
                                'email_address'           =>  $email_address,
                                'alternate_email_address' =>  $alternate_email_address,
                                'address'                 =>  $address,
                                'mobile'                  =>  $mobile,
                                'alternate_mobile'        =>  $alternate_mobile,
                                'fax_number'              =>  $fax_number,
                                'added_on' => date('Y-m-d H:i:s'),
                                //'added_by' => $this->session->userdata('user_id'),
                                'added_by' => '1',
                                'last_modified_on' => date('Y-m-d H:i:s'),
                                //'last_modified_by' => $this->session->userdata('user_id'),
                                'last_modified_by' => '1',
                                
                            );
      
        $where     = array('contact_id' => $contact_id);
        $is_update =  $this->master_model->updateRecord('contact_config', $cnt_input, $where);

        if($is_update)
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

    public function delete(Request $request)
    {
        //dd($request->all());
        $contact_id    = $request->input('contact_id');
        $login_user_id = '1';
        $where     = array('contact_id' => $contact_id);
        $cnt_input = array('is_deleted' => '1','deleted_on'=>date('Y-m-d H:i:s'),'deleted_by' => $login_user_id);

        $is_update =  $this->master_model->updateRecord('contact_config', $cnt_input, $where);

        if($is_update)
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
