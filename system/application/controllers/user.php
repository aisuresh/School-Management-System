<?php
class User extends Controller 
{

	var $pageinfo;
	var $url;
	
	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		//if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
		$this->load->library('table');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
		$this->load->library('pagination');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Users');
		$this->input->post();
	}
	
	function listview()
	{
	
	    $table = 'user';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'user/listview';
		
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'UserNo';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId' , 'value' => $this->session->userdata('InstituteId'))
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records(100, $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$data['links'] = $this->pagination->create_links();
		$table = 'roll';
		$where = array(
					array( 'condition' => $table.'.InstituteId' , 'value' => $this->session->userdata('InstituteId'))
		);
		$data['rolltype'] = $this->Adminmodel->show_rows($table, $where);	
		//$data['pages'] = $page;
		$this->load->view('user/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'user';
		$data = array('event' => 'List', 'url' => base_url(), 'project' => 'School', 'pagetitle' => 'Users');
		$config['base_url'] = base_url() . 'user/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$data['page'] = $page;
	    $data['totalrows'] = $config['total_rows'];

	    $sort = (string)$this->input->post('sortkey');
	    $order = (string)$this->input->post('order');
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId' , 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'roll';
		$data['rolltype'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('user/list', $data);
	}
	
	function search_data(){
		$table = 'user';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Useres', 'event' => 'List view' );
		$config['base_url'] = base_url() . 'user/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$data['query'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('user/list', $data);
	}
	
	 function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
	$this->load->view('menu');
		$table = 'user';
		$id = $this->uri->segment(3);
		$where = array(
			 array('condition' => $table.'.UserNo', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
		$table = 'roll';
		$where = array();
		$data['roll'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('user/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'roll';
		$data['roll'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('user/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
		$table = 'user';
		$data = array(
		   'UserName' => $this->input->post('UserName'),
		   'UserId' => $this->input->post('UserId'),
		   'Password' => $this->input->post('Password'),
		   'RollId' => $this->input->post('UserTypeId'),
		   'UserDes' => $this->input->post('UserDes'),
		   'InstituteId' => $this->session->userdata('InstituteId')
        );
		$where = array(
			array('condition' => $table.'.UserName', 'value' => $this->input->post('UserName')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('UserName', 'User Name', 'required');
			$this->form_validation->set_rules('UserId', 'User Id', 'required');
			$this->form_validation->set_rules('Password', 'Password', 'required');
			$this->form_validation->set_rules('UserTypeId', 'Roll Id', 'required');
			
			if ($this->form_validation->run() == true)
			{
				$status = $this->Adminmodel->save_data($data, $table);
				echo $status;
			}else{
				$this->listview();
			}
		}else{
			echo 2;
		}
	}
		
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('UserName', 'User Name', 'required');
		$this->form_validation->set_rules('UserId', 'User Id', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('UserTypeId', 'Roll Id', 'required');
		if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->save_data($data, $table);
			echo $status;
		}else{
			$this->listview();
		}
	}*/
	
	function edit()
	{
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$table = 'user';
		$field = 'UserNo';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'roll';
		$data['roll'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('user/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'user';
		$field = 'UserNo';
		$id = $_POST['UserNo'];
		$data = array(
		   'UserName' => $this->input->post('UserName'),
		   'UserId' => $this->input->post('UserId'),
		   'Password' => $this->input->post('Password'),
		   'RollId' => $this->input->post('UserTypeId'),
		   'UserDes' => $this->input->post('UserDes')
		);
		$where = array(
			array('condition' => $table.'.UserName', 'value' => $this->input->post('UserName')),
			array('condition' => $table.'.UserId', 'value' => $this->input->post('UserId')),
			array('condition' => $table.'.Password', 'value' => $this->input->post('Password')),
			array('condition' => $table.'.RollId', 'value' => $this->input->post('UserTypeId')),
			array('condition' => $table.'.UserDes', 'value' => $this->input->post('UserDes')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('UserName', 'User Name', 'required');
			$this->form_validation->set_rules('UserId', 'User Id', 'required');
			$this->form_validation->set_rules('Password', 'Password', 'required');
			$this->form_validation->set_rules('UserTypeId', 'Roll Id', 'required');
			
			if ($this->form_validation->run() == true)
			{
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
				echo $status;
			}else{
				$this->listview();
			}
		}else{
			echo 2;
		}
	}
		/*
		$this->load->library('form_validation');
		$this->form_validation->set_rules('UserName', 'User Name', 'required');
		$this->form_validation->set_rules('UserId', 'User Id', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('UserTypeId', 'Roll Id', 'required');
		if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			echo $status;
		}else{
			$this->listview();
		}
	}*/
	
	function export()
	{
		$table = 'user';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Useres.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >User Name</th>";
		echo "<th align='center' >User Id</th>";
		echo "<th align='center' >Password</th>";
		echo "<th align='center' >Roll Type</th>";
		echo "<th align='center' >Description</th>";
		echo "</tr>";
		$i= 1;
		foreach($result as $row):
		if($i % 2){
			$master_tr_bgcolor = 'background-color:#f8fcfc; border-right:1px solid #a4a9a8; padding-left:5px;';
		}else{
			$master_tr_bgcolor = 'background-color:#e4ebec; border-right:1px solid #a4a9a8; padding-left:5px;';
		}
		
		echo "<tr style='" . $master_tr_bgcolor . "'>";
		echo "<td style='padding:5px; text-align:center; ' >" . $i ++ . "</td>";  
		echo "<td align='center'>" . $row->UserName . "</td>";
		echo "<td align='center'>" . $row->UserId . "</td>";
		echo "<td align='center'>" . $row->Password . "</td>";
		echo "<td align='center'>" . $row->RollId . "</td>";
		echo "<td align='center'>" . $row->UserDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

