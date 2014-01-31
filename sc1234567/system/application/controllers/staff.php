<?php
class Staff extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Staff');
		$this->input->post();
	}
	
	function listview()
	{
		$table = 'staff';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'staff/listview';
		
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'StaffId';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
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
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('staff/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'staff';
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Staff', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'staff/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$tableArray = array();
		$where = array(
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
				
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
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
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('staff/list', $data);
	}
	
	function search_data(){
		$table = 'staff';
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Staff', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'staff/listview';
                $searchoption = ''; $searchstring = '';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
			$config['total_rows'] = $this->Adminmodel->record_count($table, $searchoption, $searchstring);
		}
		
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'StaffId';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, 				         $sortby, $where);
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
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('staff/list', $data);
	}
	
	 function view()
	{
		$table = 'staff';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.StaffId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
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
		$this->load->view('staff/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'stafftype';
		$data['stafftype'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'qualification';
		$where = array(
			array('condition' => $table.'.course', 'value' => 'UG')
		);
		$data['qualification'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'qualification';
		$where = array(
			array('condition' => $table.'.course', 'value' => 'PG')
		);
		$data['qualification1'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'qualification';
		$where = array(
			array('condition' => $table.'.course', 'value' => 'Others')
		);
		$data['qualification2'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where=array());
		$this->load->view('staff/addnew', $data);
		$this->load->view('footer');
	}
	function branch()
	{
		$table = 'branch';
	    $row = $this->input->post('Course');
		
		$where = array(
		 	array('condition' => $table.'.qualificationId', 'value' => $row),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		 );
	    
		 $tjoin = array(
		 	array('TableName' => 'qualification', 'Condition' => $table.'.qualificationId = qualification.QualificationId'),
		 );
		 $data['branch'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 echo '<option value="x" >-- Select branch --</option>';
	   foreach( $data['branch']  as $rno ){
		echo '<option value="'.$rno->qualificationid.'" >'.$rno->branch.'</option>';
	 }
	 }
	function examtype()
	{
		$table = 'exam';
		$field = 'ExamId';
		$id = $_POST['ExamTypeId'];
		$data = $this->Adminmodel->fetch_row($field, $id, $table);
		foreach($data as $row ){
			echo $row->ExamMarks;
		}
	}
	
	function save()
	{	
		$table = 'staff';
		$DateOfBirth = date("Y-m-d", strtotime($this->input->post('DateOfBirth')));
		$data = array(
		   'InstituteId' => $this->session->userdata('InstituteId'),
		   'StaffName' => $this->input->post('StaffName'),
		   'StaffTypeId' => $this->input->post('StaffTypeId'),
		   'Gender' => $this->input->post('Gender'),
		   'DateOfBirth' => $DateOfBirth,
		   'QualificationId' => $this->input->post('Qualification'),
		   'TotalExperiance' => $this->input->post('Experiance'),
		   'Month' => $this->input->post('Months'),
		   'JobType'=> $this->input->post('jobtype'),
		   'Subject01' => $this->input->post('Subject01'),
		   'Subject02' => $this->input->post('Subject02'),
		   'Subject03' => $this->input->post('Subject03'),
		   'PhoneNo' => $this->input->post('PhoneNo'),
		   'MobileNo' => $this->input->post('MobileNo'),
		   'Email' => $this->input->post('Email'),
		   'Town' => $this->input->post('Town'),
		   'Address' => $this->input->post('Address'),
		   'Status' => $this->input->post('Status'),
		   'StaffDes' => $this->input->post('StaffDes')
	   );
	   $where = array(
			array('condition' => $table.'.StaffName', 'value' => $this->input->post('StaffName')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);

		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('StaffName', 'Staff Name', 'required');
			$this->form_validation->set_rules('StaffTypeId', 'Staff Type Id', 'required');
			$this->form_validation->set_rules('Gender', 'Gender', 'required');
			$this->form_validation->set_rules('DateOfBirth', 'DateOfBirth', 'required');
			$this->form_validation->set_rules('Qualification', 'Qualification', 'required');
			$this->form_validation->set_rules('Experiance', 'Experiance', 'required');
			$this->form_validation->set_rules('Subject01', 'Subject01', 'required');
			$this->form_validation->set_rules('jobtype', 'job type', 'required');
			$this->form_validation->set_rules('MobileNo', 'Mobile No', 'required');
			//$this->form_validation->set_rules('Email', 'Email', 'required');
			$this->form_validation->set_rules('Town', 'Town', 'required');
			$this->form_validation->set_rules('Address', 'Address', 'required');
			$this->form_validation->set_rules('Status', 'Status', 'required');
			
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
		
	
	
	function edit()
	{
		$table = 'staff';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'StaffId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'stafftype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['stafftype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'qualification';
		$where = array(
		            array('condition' => $table.'.course', 'value' => 'UG'),
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['qualification'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'qualification';
		$where = array(
		            array('condition' => $table.'.course', 'value' => 'PG'),
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['qualification1'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'qualification';
		$where = array(
			array('condition' => $table.'.course', 'value' => 'Others')
		);
		$data['qualification2'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['subject'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('staff/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'staff';
		$field = 'StaffId';
		$id = $this->input->post('StaffId');
		$DateOfBirth = date("Y-m-d", strtotime($this->input->post('DateOfBirth')));
		$data = array(
		   'StaffName' => $this->input->post('StaffName'),
		   'StaffTypeId' => $this->input->post('StaffTypeId'),
		   'Gender' => $this->input->post('Gender'),
		   'DateOfBirth' => $DateOfBirth,
		   'QualificationId' => $this->input->post('Qualification'),
		   'TotalExperiance' => $this->input->post('Experiance'),
		   'Month' => $this->input->post('Months'),
		   'JobType'=> $this->input->post('jobtype'),
		   'Subject01' => $this->input->post('Subject01'),
		   'Subject02' => $this->input->post('Subject02'),
		   'Subject03' => $this->input->post('Subject03'),
		   'PhoneNo' => $this->input->post('PhoneNo'),
		   'MobileNo' => $this->input->post('MobileNo'),
		   'Email' => $this->input->post('Email'),
		   'Town' => $this->input->post('Town'),
		   'Address' => $this->input->post('Address'),
		   'Status' => $this->input->post('Status'),
		   'StaffDes' => $this->input->post('StaffDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StaffName', 'value' => $this->input->post('StaffName')),
			array('condition' => $table.'.StaffTypeId', 'value' => $this->input->post('StaffTypeId')),
			array('condition' => $table.'.Gender', 'value' => $this->input->post('Gender')),
			array('condition' => $table.'.DateOfBirth', 'value' => $this->input->post('DateOfBirth')),
			array('condition' => $table.'.QualificationId', 'value' => $this->input->post('Qualification')),
			array('condition' => $table.'.TotalExperiance', 'value' => $this->input->post('Experiance')),
			array('condition' => $table.'.JobType', 'value' => $this->input->post('jobtype')),
			array('condition' => $table.'.Subject01', 'value' => $this->input->post('Subject01')),
			array('condition' => $table.'.Subject02', 'value' => $this->input->post('Subject02')),
			array('condition' => $table.'.Subject03', 'value' => $this->input->post('Subject03')),
			array('condition' => $table.'.PhoneNo', 'value' => $this->input->post('PhoneNo')),
			array('condition' => $table.'.MobileNo', 'value' => $this->input->post('MobileNo')),
			array('condition' => $table.'.Email', 'value' => $this->input->post('Email')),
			array('condition' => $table.'.Town', 'value' => $this->input->post('Town')),
			array('condition' => $table.'.Address', 'value' => $this->input->post('Address')),
			array('condition' => $table.'.Status', 'value' => $this->input->post('Status')),
			array('condition' => $table.'.StaffDes', 'value' => $this->input->post('StaffDes'))
			
		);
		$result = $this->Adminmodel->show_rows($table, $where);

		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('StaffName', 'Staff Name', 'required');
			$this->form_validation->set_rules('StaffTypeId', 'Staff Type Id', 'required');
			$this->form_validation->set_rules('Gender', 'Gender', 'required');
			$this->form_validation->set_rules('DateOfBirth', 'DateOfBirth', 'required');
			$this->form_validation->set_rules('Qualification', 'Qualification', 'required');
			$this->form_validation->set_rules('Experiance', 'Experiance', 'required');
			$this->form_validation->set_rules('Subject01', 'Subject01', 'required');
			$this->form_validation->set_rules('jobtype', 'job type', 'required');
			$this->form_validation->set_rules('MobileNo', 'Mobile No', 'required');
			//$this->form_validation->set_rules('Email', 'Email', 'required');
			$this->form_validation->set_rules('Town', 'Town', 'required');
			$this->form_validation->set_rules('Address', 'Address', 'required');
			$this->form_validation->set_rules('Status', 'Status', 'required');
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
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('StaffName', 'Staff Name', 'required');
		$this->form_validation->set_rules('StaffTypeId', 'Staff Type Id', 'required');
		$this->form_validation->set_rules('Qualification', 'Qualification', 'required');
		$this->form_validation->set_rules('Experiance', 'Experiance', 'required');
		$this->form_validation->set_rules('Subject01', 'Subject01', 'required');
		$this->form_validation->set_rules('Subject02', 'Subject02', 'required');
		$this->form_validation->set_rules('Subject03', 'Subject03', 'required');
		$this->form_validation->set_rules('Subject04', 'Subject04', 'required');
		$this->form_validation->set_rules('PhoneNo', 'Phone No', 'required');
		$this->form_validation->set_rules('MobileNo', 'Mobile No', 'required');
		$this->form_validation->set_rules('Email', 'Email', 'required');
		$this->form_validation->set_rules('Town', 'Town', 'required');
		$this->form_validation->set_rules('Address', 'Address', 'required');
		$this->form_validation->set_rules('Status', 'Status', 'required');
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
		$table = 'staff';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Staff.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$tableArray= array(
						array('TableName' => 'stafftype', 'CompairField' => 'stafftype.StaffTypeId=staff.StaffTypeId'),
						array('TableName' => 'qualification', 'CompairField' => 'qualification.QualificationId=staff.QualificationId')
						//array('TableName' => 'qualification', 'CompairField' => 'qualification.QualificationId=staff.QualificationId'),
		);
	$result = $this->Adminmodel->fetch_row($table, $tableArray, $where=array());
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Staff Name</th>";
		echo "<th align='center' >Roll</th>";
		echo "<th align='center' >Gender</th>";
		echo "<th align='center' >DateOfBirth</th>";
		echo "<th align='center' >Qualification</th>";
		echo "<th align='center' >TotalExperiance</th>";
		echo "<th align='center' >Month</th>";
		echo "<th align='center' >JobType</th>";
		echo "<th align='center' >Subject01</th>";
		echo "<th align='center' >Subject02</th>";
		echo "<th align='center' >Subject03</th>";
		echo "<th align='center' >PhoneNo</th>";
		echo "<th align='center' >MobileNo</th>";
		echo "<th align='center' >Email</th>";
		echo "<th align='center' >Town</th>";
		echo "<th align='center' >Address</th>";
		echo "<th align='center' >Status</th>";
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
		echo "<td style='padding:5px; text-align:center; ' >" . $i++ . "</td>";  
		echo "<td align='center'>" . $row->StaffName . "</td>";
		echo "<td align='center'>" . $row->StaffType . "</td>";
		echo "<td align='center'>" . $row->Gender . "</td>";
		echo "<td align='center'>" . $row->DateOfBirth . "</td>";
		echo "<td align='center'>" . $row->graduation . "</td>";
		echo "<td align='center'>" . $row->TotalExperiance . "</td>";
		echo "<td align='center'>" . $row->Month . "</td>";
		echo "<td align='center'>" . $row->JobType . "</td>";
		echo "<td align='center'>" . $row->Subject01 . "</td>";
		echo "<td align='center'>" . $row->Subject02 . "</td>";
		echo "<td align='center'>" . $row->Subject03 . "</td>";
		echo "<td align='center'>" . $row->PhoneNo . "</td>";
		echo "<td align='center'>" . $row->MobileNo . "</td>";
		echo "<td align='center'>" . $row->Email . "</td>";
		echo "<td align='center'>" . $row->Town . "</td>";
		echo "<td align='center'>" . $row->Address . "</td>";
		echo "<td align='center'>" . $row->Status . "</td>";
		echo "<td align='center'>" . $row->StaffDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

