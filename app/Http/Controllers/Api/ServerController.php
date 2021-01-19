<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Master_model;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ServerController extends Controller
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
        $where        = array('server_config.is_deleted' => '0');
        $arr_servers  = [];

        $arr_servers = DB::table('server_config')
                       ->select('server_config.id','server_config.server_name','server_config.server_ip','server_config.project_location','server_config.server_type','server_config.server_hostname','project.project_name','project.pr_location','project.dr_location')
                       ->join('project', 'project.project_config_id', '=', 'server_config.project_config_id_fk')
                       ->where($where)
                       ->get();

        //$arr_servers  = DB::table('server_config')->where($where)->get();
        //dd($arr_servers);

        if($arr_servers)
        {
            $success    = 1;
            $error      = 0;
            $arr_servers = $arr_servers;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'servers' => $arr_servers);
        echo json_encode($data_arr);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
                'server_name'          => 'required',
                'server_ip'            => 'required',
                'server_hostname'      => 'required',
                'project_config_id_fk' => 'required',
                'project_location'     => 'required',
                'os_family_id_fk'      => 'required',
                'os_arch_id_fk'        => 'required',
                'os_id_fk'             => 'required',
                'admin_password'       => 'required',
                'admin_username'       => 'required',
                'port_number'          => 'required',
       ]);


        $server_input                         = array();
        $server_input['server_name']          = $request->input('server_name');
        $server_input['server_ip']            = $request->input('server_ip');
        $server_input['server_hostname']      = $request->input('server_hostname');
        $server_input['project_config_id_fk'] = $request->input('project_config_id_fk');
        $server_input['project_location']     = $request->input('project_location');
        $server_input['os_family_id_fk']      = $request->input('os_family_id_fk');
        $server_input['os_arch_id_fk']        = $request->input('os_arch_id_fk');
        $server_input['os_id_fk']              = $request->input('os_id_fk');

        $server_input['admin_password']        = $request->input('admin_password');
        $server_input['admin_username']        = $request->input('admin_username');
        $server_input['port_number']           = $request->input('port_number');

         //$server_input['added_by']       = $this->session->userdata('user_id');
         $server_input['added_by']         = '1';

         //$server_input['last_modified_by'] = $this->session->userdata('user_id');
         $server_input['last_modified_by']   = '1';
                 
      
        //dd($server_input);
        $is_insert =  $this->master_model->insertRecord('server_config', $server_input, false);

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
        $server_id = $request->input('server_id');

        $where        = array('id' => $server_id);
        $arr_servers  = [];
        $arr_servers  = DB::table('server_config')->where($where)->first();
        //dd($arr_servers);

        if($arr_servers)
        {
            $success    = 1;
            $error      = 0;
            $arr_servers = $arr_servers;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'servers' => $arr_servers);
        echo json_encode($data_arr);

    }

    public function update(Request $request)
    {
        $data = $this->validate($request, [
                'server_name'          => 'required',
                'server_ip'            => 'required',
                'server_hostname'      => 'required',
                'project_config_id_fk' => 'required',
                'project_location'     => 'required',
                'os_family_id_fk'      => 'required',
                'os_arch_id_fk'        => 'required',
                'os_id_fk'             => 'required',
                'admin_password'       => 'required',
                'admin_username'       => 'required',
                'port_number'          => 'required',
       ]);


        $server_input                         = array();
        $server_input['server_name']          = $request->input('server_name');
        $server_input['server_ip']            = $request->input('server_ip');
        $server_input['server_hostname']      = $request->input('server_hostname');
        $server_input['project_config_id_fk'] = $request->input('project_config_id_fk');
        $server_input['project_location']     = $request->input('project_location');
        $server_input['os_family_id_fk']      = $request->input('os_family_id_fk');
        $server_input['os_arch_id_fk']        = $request->input('os_arch_id_fk');
        $server_input['os_id_fk']              = $request->input('os_id_fk');

        $server_input['admin_password']        = $request->input('admin_password');
        $server_input['admin_username']        = $request->input('admin_username');
        $server_input['port_number']           = $request->input('port_number');

         //$server_input['added_by']       = $this->session->userdata('user_id');
         $server_input['added_by']         = '1';

         //$server_input['last_modified_by'] = $this->session->userdata('user_id');
         $server_input['last_modified_by']   = '1';

         $server_id = $request->input('server_id');

        $where     = array('id' => $server_id);
        $is_update =  $this->master_model->updateRecord('server_config', $server_input, $where);

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
        //dd($request->all());
        $server_id    = $request->input('server_id');
        $login_user_id = '1';

        $where         = array('server_config_id' => $server_id);

        $project_status = $request->input('project_status');

        if($project_status==0)
        {
           $prj_input     = array('is_active' => '1','last_modified_on'=>date('Y-m-d H:i:s'),'last_modified_by' => $login_user_id);

        }
        else
        {
             $prj_input     = array('is_active' => '0','last_modified_on'=>date('Y-m-d H:i:s'),'last_modified_by' => $login_user_id);           
        }

        $is_update =  $this->master_model->updateRecord('server_config', $prj_input, $where);

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
        $server_id    = $request->input('server_id');
        $login_user_id = '1';

        $where         = array('id' => $server_id);
        $prj_input     = array('is_deleted' => '1','deleted_on'=>date('Y-m-d H:i:s'),'deleted_by' => $login_user_id);

        /*Check dependency*/
        // $tbl_name = ''
        // $condition = array('server_config_id' => $server_id);
        // $cnt = $this->master_model->getRecordCount();
        // dd($cnt);


        $is_update =  $this->master_model->updateRecord('server_config', $prj_input, $where);

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

    public function check_status(Request $request)
    {
        $server_id = $request->server_id;
        //dd($server_id);

        $server_hostname = $request->input('server_hostname');

        $server_hostname = "10.10.28.14";

        $cmd = "";
        $cmd = "salt ".$server_hostname." test.version";
        //dd($cmd);

        $process = new Process($cmd);

        $success = $process->run();
                        // executes after the command finishes
        if (!$process->isSuccessful()) 
        {
            $success = '0';
            $error = '1';
            throw new ProcessFailedException($process);
        }
        else
        {
            $success = '1';
            $error = '0';
        }

        //dd($success);
        $data_arr = array('success' => $success, 'error' => $error);
        echo json_encode($data_arr);
    }

    public function get_os()
    {
        $where        = array('is_deleted' => '0','is_active' => '1');
        $arr_os = [];
        $arr_os = DB::table('os_master')->where($where)->get();
        
        if($arr_os)
        {
            $success    = 1;
            $error      = 0;
            $arr_os     = $arr_os;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'os' => $arr_os);
        echo json_encode($data_arr);
    }

    public function get_os_arch()
    {
        $where        = array('is_deleted' => '0','is_active' => '1');
        $arr_os_arch  = [];
        $arr_os_arch  = DB::table('os_arch')->where($where)->get();
        
        if($arr_os_arch)
        {
            $success        = 1;
            $error          = 0;
            $arr_os_arch    = $arr_os_arch;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'os_arch' => $arr_os_arch);
        echo json_encode($data_arr);
    }
    
    public function get_os_family(Request $request)
    {
        $os_id        = $request->input('os_id_fk'); 
        $where        = array('is_deleted' => '0','os_id_fk' => $os_id);
        $arr_os_family = [];
        $arr_os_family = DB::table('os_family')->select('os_family_id','os_id_fk','os_family_name')
                                            ->where($where)
                                            ->get();
        
        if($arr_os_family)
        {
            $success      = 1;
            $error        = 0;
            
            $arr_os_family = $arr_os_family;
        }
        else
        {
            $success   = 0;
            $error     = 1;
        }

        $data_arr = array('success' => $success, 'error' => $error, 'arr_os_family' => $arr_os_family);
        echo json_encode($data_arr);
    }
}
