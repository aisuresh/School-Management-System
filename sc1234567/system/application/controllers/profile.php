<?php

class Profile extends Controller {

	var $pageinfo;
	var $url;
	function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->helper('url');
	    $this->load->library('parser');	
		$this->load->database();
		$this->load->model('Adminmodel');
		$this->url = base_url();
		$this->load->library('form_validation');
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url);
	}
	
	function changepassword()
	{
	    $this->pageinfo['pagetitle']='Profile';
		$this->pageinfo['event']='Change Password';
	    $this->parser->parse('header', $this->pageinfo);
		$this->load->view('menu');
	  	$this->load->view('profile/changepassword');
	  	$this->load->view('footer');
	}
	
	function save()
	{
	    $field = 'UserId';
		$Userid = $this->session->userdata('UserId');
		$data = array(
               'Password' => $this->input->post('NewPassword')   
         );
		 //print_r($data);exit;
	
		$table = 'user';
		$where = array(
			array('condition' => $table.'.UserId', 'value' => $this->session->userdata('UserId')),
			array('condition' => $table.'.Password', 'value' =>$this->input->post('OldPassword'))
		 );
	    $result = $this->Adminmodel->show_rows($table, $where);
		//print_r(count($result));
		if(isset($result) && count($result) > 0){
			$this->form_validation->set_rules('OldPassword', 'Old Password ', 'required');
			$this->form_validation->set_rules('NewPassword', 'New Password', 'required');
			if ($this->form_validation->run() == true) {
					$status = $this->Adminmodel->update_data($field, $Userid, $data, $table);
					echo $status;
			} else{
				//$this->listview();
			}
		}else{
			echo 2;
		}	
		
	}
	 function myprofile()
	{
	    $this->pageinfo['pagetitle']='Profile';
		$this->pageinfo['event']='View';
		$rollid = $this->session->userdata('RollId');
		$this->parser->parse('header', $this->pageinfo);
		$this->load->view('menu');
	  	if($rollid == '6' || $rollid == '7')
		{
			$table = 'student';
			$where = array(
				array('condition' => $table.'.StudentId', 'value' => $this->session->userdata('RNo'))
			);		
			$data['profile'] = $this->Adminmodel->show_rows($table, $where);
			$table = 'castcategory';
			$where = array(
				array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			);
			$data['castcategory'] = $this->Adminmodel->show_rows($table, $where);
			$table = 'nationality';
			$where = array(
						array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			);
			$data['nationality'] = $this->Adminmodel->show_rows($table, $where);			
	   
			$this->load->view('profile/student',$data); 
		}else{
			 $table = 'staff';
			 $where = array(
				array('condition' => $table.'.StaffId', 'value' => $this->session->userdata('RNo'))
			);
			$data['profile'] = $this->Adminmodel->show_rows($table, $where); 
			$table = 'stafftype';
		    $where = array(
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		    );
		    $data['stafftype'] = $this->Adminmodel->show_rows($table, $where);	
		    $table = 'qualification';
		    $where = array(
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		   );
		   $data['qualification'] = $this->Adminmodel->show_rows($table, $where);  
		   $this->load->view('profile/staff',$data); 
		}
	  	$this->load->view('footer');
	}
	
	
	function logout(){
		session_destroy();
		$this->load->library('session');
		$session_array = array('username' => '', 'rollid' => '', 'schoolid' => '', 'database' => '');
		$this->session->unset_userdata($session_array);
		$this->session->sess_destroy();
		//echo('sfsf: '.$this->session->userdata('rollid'));
		redirect('login/index');exit;
	}
		
	function home()
	{
		  $data = array(
			'title' => 'SCHOOL'
		  );
		  $this->parser->parse('header');
		  $this->load->view('menu');
		  $this->load->view('home');
		  $this->load->view('footer');
	}
	
}

/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */