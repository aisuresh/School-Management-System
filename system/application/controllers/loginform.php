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
		$this->load->model('Loginmodel');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url);
	}
	
	function index()
	{
	   
	  	$this->parser->parse('headerlogin', $this->pageinfo);
	  	$this->load->view('menu1');
	  	$this->load->view('loginform/view');
	  	$this->load->view('footer');
	}
	
	function user()
	{
		//$this->output->enable_profiler();
		$oldp = $this->input->post('oldp','oldp', 'required');
		$userpd = $this->input->post('UserNo', 'UserNo', 'required');
		$table = 'user';
		if(!empty($oldp))
		{
			$where = array(
				//array('condition' => $table.'.UserId', 'value' => $userid),
				array('condition' => $table.'.Password', 'value' => $oldp)
			);
			$flag = $this->Loginmodel->user_login($table, $where);
			if($flag == true)
			{
				$where = array(
					array('condition' => $table.'.UserNo', 'value' => $userid),
				);
				$tableArray = array(
					//array('TableName' => 'schoollist', 'CompairField' => $table.'.SchoolId=schoollist.SchoolId')
				);
				$result = $this->Loginmodel->fetch_row($table, $tableArray, $where); //print_r($this->db->last_query()); exit();
				//print_r($result);
				foreach($result as $row){
					//$_SESSION['username'] = $row->UserName; 
					$this->session->set_userdata('username', $row->UserName);
					$this->session->set_userdata('rollid', $row->RollId);
					//$this->session->set_userdata('schoolid', $row->SchoolId);
					//$this->session->set_userdata('logopath', $row->LogoPath);
					//$this->session->set_userdata('database', $row->DatabaseName);
				    $this->session->set_userdata('InstituteId', $row->InstituteId);
				}
				echo $this->url.'home/listview';
			}else{
				echo 'error';
			}
		}else{
			echo 'error';
		}	
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