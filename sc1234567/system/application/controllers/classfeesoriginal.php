<?php
class Classfees extends Controller 
{

	var $pageinfo;
	var $url;
	var $data;
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Class Fees');
		$this->input->post();
		$this->data['years'] = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
	}
	
	function listview()
	{
		
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'classfees';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'classfees/listview';
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
	
		$sortby = 'ClassFeeId';
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$where = array(
						array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('classfees/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Register', 'url' => $this->url, 'event' => 'List view' );
		$table = 'classfees';
		$config['base_url'] = base_url() . 'libraryreg/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sort = $this->input->post('sortkey');
		$order = $this->input->post('order');
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
		
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('classfees/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Register', 'url' => $this->url, 'event' => 'List view' );
		$table = 'classfees';
		$config['base_url'] = base_url() . 'classfees/listview';
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
		$table = 'classfees';
		$where = array(
			array('condition' => $table.'.ClassFeeId', 'value' => $id)
		);
		
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$where = array();
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('classfees/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'academicyear';
		$data['years'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('classfees/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
		$table = 'classfees';
		$data = array(
		   'ClassId' => $this->input->post('Class'),
		   'ClassFees' => $this->input->post('ClassFees'),
		   'Year' => $this->input->post('Year'),
		   'InstituteId' => $this->session->userdata('InstituteId')
        );
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $this->input->post('Class')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
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
		
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$table = 'academicyear';
		$data['years'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'classfees';
		$field = 'ClassFeeId';
	    $data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('classfees/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$field = 'ClassFeeId';
		$id = $this->input->post('ClassFeeId');
		$table = 'classfees';
		$data = array(
		   'ClassId' => $this->input->post('Class'),
		   'ClassFees' => $this->input->post('ClassFees'),
		   'Year' => $this->input->post('Year')
        );
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $this->input->post('Class')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
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
        header("Content-Disposition: attachment; filename = ClassFees.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'classfees';
		/*$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where );*/
		$result=$this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Academic Year</th>";
		//echo "<th align='center' >Class</th>";
		echo "<th align='center' >Class Fees</th>";
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
		echo "<td align='center'>" . $row->Year . "</td>";
		//echo "<td align='center'>" . $row->ClassName . "</td>";
		echo "<td align='center'>" . $row->ClassFees . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

