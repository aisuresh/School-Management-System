<?php
class ExpenditureType extends Controller 
{

	var $pageinfo;
	var $url;
	var $pyear;
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
		$this->load->library('form_validation');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Expenditure Type');
		$this->input->post();
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
	
		//$this->data['years'] = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
	}
	
	function listview()
	{
		
		/*$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}*/
		
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'expendituretype/listview/' . $this->pyear;
		$table = 'expendituretype';
		
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearcf', $this->pyear);
		$sortby = 'ExpenditureTypeId';
		
		$where = array(
						array('condition' => $table.'.Year', 'value' => $this->pyear),
						array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray=array(), $searchoption , $searchstring, $sortby, $where);
		
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
			
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('expendituretype/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Register', 'url' => $this->url, 'event' => 'List view' );
		$table = 'classfees';
		$config['base_url'] = base_url() . 'libraryreg/listview' . $this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sort = $this->input->post('sortkey');
		$order = $this->input->post('order');
		$this->session->set_userdata('yearsh', $this->pyear);
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		
		/*$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}*/
		
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('classfees/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Register', 'url' => $this->url, 'event' => 'List view' );
		$table = 'classfees';
		$config['base_url'] = base_url() . 'classfees/listview' . $this->pyear;
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
		$this->session->set_userdata('yearsh', $this->pyear);
		
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('classfees/list', $data);
	}
	
	 function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$table = 'expendituretype';
		$where = array(
			array('condition' => $table.'.ExpenditureTypeId', 'value' => $id)
		);
		
		/*$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);*/
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray=array(), $where);
		$where = array();
		//$table = 'student';
		//$data['rollno'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('expendituretype/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$data['expendituretype'] = $this->Adminmodel->show_rows($table, $where);
		//$table = 'academicyear';
		//$data['years'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('expendituretype/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
	    /*$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}*/
		
		$table = 'expendituretype';
		$data = array(
		   'ExpenditureType' => $this->input->post('ExpenditureType'),
		   'ExpenditureUnder' => $this->input->post('ExpenditureUnder'),
		   'Description' => $this->input->post('Description'),
		   'Year' => $this->input->post('Year'),
		   'InstituteId' => $this->session->userdata('InstituteId')
        );
		$where = array(
			array('condition' => $table.'.ExpenditureType', 'value' => $this->input->post('ExpenditureType')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('ExpenditureUnder', 'ExpenditureUnder', 'required');
			$this->form_validation->set_rules('ExpenditureType', 'ExpenditureType', 'required');
			$this->form_validation->set_rules('Description', 'Description', 'required');
			$this->form_validation->set_rules('Year', 'Year', 'required');
					
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
		$this->form_validation->set_rules('Class', 'Class', 'required');
		$this->form_validation->set_rules('ClassFees', 'Class Fees', 'required');
		$this->form_validation->set_rules('Year', 'Year', 'required');
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
		
		$table = 'expendituretype';
		$field = 'ExpenditureTypeId';
	    $data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('expendituretype/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$field = 'ExpenditureTypeId';
		$id = $this->input->post('ExpenditureTypeId');
		$table = 'expendituretype';
		$data = array(
		   'ExpenditureType' => $this->input->post('ExpenditureType'),
		   'ExpenditureUnder' => $this->input->post('ExpenditureUnder'),
		   'Description' => $this->input->post('Description'),
		   'Year' => $this->input->post('Year')
        );
		//print_r($data);
		$where = array(
			array('condition' => $table.'.ExpenditureType', 'value' => $this->input->post('ExpenditureType')),
			array('condition' => $table.'.ExpenditureUnder', 'value' => $this->input->post('ExpenditureUnder')),
			array('condition' => $table.'.Description', 'value' => $this->input->post('Description')),
			array('condition' => $table.'.Year', 'value' => $this->input->post('Year')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('ExpenditureUnder', 'ExpenditureUnder', 'required');
			$this->form_validation->set_rules('ExpenditureType', 'ExpenditureType', 'required');
			$this->form_validation->set_rules('Description', 'Description', 'required');
			$this->form_validation->set_rules('Year', 'Year', 'required');
					
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
		$this->form_validation->set_rules('Class', 'Class', 'required');
		$this->form_validation->set_rules('ClassFees', 'Class Fees', 'required');
		$this->form_validation->set_rules('Year', 'Year', 'required');
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
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = ExpenditureType.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'expendituretype';
		/*$tableArray = array(
			array('TableName' => 'expendituretype', 'CompairField' => 'expendituretype.ExpenditureTypeId=expenditure.ExpenditureTypeId'),
		);*/
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray=array(), $where );
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >ExpenditureType</th>";
		echo "<th align='center' >ExpenditureUnder</th>";
		echo "<th align='center' >Description</th>";
		echo "<th align='center' >Year</th>";
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
		echo "<td align='center'>" . $row->ExpenditureType . "</td>";
		echo "<td align='center'>" . $row->ExpenditureUnder . "</td>";
		echo "<td align='center'>" . $row->Description . "</td>";
		echo "<td align='center'>" . $row->Year . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

