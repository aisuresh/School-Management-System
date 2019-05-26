<?php
class Hostelfees extends Controller 
{

	var $pageinfo;
	var $pyear;
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
		$this->load->library('form_validation');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Hostel Fees');
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
		$config['base_url'] = base_url() . 'hostelfees/listview/' . $this->pyear;
		$table = 'hostelfees';
		
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'HostelFeeId';
		$this->session->set_userdata('yearhf', $this->pyear);
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear ),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelfees/list', $data);
		$this->load->view('footer');
	}
	
	function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$table = 'hostelfees';
		$where = array(
			array('condition' => $table.'.HostelFeeId', 'value' => $id)
		);
		
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$where = array();
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('hostelfees/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'course';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		//$table = 'academicyear';
		//$data['years'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('hostelfees/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
		$table = 'hostelfees';
		$data = array(
		   'ClassId' => $this->input->post('Class'),
		   'HostelFees' => $this->input->post('HostelFees'),
		   'Year' => $this->input->post('Year'),
			'InstituteId' => $this->session->userdata('InstituteId')        
		);
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $this->input->post('Class')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		
		//print_r($result);exit;
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('Class', 'Class', 'required');
			$this->form_validation->set_rules('HostelFees', 'Hostel Fees', 'required');
			//$this->form_validation->set_rules('Year', 'Year', 'required');
					
			if ($this->form_validation->run() == true)
			{
				$status = $this->Adminmodel->save_data($data, $table);
				echo $status;
			}else{
				//$this->listview();
				}
			}else{
					echo 2;
		}	
	}
	
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('Class', 'Class', 'required');
		$this->form_validation->set_rules('HostelFees', 'Hostel Fees', 'required');
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
		
		
		//$table = 'academicyear';
		//$data['years'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'hostelfees';
		$field = 'HostelFeeId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('hostelfees/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$field = 'HostelFeeId';
		$id = $this->input->post('HostelFeeId');
		$table = 'hostelfees';
		$data = array(
		   'ClassId' => $this->input->post('Class'),
		   'HostelFees' => $this->input->post('HostelFees'),
		   'Year' => $this->input->post('Year')
        );$where = array(
			array('condition' => $table.'.ClassId', 'value' => $this->input->post('Class')),
			array('condition' => $table.'.HostelFees', 'value' => $this->input->post('HostelFees')),
			array('condition' => $table.'.Year', 'value' => $this->input->post('Year')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('Class', 'Class', 'required');
			//$this->form_validation->set_rules('HostelFees', 'Hostel Fees', 'required');
			//$this->form_validation->set_rules('Year', 'Year', 'required');
					
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
		
			/*	$this->load->library('form_validation');
		$this->form_validation->set_rules('Class', 'Class', 'required');
		$this->form_validation->set_rules('HostelFees', 'Hostel Fees', 'required');
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
        header("Content-Disposition: attachment; filename = HostelFees.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'hostelfees';
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where );
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Academic Year</th>";
		echo "<th align='center' >Class</th>";
		echo "<th align='center' >Hostel Fees</th>";
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
		echo "<td align='center'>" . $row->ClassName . "</td>";
		echo "<td align='center'>" . $row->HostelFees . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

