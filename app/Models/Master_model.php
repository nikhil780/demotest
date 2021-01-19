<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class Master_model extends Model
{
	
	public function getRecordCount($tbl_name,$condition=FALSE)
	{
		$query = \DB::table($tbl_name);
		if($condition!="" && count($condition)>0)
		{
			foreach($condition as $key=>$val)
			{ $query->where($key,$val); }

		}
		//$num=$this->db->count_all_results($tbl_name);
		return $query->count();
	}
		
 	 public function getRecords($tbl_name,$condition=FALSE,$select=FALSE,$order_by=FALSE,$start=FALSE,$limit=FALSE, $join = FALSE, $joinTable = FALSE, $tbl1_id = FALSE, $tbl2_id = FALSE)
	{
		$query = \DB::table($tbl_name);
		$key = $val = '';

		//join
		if($join !== FALSE && $join != ''){
			switch ($join) {
				case 'left':
					$query->leftJoin($joinTable, $tbl_name.'.'.$tbl1_id, '=', $joinTable.'.'.$tbl2_id);
					break;
				case 'right':
					$query->rightJoin($joinTable, $tbl_name.'.'.$tbl1_id, '=', $joinTable.'.'.$tbl2_id);
					break;
				case 'inner':
					$query->join($joinTable, $tbl_name.'.'.$tbl1_id, '=', $joinTable.'.'.$tbl2_id);
					break;
				default:
					# code...
					break;
			}
		}

		if($select != "" && $select != false){
			foreach ($select as $value) {
				$query->addSelect($value);
			}
		}
		//if(count($condition)>0 && $condition != ""){
		if($condition !== FALSE && $condition != ''){
			$condition = $condition; 
		}else{
			$condition = array();
		}
		//if(count($order_by)>0 && $order_by!=""){
		if($order_by !== FALSE && $order_by != ''){
			foreach($order_by as $key => $val){
				$query->orderBy($key, $val);
			}
		}
		if(($limit != "" && $limit !== FALSE) || ($start != "" && $start !== FALSE)){
			$query->offset($start);
			$query->limit($limit);
		}
		$users = $query->where($condition)->get();
		return $users->toArray();
		
		//return $users; 
		//return $users->objectToArray();
		//return Response::json($users->to_array());
	}
	
	public function insertRecord($tbl_name,$data_array,$insert_id=FALSE)
	{
		$query = \DB::table($tbl_name);
		if($id=$query->insertGetId($data_array))
		{
			if($insert_id==true)
			{return $id;}
			else
			{return true;}
		}
		else
		{return false;}
	}
	
	public function updateRecord($tbl_name,$data_array,$where_arr)
	{
		$query = \DB::table($tbl_name);
		//$this->db->where($where_arr,NULL,FALSE);
		$query->where($where_arr);	// changed on 20-06-2017, by Prafull + Bhagwan
		
		if($query->update($data_array))

		{return true;}

		else

		{return false;}

	}
	
	public function deleteRecord($tbl_name,$pri_col,$id)
	{
		$query = \DB::table($tbl_name);
		$query->where($pri_col,$id);
		if($query->delete())

		{return true;}

		else

		{return false;}

	}
	
	/*public function getIPAddress() {  
	    //whether ip is from the share internet  
	     if(!emptyempty($_SERVER['HTTP_CLIENT_IP'])) {  
	                $ip = $_SERVER['HTTP_CLIENT_IP'];  
	        }  
	    //whether ip is from the proxy  
	    elseif (!emptyempty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
	     }  
	//whether ip is from the remote address  
	    else{  
	             $ip = $_SERVER['REMOTE_ADDR'];  
	     }  
	     return $ip;  
	} */
	public function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	} 
	
	public function user_log_history($userid,$action,$master_name)
	{
		$localIP = getHostByName(getHostName()); 
		//echo $localIP; 
		$tbl_name='user_log_history';
		//$ip= \Request::ip(); 
		$ip= self::get_client_ip(); 
        $url = \Request::url(); 
		$query = \DB::table($tbl_name);
		$data_array = array(
            'userid' => $userid,
            'action' =>$action,
            'ip' => $ip,
            'url' => $url,
            'master_name' => $master_name,
            'created_at' => date('Y-m-d H:i:s')
        );

		if($id=$query->insertGetId($data_array))
		{	//echo $id; exit;
			/*if($insert_id==true)
			{return $id;}
			else
			{return true;}*/
		}
		else
		{return false;}
	}

	public function enlight_user_logs($userid,$url='No url',$action)
	{
		$tbl_name='user_log_history_enlight';
		//$ip= \Request::ip(); 
		$ip= $_SERVER['REMOTE_ADDR']; 
		
		$query = \DB::table($tbl_name);
		$insert_data = array(
		'userid' => $userid,
		'action' => $action,          
		'ip' =>  $ip,
		'url' =>  $url,
		'created_at' => date('Y-m-d H:i:s')
		);

		if($id=$query->insertGetId($insert_data))
		{
			return $id;
		}
		else
		{return false;}
	}
	
	public static function check_access($sectionname,$accesstype)
	{
		//$sectionname dashboard
		//$accesstype view_p
		$userid = auth()->user()->id; 
		//$userid = 15; 
		$user_role = auth()->user()->role; 
		$employee_id = auth()->user()->employee_id; 
		session(['institute_group' => 1]);
		
		/*if(auth()->user()->role=='superadmin' || auth()->user()->user_type=='admin_user')
		{
			$master_school_res = DB::table('school_college_masters')->select('institute_group','master_flg')->where(array('institute_group'=>$institute_groupid,'master_flg'=>1,'is_deleted'=>0))->get();
			session(['institute_group' => $master_school_res[0]->institute_group]);
		}*/
		//$user_role = 3; 
		//DB::enableQueryLog();
		/*$check_access_res = DB::table('users_section_access')
		->join('section_master', 'users_section_access.sectionid', '=', 'section_master.id')
		->select('users_section_access.id','users_section_access.'.$accesstype.' as '.$accesstype.'')
		//->select('section_master.id as id','users_section_access.view_p as view_p')
		->whereRaw('users_section_access.userid="'.$userid.'" AND section_master.section_value="'.$sectionname.'"')->get(); */
		if(!Session::has('DASHBOARD'))
		{	//echo "dsfsf"; exit;
			$role_res = DB::table('role_masters')->where('id',$user_role)->where('is_deleted',0)->get();
			if(count($role_res) > 0)
			{
				session(['role_title' => $role_res[0]->role_title]);
				session(['assign_roleid' => $role_res[0]->assign_roleid]);
				session(['prefix' => $role_res[0]->prefix]);
			}

			$employee_res = DB::table('employee_user')->where('id',$employee_id)->where('is_deleted',0)->get();
			if(count($employee_res) > 0)
			{
				session(['institute_typeid' => $employee_res[0]->institute_typeid]);
				session(['department_id' => $employee_res[0]->department_id]);
				session(['collegeid' => $employee_res[0]->school_collegeid]);
				
				$school_res = DB::table('school_college_masters')->select('institute_group')->where('id',$employee_res[0]->school_collegeid)->where('is_deleted',0)->get();
				session(['institute_group' => $school_res[0]->institute_group]);
				//session(['prefix' => $employee_res[0]->prefix]);
			} 

			$role_section_access = DB::table('role_section_access')->whereRaw('roleid="'.$user_role.'"')
	            ->join('section_master', 'section_master.id', '=', 'role_section_access.sectionid')->get();
	        foreach ($role_section_access as $key => $value) 
	        {   
	        	//echo "<br>>>>".$value->id.">>>>".$value->section_value.">>>>".$value->add_p.">>>>".$value->edit_p.">>>>".$value->view_p.">>>>".$value->delete_p;
	            //$sectionname= array( '0' => $value->section_value);
	    		//Session::forget($value->section_value);

	            $users_section_access = DB::table('users_section_access')->where('userid',$userid)->whereRaw('sectionid="'.$value->sectionid.'"')->get();
	           //echo ">>>".count($users_section_access);
	            $view_p=0;
	            if(count($users_section_access) > 0)
	            {
	                if($users_section_access[0]->add_p==1){
						$view_p = 1;
					} else if($users_section_access[0]->edit_p==1){
						$view_p = 1;
					} else if($users_section_access[0]->delete_p==1){
						$view_p = 1;
					} else {
						$view_p = $users_section_access[0]->view_p;
					} 
	            	Session::push($value->section_value, [
					   'view_p' => $view_p,
					   'add_p' =>$users_section_access[0]->add_p,
					   'edit_p' => $users_section_access[0]->edit_p,
					   'delete_p' =>$users_section_access[0]->delete_p
					]); 
	            } else {
	            	if($value->add_p==1){
						$view_p = 1;
					} else if($value->edit_p==1){
						$view_p = 1;
					} else if($value->delete_p==1){
						$view_p = 1;
					} else {
						$view_p = $value->view_p;
					} 
	            	//echo "2".$value->section_value."<br>";
	                Session::push($value->section_value, [
					   'view_p' => $view_p,
					   'add_p' => $value->add_p,
					   'edit_p' => $value->edit_p,
					   'delete_p' => $value->delete_p
					]);  
	            }
	        }
    	}
        //dd(session('ASSIGNCHAPTERS')); 
        //exit;
        if(auth()->user()->role=='superadmin'){
        	session(['institute_group' => 1]);
			return 1;
		} else {
			//echo ">>>".session('DASHBOARD.0.view_p'); 
			//dd(session()->all());
			//echo ">>>>".$sectionname.">>>".$accesstype;
			//echo ">>>>".session($sectionname.'.0.'.$accesstype);
			//exit();
			if(session($sectionname.'.0.'.$accesstype) !="" || session($sectionname.'.0.'.$accesstype)!=NULL){
				return 1;
			} else {
				return 0;
			}
		}
		/*if(count($check_access_res)==0 && auth()->user()->role=='superadmin'){
			return 1;
		} else {
			if(isset($check_access_res[0]->$accesstype)!="" || isset($check_access_res[0]->$accesstype)!=NULL){
				return $check_access_res[0]->$accesstype;
			} else {
				return 0;
			}
		}*/
		//return dd(DB::getQueryLog());
	}

	public function check_shareable($assign_subjectid)
	{
		$data_result = array();
		$check_shareable = DB::table('assign_subject')
        ->join('school_college_masters', 'school_college_masters.id', '=', 'assign_subject.school_collegeid')
        ->select('school_college_masters.share_video','school_college_masters.id','school_college_masters.master_flg')
        ->groupBy('assign_subject.school_collegeid')
        ->where(array('school_college_masters.is_deleted' => 0, 'assign_subject.is_deleted' => 0,"assign_subject.id"=>$assign_subjectid))      
        ->get();

        if(count($check_shareable)>0)
        {
            $is_shareable = $check_shareable[0]->share_video;
            $school_college_master_id = $check_shareable[0]->id;
            $master_flg = $check_shareable[0]->master_flg;
        } else {
            $is_shareable = 0;
            $school_college_master_id = 0;
            $master_flg = 0;
        }
        $data_result['is_shareable'] = $is_shareable;
        $data_result['school_college_master_id'] = $school_college_master_id;
        $data_result['master_flg'] = $master_flg;
        return $data_result;      
	}

	 public function get_attendance($id)
    {    
      
        $res_array = array();
        $id = $id;        
        if($id)
        {
         
          $student_res =DB::table('student')->where(array('id'=>$id,'is_deleted'=> 0))->get();        
          //$student_status = $student_res[0]->login_count;

          if(count($student_res) > 0)
          { 

           // $department_id = $student_res[0]->class_courseid;
            $school_collegeid = $student_res[0]->school_collegeid;
            $department_id = $student_res[0]->department_id;
            $mediumid = $student_res[0]->mediumid;
            $class_id = $student_res[0]->class_courseid;

            $sub_count_attendance = 0;
            $sub_total = 0;
            $pp_tt = 0;
            $tt_percent = 0;


            $date = date('Y-m-d');
            $sub_res = DB::table('assign_subject')
            ->selectRaw('assign_subject.* ,count( chapter_subject_rel.assign_subject_id) as lacture_count ')
            ->join('chapter_subject_rel', 'chapter_subject_rel.assign_subject_id', '=', 'assign_subject.id', 'left outer')
            //->where('chapter_masters.release_date', '<=', date('Y-m-d'))
            ->where(array('assign_subject.school_collegeid'=>$school_collegeid,'assign_subject.deptid'=>$department_id,'assign_subject.mediumid'=>$mediumid,'assign_subject.class_id'=>$class_id,'assign_subject.is_deleted'=> 0,'chapter_subject_rel.is_deleted'=> 0))  
            ->groupBy('assign_subject.id')->get(); 
            $cc = 0;

            $cc = count($sub_res);
             $str_arr ='<table class="table table-striped">';
              $str_arr .='<tr> <th>Subject name </th>  <th> View / Total lecture </th>  <th> Percentage</th> </tr>';

            foreach ($sub_res as $key => $value) 
            {

                $chapter_res = DB::table('student_attendance')
                ->select('student_attendance.stud_id','assign_subject.subject_name','chapter_masters.chapter_title','chapter_masters.release_date','chapter_masters.chapter_desc')
                ->leftJoin('chapter_masters', 'chapter_masters.id', '=', 'student_attendance.chapter_id')
                ->leftJoin('assign_subject', 'assign_subject.id', '=', 'chapter_masters.assign_subjectid')
                ->where(array('student_attendance.stud_id' => $id,'assign_subject.subject_id'=>$value->subject_id))
                ->groupBy('student_attendance.chapter_id')
                ->get();

                $count_attendance = count($chapter_res);
                $total_lecture = $value->lacture_count;

                if($total_lecture != 0){
                    $att_percent =   $count_attendance * 100 / $total_lecture;
                }else{
                    $att_percent = 0 ;
                }

                 $round_percent = number_format($att_percent, 2, '.', '');

                $res_array[] = array('count_attendance'=>$count_attendance,'subject_name'=>$value->subject_name,'total_lecture'=>$total_lecture,'percentage'=>$round_percent);  

                $str_arr .= '<tr><td>'.$value->subject_name.'</td> <td> '.$count_attendance.' / '. $total_lecture.' </td> <td> '.$round_percent.'% </td></tr>';


                $sub_total += $total_lecture ;  
                $sub_count_attendance += count($chapter_res);
                $pp_tt += $att_percent;
                //$cc ++;                

           }
          
           if($cc != 0 && $pp_tt != 0){
                //$tt_percent = $pp_tt/ $cc; // 53 / 25
                 $tt_percent = ($sub_count_attendance*100)/ $sub_total; // 53 / 25
            }else{
                $tt_percent =0;
            }

            $total_round_per = number_format($tt_percent, 2, '.', '');

           $avg_data = array('sub_total_lacture'=>$sub_total,'total_attendance'=>$sub_count_attendance,'total_percent'=>$total_round_per,'percentage_sum'=>$pp_tt,'total_subject_count'=>$cc);

            $str_arr .= '<tr class="table-primary" ><td> <strong> Total attendance  </strong> </td> <td>'.$sub_count_attendance.' / '. $sub_total.'</td> <td>'.$total_round_per.'% </td></tr>';
            $str_arr .='</table>';
          // print_r($avg_data);  
          //  dd($res_array);
           // $data['str_data'] = $str_arr;
            $data['sum_average_attendance'] = $avg_data;
            $data['subject_details_attendance'] = $res_array;

           
          }else{
            $msg = 'Student not login amd view videos'; 

          }  

         return json_encode($data);          
              
         // return $data;
          //return $active;
        }
  }

}
