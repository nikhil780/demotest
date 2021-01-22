<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Master_model;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        //dd('1');
        $where        = array('is_deleted' => '0');
        $arr_projects = [];
        $arr_projects = DB::table('project')->where($where)->get();
        
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

    public function store(Request $request)
    {
        //dd($request);
        $project_name         = $request->input('project_name');
        $pr_location          = $request->input('pr_location');
        $dr_location          = $request->input('dr_location');
        $description          = $request->input('description');
       // $project_type         = $request->input('project_type');
        $is_poc_project       = $request->input('is_poc_project');
        $special_note         = $request->input('special_note');
        $project_started_date = $request->input('project_started_date');
        $project_renewal_date = $request->input('project_renewal_date');

       
        if(isset($is_poc_project) && $is_poc_project=='1')
        {
            $is_poc_project = '1';
        }
        else
        {
            $is_poc_project = '0';
        }

        $prj_input  =   array( 
                                'project_name'  =>  $project_name,
                                'description'   =>  $description,
                                //'project_type'  =>  $project_type,
                                'project_started_date'  =>  date('Y-m-d',strtotime($project_started_date)),
                                'project_renewal_date'  =>  date('Y-m-d',strtotime($project_renewal_date)),
                                'pr_location'   =>  $pr_location,
                                'dr_location'   =>  $dr_location,
                                'special_notes' =>  $special_note,
                                'is_poc_project' => $is_poc_project,
                                //'added_on' => date('Y-m-d H:i:s'),
                                //'added_by' => $this->session->userdata('user_id'),
                                'added_by' => '1',
                                //'last_modified_on' => date('Y-m-d H:i:s'),
                                //'last_modified_by' => $this->session->userdata('user_id'),
                                'last_modified_by' => '1',
                                'is_active' => '1',
                            );

        $is_insert =  $this->master_model->insertRecord('project', $prj_input, false);

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
        $project_id = $request->input('project_id');

        $where        = array('project_config_id' => $project_id);
        $arr_projects = [];
        $arr_projects = DB::table('project')->where($where)->first();
        //dd($arr_projects);

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

    public function update(Request $request)
    {
        //dd($request->all());
        $project_name         = $request->input('project_name');
        $pr_location          = $request->input('pr_location');
        $dr_location          = $request->input('dr_location');
        $description          = $request->input('description');
       // $project_type         = $request->input('project_type');
        $is_poc_project       = $request->input('is_poc_project');
        $special_note         = $request->input('special_note');
        $project_started_date = $request->input('project_started_date');
        $project_renewal_date = $request->input('project_renewal_date');

        $project_id = $request->input('project_id');
       // dd($project_id);
      
        if(isset($is_poc_project) && $is_poc_project=='1')
        {
            $is_poc_project = '1';
        }
        else
        {
            $is_poc_project = '0';
        }

        $prj_input  =   array( 
                                'project_name'  =>  $project_name,
                                'description'   =>  $description,
                                //'project_type'  =>  $project_type,
                                'project_started_date'  =>  date('Y-m-d',strtotime($project_started_date)),
                                'project_renewal_date'  =>  date('Y-m-d',strtotime($project_renewal_date)),
                                'pr_location'   =>  $pr_location,
                                'dr_location'   =>  $dr_location,
                                'special_notes' =>  $special_note,
                                'is_poc_project' => $is_poc_project,
                                //'added_on' => date('Y-m-d H:i:s'),
                                //'added_by' => $this->session->userdata('user_id'),
                                //'added_by' => '1',
                                //'last_modified_on' => date('Y-m-d H:i:s'),
                                //'last_modified_by' => $this->session->userdata('user_id'),
                                'last_modified_by' => '1',
                                //'is_active' => '1',
                            );
        $where     = array('project_config_id' => $project_id);
        $is_update =  $this->master_model->updateRecord('project', $prj_input, $where);

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

    public function change_status(Request $request)
    {
        $project_id     = $request->input('project_id');
        $project_status = $request->input('project_status');

        $login_user_id  = '1';
        $where          = array('project_config_id' => $project_id);

        if($project_status==0)
        {
           $prj_input     = array('is_active' => '1','last_modified_by' => $login_user_id);
        }
        else
        {
             $prj_input     = array('is_active' => '0','last_modified_by' => $login_user_id);          
        }

        $is_update =  $this->master_model->updateRecord('project', $prj_input, $where);

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
        $project_id    = $request->input('project_id');
        $login_user_id = '1';

        $where         = array('project_config_id' => $project_id);
        $prj_input     = array('is_deleted' => '1','deleted_on'=>date('Y-m-d H:i:s'),'deleted_by' => $login_user_id);

        /*Check dependency*/
        // $tbl_name = ''
        // $condition = array('project_config_id' => $project_id);
        // $cnt = $this->master_model->getRecordCount();
        // dd($cnt);


        $is_update =  $this->master_model->updateRecord('project', $prj_input, $where);

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
        $arr_projects = DB::table('project')->where($where)->get();
        
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
       $final_arr_projects  = [];

        $project_id   = $request->input('project_config_id_fk'); 
        $where        = array('is_deleted' => '0','project_config_id' => $project_id);
        $arr_projects = [];
        $arr_projects = DB::table('project')->select('pr_location','dr_location')
                                            ->where($where)
                                            ->first();
        
        if($arr_projects)
        {
            $success      = 1;
            $error        = 0;
            
            $final_arr_projects[] = $arr_projects->pr_location;
            $final_arr_projects[] = $arr_projects->dr_location;

            
            //$final_arr_projects['PR'] = $arr_projects->pr_location;
            //$final_arr_projects['DR'] = $arr_projects->dr_location;

            // $final_arr_projects['val'] = $arr_projects->pr_location;
            // $final_arr_projects['val'] = $arr_projects->pr_location;

        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'arr_location' => $final_arr_projects);
        echo json_encode($data_arr);
    }

    // public function get_os_family(Request $request)
    // {  
    //    $final_arr_projects  = [];

    //     $os_id        = $request->input('os_id_fk'); 
    //     $where        = array('is_deleted' => '0','os_id_fk' => $os_id);
    //     $arr_os_family = [];
    //     $arr_os_family = DB::table('os_family')->select('os_id_fk','os_family_name')
    //                                         ->where($where)
    //                                         ->first();
        
    //     if($arr_os_family)
    //     {
    //         $success      = 1;
    //         $error        = 0;
            
    //         $arr_os_family = $arr_os_family;
    //     }
    //     else
    //     {
    //         $success   = 0;
    //         $error     = 1;
    //     }

    //     $data_arr = array('success' => $success, 'error' => $error, 'arr_os_family' => $arr_os_family);
    //     echo json_encode($data_arr);
    // }
}
