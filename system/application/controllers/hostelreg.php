<?php
class Hostelreg extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Hostel Register');
		$this->input->post();
		$this->load->library('session');
 		$this->load->helper('url');
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
	}
	
	function listview()
	{
		
		$table = 'hostelregister';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'hostelreg/listview/'.$this->pyear;
		$table = 'hostelregister';

		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearhrg', $this->pyear);
		$sortby = 'HostelRegId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		//$where = array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, 	
		$sortby, $where);
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelreg/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Hostel Register', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'hostelreg/listview/'.$this->pyear;
		$table = 'hostelregister';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		
		$this->session->set_userdata('yearhrg', $this->pyear);
		
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelreg/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Hostel Register', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'hostelreg/listview/'.$this->pyear;
		$table = 'hostelregister';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'HostelRegId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		$this->session->set_userdata('yearhrg', $this->pyear);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelreg/list', $data);
	}
	
	 function view()
	{
		$table = 'hostelregister';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.HostelRegId', 'value' => $id)
		);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$where = array();
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);	
		$this->load->view('hostelreg/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'course';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$table='student';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['name'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('hostelreg/addnew', $data);
		$this->load->view('footer');
	}
	
	function studentlist(){
	
		$table = 'studentclass';
		$id = $this->input->post('Class');
		$where = array(
			array('condition' => $table.'.StudentClass', 'value' => $id),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId')
		);
		$data['studenclass'] = $this->Adminmodel->fetch_row_where($where,$table,$tjoin);
		//print_r($studenclass);exit;
		echo  '<option value = "x">- - Select RollNo - -</option>';
		foreach($data['studenclass']  as $rd){
			echo '<option value = "'.$rd->StudentId.'">'. $rd->StudentRollNo.'-'.$rd->StudentName.'</option>';
		}
		//echo $str1.$str2; 
	}
	
	function hostelfee(){
	
		$id = $this->input->post('Class');
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'hostelfees';
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $id),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$hostelfee = $this->Adminmodel->show_rows($table, $where);
		foreach($hostelfee as $fee){
			echo $fee->HostelFees;
		}
	}
	
	function save()
	{	
	  // echo 'hai';
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				 $year = $yno->AcademicYear; 
			}
		}
		$table = 'hostelregister';
				
		$data = array(
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'StudentId' => $this->input->post('StudentId'),
		   'HostelFee' => $this->input->post('HostelFee'),
		   'HostelFeeDiscount' => $this->input->post('HostelFeeDiscount'),
		    //'THostelFee' => $this->input->post('THostelFee'),
		    'HostelJoinDate'=> date('Y-m-d'),
			'Year' => $year,
		   'HostelDes' => $this->input->post('HostelFeeDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentId', 'value' =>$this->input->post('StudentId')),
			//array('condition' => $table.'.ReceiptNo', 'value' =>$MaxreceiptNo+1),
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
	
        if(!isset($result) && $result <= 0){
			// print_r($data);exit;	
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('HostelFee', 'Hostel Fee', 'required');
		$this->form_validation->set_rules('HostelFeeDiscount', 'Hostel Fee Discount', 'required');
		//$this->form_validation->set_rules('Join Date', 'Join Date', 'required');
		
	//echo jsn_encode($data)
	if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->save_data($data, $table);
	   		echo   $status;
			// if($status==1){
			   //echo 'success';
			  // }
		}else{
		    // echo "validation false";
			//$this->listview();
		}
		}else{
			echo 2;
		}	
	}
	
	function edit()
	{
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		//$id=$this->input->post('HostelRegId');
		$field = 'HostelRegId';
		$class=$this->input->post('Class');
		
		$table = 'course';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'hostelregister';
		//$year = $this->input->post('Year');
		$where= array(
			array('condition' => $table.'.HostelRegId', 'value' => $id),
			array('condition' => $table.'.Year', 'value'=>$year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		    //array('TableName'=>'studentclass','condition' => $table.'.MarksId=studentclass.StudentClassId')
		);
		
		$tjoin = array(
			array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId' ),
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId' ),
			array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId' ),
		);
		$data['result'] = $this->Adminmodel->fetch_row_where($where,$table,$tjoin );
		foreach($data['result'] as $cr){
			$class = $cr->StudentClass; 
		}
		$data['class'] = $class;
		
		$table = 'studentclass';
		$where= array(
			array('condition' => $table.'.StudentClass', 'value' => $class),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['student'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'student';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('hostelreg/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'hostelregister';
		$field = 'HostelRegId';
		$id = $this->input->post('HostelRegId');
		$data = array(
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'StudentId' => $this->input->post('StudentId'),
		   'HostelFee' => $this->input->post('HostelFee'),
		   'HostelFeeDiscount' => $this->input->post('HostelFeeDiscount'),
		   'HostelDes' => $this->input->post('HostelFeeDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentId', 'value' =>$this->input->post('StudentId')),
			array('condition' => $table.'.HostelFee', 'value' =>$this->input->post('HostelFee')),
			array('condition' => $table.'.HostelFeeDiscount', 'value' =>$this->input->post('HostelFeeDiscount')),
			array('condition' => $table.'.HostelDes', 'value' =>$this->input->post('HostelFeeDes')),
			
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
	
        if(!isset($result) && $result <= 0){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('HostelFee', 'Hostel Fee', 'required');
		$this->form_validation->set_rules('HostelFeeDiscount', 'Hostel Fee Discount', 'required');
		
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
	
	function export()
	{
		$table = 'hostelregister';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = HostelRegisters.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->session->userdata('yearhrg'))
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where );
		
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >HostelRegId</th>";
		echo "<th align='center' >Roll No</th>";
		echo "<th align='center' >Hostel Fees</th>";
		echo "<th align='center' >Fee Discount</th>";
		echo "<th align='center' >Join Date</th>";
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
		echo "<td align='center'>" . $row->HostelRegId . "</td>";
		echo "<td align='center'>" . $row->StudentId . "</td>";
		echo "<td align='center'>" . $row->HostelFee . "</td>";
		echo "<td align='center'>" . $row->HostelFeeDiscount . "</td>";
		echo "<td align='center'>" . $row->HostelJoinDate . "</td>";
		echo "<td align='center'>" . $row->HostelDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

