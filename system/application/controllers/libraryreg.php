<?php
class Libraryreg extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Library Register');
		$this->input->post();
	}
	
	function listview()
	{
		
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$table = 'libraryreg';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = $this->url . 'libraryreg/listview';
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'LibraryId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			);
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
				 	array('condition' => $table.'.Year', 'value' => $year)
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring,    	
		$sortby, $where);
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$this->data['pages'] = $page;
		$this->load->view('libraryreg/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$table = 'libraryreg';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Register', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'libraryreg/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			);
		$where = array(
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			 	array('condition' => $table.'.Year', 'value' => $year)
		);		
		//$where=array();
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('libraryreg/list', $data);
	}
	
	function search_data(){
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'libraryreg';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Register', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'libraryreg/listview';
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
		$sortby = 'LibraryId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			);
	    $where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.Year', 'value' => $year)
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('libraryreg/list', $data);
	}
	
	 function view()
	{
		$table = 'libraryreg';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.LibraryId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray=array(), $where);
		$where = array();
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('libraryreg/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'student';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('libraryreg/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
	  $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				 $year = $yno->AcademicYear; 
			}
		}
		$table = 'libraryreg';
		$data = array(
			'InstituteId' => $this->session->userdata('InstituteId'),
		   'LibraryNo' => $this->input->post('LibraryNo'),
		   'StudentId' => $this->input->post('StudentId'),
		   'Year' => $year,
		   'LibraryDes' => $this->input->post('LibraryDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			//array('condition' => $table.'.LibraryNo', 'value' => $this->input->post('LibraryNo')),
			array('condition' => $table.'.StudentId', 'value' => $this->input->post('StudentId'))
			
			
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('LibraryNo', 'Library No', 'required');
			$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		
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
		$this->form_validation->set_rules('LibraryNo', 'Library No', 'required');
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		
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
		$table = 'libraryreg';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'LibraryId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('libraryreg/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
	   $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				 $year = $yno->AcademicYear; 
			}
		}
		$table = 'libraryreg';
		$field = 'LibraryId';
		$id = $this->input->post('LibraryId');
		$data = array(
		   'LibraryNo' => $this->input->post('LibraryNo'),
		   'StudentId' => $this->input->post('StudentId'),
		   'Year' => $year,
		   'LibraryDes' => $this->input->post('LibraryDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.LibraryNo', 'value' => $this->input->post('LibraryNo')),
			array('condition' => $table.'.StudentId', 'value' => $this->input->post('StudentId')),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.LibraryDes', 'value' => $this->input->post('LibraryDes'))
			
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('LibraryNo', 'Library No', 'required');
			$this->form_validation->set_rules('StudentId', 'Student Id ', 'required');
		
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
		$this->form_validation->set_rules('LibraryNo', 'Library No', 'required');
		$this->form_validation->set_rules('StudentId', 'Student Id ', 'required');
		
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
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'libraryreg';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = LibraryRegisters.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		/*$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);*/
		//$result = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where );
		$result=$this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Library No</th>";
		echo "<th align='center' >Student Id</th>";
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
		echo "<td align='center'>" . $row->LibraryNo . "</td>";
		echo "<td align='center'>" . $row->StudentId . "</td>";
		echo "<td align='center'>" . $row->LibraryDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

