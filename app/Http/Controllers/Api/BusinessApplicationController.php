<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Master_model;
use Illuminate\Http\Request;

class BusinessApplicationController extends Controller
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

        $where                    = array('application.is_deleted' => '0');
        $arr_business_application = [];

        $arr_business_application = DB::table('application')
                   ->select('application.id','application.application_name','application.rpo','application.rto','application.application_priority','project.project_name')
                   ->join('project', 'project.project_config_id', '=', 'application.project_id_fk')
                   ->where($where)
                   ->get();

        if($arr_business_application)
        {
            $success    = 1;
            $error      = 0;
            $arr_business_application = $arr_business_application;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'business_applications' => $arr_business_application);
        echo json_encode($data_arr);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $application_name        = $request->input('application_name');
        $application_description = $request->input('application_description');
        $project_id_fk           = $request->input('project_id_fk');
        $application_priority    = $request->input('application_priority');
        $rpo                     = $request->input('rpo');
        $rto                     = $request->input('rto');
    
      
        $app_input  =   array( 
                                'application_name'        => $application_name,
                                'project_id_fk'           => $project_id_fk,
                                'application_description' => $application_description,
                                'application_priority'    => $application_priority,
                                'rpo'                     => $rpo,
                                'rto'                     => $rto,
                                //'added_on'              => date('Y-m-d H:i:s'),
                                //'added_by'              => $this->session->userdata('user_id'),
                                'added_by'                => '1',
                                //'last_modified_on'      => date('Y-m-d H:i:s'),
                                //'last_modified_by'      => $this->session->userdata('user_id'),
                                'last_modified_by'        => '1',
                            );

        $is_insert =  $this->master_model->insertRecord('application', $app_input, false);

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
        $application_id = $request->input('application_id');

        $where            = array('id' => $application_id);
        $arr_applications = [];
        $arr_applications = DB::table('application')->where($where)->first();
        //dd($arr_applications);

        if($arr_applications)
        {
            $success    = 1;
            $error      = 0;
            $arr_applications = $arr_applications;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'applications' => $arr_applications);
        echo json_encode($data_arr);

    }

    public function update(Request $request)
    {
        $application_id = $request->input('application_id');

        $application_name        = $request->input('application_name');
        $application_description = $request->input('application_description');
        $project_id_fk           = $request->input('project_id_fk');
        $application_priority    = $request->input('application_priority');
        $rpo                     = $request->input('rpo');
        $rto                     = $request->input('rto');
      
        $app_input  =   array( 
                                'application_name'  =>  $application_name,
                                'project_id_fk'   =>  $project_id_fk,
                                'application_description'  =>  $application_description,
                                'application_priority'   =>  $application_priority,
                                'rpo'   =>  $rpo,
                                'rto' =>  $rto,
                                //'added_on' => date('Y-m-d H:i:s'),
                                //'added_by' => $this->session->userdata('user_id'),
                                'added_by' => '1',
                                //'last_modified_on' => date('Y-m-d H:i:s'),
                                //'last_modified_by' => $this->session->userdata('user_id'),
                                'last_modified_by' => '1',
                            );

        $where     = array('id' => $application_id);
        $is_update =  $this->master_model->updateRecord('application', $app_input, $where);

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
        $application_id    = $request->input('application_id');
        $login_user_id     = '1';

        $where         = array('id' => $application_id);
        $app_input     = array('is_deleted' => '1','deleted_on'=>date('Y-m-d H:i:s'),'deleted_by' => $login_user_id);

        /*Check dependency*/
        // $tbl_name = ''
        // $condition = array('project_config_id' => $project_id);
        // $cnt = $this->master_model->getRecordCount();
        // dd($cnt);


        $is_update =  $this->master_model->updateRecord('application', $app_input, $where);

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

    public function get_active_list()
    {
        $where        = array('is_deleted' => '0','is_active' => '1');
        $arr_projects = [];
        $arr_projects = DB::table('project_config')->where($where)->get();
        
        if($arr_projects)
        {
            $success    = 1;
            $error      = 0;
            $arr_projects = $arr_projects;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'projects' => $arr_projects);
        echo json_encode($data_arr);
    }

    public function get_pr_dr_location(Request $request)
    {   
        $project_id   = $request->input('project_id'); 
        $where        = array('is_deleted' => '0','project_config_id' => $project_id);
        $arr_projects = [];
        $arr_projects = DB::table('project_config')->select('pr_location','dr_location')->where($where)->first();
        
        if($arr_projects)
        {
            $success    = 1;
            $error      = 0;
            $arr_projects = $arr_projects;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'projects' => $arr_projects);
        echo json_encode($data_arr);
    }
}
