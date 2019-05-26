<?php
class Expenditure extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Expenditure');
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
		$config['base_url'] = base_url() . 'expenditure/listview/' . $this->pyear;
		$table = 'expenditure';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearcf', $this->pyear);
		$sortby = 'ExpenditureId';
		/*$tableArray = array(
			array('TableName' => 'expendituretype', 'CompairField' => 'expendituretype.ExpenditureTypeId = expenditure.ExpenditureTypeId' )
		);*/
		$where = array(
						array('condition' => $table.'.Year', 'value' => $this->pyear),
						array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray=array(), $searchoption , $searchstring, $sortby, $where);
		
		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['expendituretype'] = $this->Adminmodel->show_rows($table, $where);
		
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('expenditure/list', $data);
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
		$table = 'expenditure';
		$where = array(
			array('condition' => $table.'.ExpenditureId', 'value' => $id)
		);
		
		/*$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);*/
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray=array(), $where);
		$where = array();
		$table = 'expendituretype';
		$data['expendituretype'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('expenditure/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'expenditure';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['expenditure'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.ExpenditureUnder', 'value' => 'Administrative')
		);
		$data['expenditure1'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.ExpenditureUnder', 'value' => 'Financial')
		);
		$data['expenditure2'] = $this->Adminmodel->show_rows($table, $where);

		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.ExpenditureUnder', 'value' => 'Maintenance')
		);
		
		$data['expenditure3'] = $this->Adminmodel->show_rows($table, $where);
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('expenditure/addnew', $data);
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
		
		$table = 'expenditure';
		$BillDate = date("Y-m-d", strtotime($this->input->post('BillDate')));
		$data = array(
		   'ExpenditureTypeId' => $this->input->post('ExpenditureTypeId'),
		   'BillNo' => $this->input->post('BillNo'),
		   'BillAmount' => $this->input->post('BillAmount'),
		   'BillDate' => $BillDate,
		   'SpentBy' => $this->input->post('SpentBy'),
		   'Justification' => $this->input->post('Justification'),
		   'Year' => $this->input->post('Year'),
		   'InstituteId' => $this->session->userdata('InstituteId')
        );
		//print_r($data);
		$where = array(
			array('condition' => $table.'.ExpenditureTypeId', 'value' => $this->input->post('ExpenditureTypeId')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('ExpenditureTypeId', 'ExpenditureTypeId', 'required');
			$this->form_validation->set_rules('BillNo', 'BillNo', 'required');
			$this->form_validation->set_rules('BillAmount', 'BillAmount', 'required');
			$this->form_validation->set_rules('BillDate', 'BillDate', 'required');
			$this->form_validation->set_rules('SpentBy', 'SpentBy', 'required');
			$this->form_validation->set_rules('Justification', 'Justification', 'required');
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
		$data['expendituretype'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'expenditure';
		$field = 'ExpenditureId';
	    $data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.ExpenditureUnder', 'value' => 'Administrative')
		);
		$data['expenditure1'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.ExpenditureUnder', 'value' => 'Financial')
		);
		$data['expenditure2'] = $this->Adminmodel->show_rows($table, $where);

		$table = 'expendituretype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					array('condition' => $table.'.ExpenditureUnder', 'value' => 'Maintenance')
		);
		$data['expenditure3'] = $this->Adminmodel->show_rows($table, $where);
		
		
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('expenditure/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$field = 'ExpenditureId';
		$id = $this->input->post('ExpenditureId');
		$BillDate = date("Y-m-d", strtotime($this->input->post('BillDate')));
		$table = 'expenditure';
		$data = array(
		   'ExpenditureTypeId' => $this->input->post('ExpenditureTypeId'),
		   'BillNo' => $this->input->post('BillNo'),
		   'BillAmount' => $this->input->post('BillAmount'),
		   'BillDate' => $BillDate ,
		   'SpentBy' => $this->input->post('SpentBy'),
		   'Justification' => $this->input->post('Justification'),
		   'Year' => $this->input->post('Year')
        );
		//print_r($data);
		$where = array(
			array('condition' => $table.'.ExpenditureTypeId', 'value' => $this->input->post('ExpenditureTypeId')),
			array('condition' => $table.'.BillNo', 'value' => $this->input->post('BillNo')),
			array('condition' => $table.'.BillAmount', 'value' => $this->input->post('BillAmount')),
			array('condition' => $table.'.BillDate', 'value' => $BillDate ),
			array('condition' => $table.'.SpentBy', 'value' => $this->input->post('SpentBy')),
			array('condition' => $table.'.Justification', 'value' => $this->input->post('Justification')),
			array('condition' => $table.'.Year', 'value' => $this->input->post('Year')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('ExpenditureTypeId', 'Expenditure Type Id', 'required');
			$this->form_validation->set_rules('BillNo', 'Bill No', 'required');
			$this->form_validation->set_rules('BillAmount', 'Bill Amount', 'required');
			$this->form_validation->set_rules('BillDate', 'Bill Date', 'required');
			$this->form_validation->set_rules('SpentBy', 'Spent By', 'required');			
			$this->form_validation->set_rules('Justification', 'Justification', 'required');
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
        header("Content-Disposition: attachment; filename = Expenditure.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'expenditure';
		$tableArray = array(
			array('TableName' => 'expendituretype', 'CompairField' => 'expendituretype.ExpenditureTypeId=expenditure.ExpenditureTypeId'),
		);
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where );
		//$result=$this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >ExpenditureType</th>";
		echo "<th align='center' >BillNo</th>";
		echo "<th align='center' >BillAmount</th>";
		echo "<th align='center' >BillDate</th>";
		echo "<th align='center' >SpentBy</th>";
		//echo "<th align='center' >ReceivedBy</th>";
		echo "<th align='center' >Year</th>";
		echo "<th align='center' >Justification</th>";
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
		echo "<td align='center'>" . $row->ExpenditureType . "</td>";
		echo "<td align='center'>" . $row->BillNo . "</td>";
		echo "<td align='center'>" . $row->BillAmount . "</td>";
		echo "<td align='center'>" . $row->BillDate . "</td>";
		echo "<td align='center'>" . $row->SpentBy . "</td>";
		//echo "<td align='center'>" . $row->ReceivedBy . "</td>";
		echo "<td align='center'>" . $row->Year . "</td>";
		echo "<td align='center'>" . $row->Justification . "</td>";
		//echo "<td align='center'>" . $row->ClassFees . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

