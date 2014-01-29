<?php
class Attendence extends Controller 
{

	var $pageinfo;
	var $url;
	var $pyear;
	
	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		$this->load->helper('html');
		$this->load->library('table');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database($this->session->userdata('database'), true);
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Attendence');
		$this->input->post();
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
		//$this->session->set_userdata('yearat', $this->pyear);
		
	}
	
	function listview()
	{
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'attendence/listview/'.$this->pyear;
		$table = 'attendence';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->session->set_userdata('yearat', $this->pyear);
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'AttendenceId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$this->data['pages'] = $page;
		$this->load->view('attendence/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Attendence', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'attendence/listview/'.$this->pyear;
		$table = 'attendence';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$this->session->set_userdata('yearat', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('attendence/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Attendence', 'url' => $this->url, 'event' => 'List view' );
		$table = 'attendence';
		$config['base_url'] = base_url() . 'attendence/listview/'.$this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'AttendenceId';
		$this->session->set_userdata('yearat', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('attendence/list', $data);
	}
	
	 function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$table = 'attendence';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.AttendenceId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$table = 'student';
		$where = array();
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('attendence/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'months';
		$data['months'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('attendence/addnew', $data);
		$this->load->view('footer');
	}
	
	function section()
	{
		 $table = 'sectionclass';
		 $fielda = 'ClassId';
		 $row = $this->input->post('ClassId');
		
		$where = array(
		 	array('condition' => $table.'.'.$fielda, 'value' => $row)
		 );
	    
		 $tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId'),
		 );
		 $data['section'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 
		 $this->load->view('attendence/section', $data);
	}
	
	function studentlist()
	{
		 $ClassId = $this->input->post('ClassId');
		 $SectionId = $this->input->post('SectionId');
		 if($this->input->post('Year') != NULL)
		 {
		 	$Year = $this->input->post('Year');
		 }else{
			$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
			foreach($yearno as $yno){
				if($yno->AcademicYear != NULL){
					$Year = $yno->AcademicYear;
				}
			}
		}	
		 $table = 'studentclass';
		 $where = array(
		 	 array('condition' => $table.'.StudentClass', 'value' => $ClassId),
		 	 array('condition' => $table.'.SectionId', 'value' => $SectionId),
			 array('condition' => $table.'.Year', 'value' => $Year)
		 );
		$data['studentlist'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('attendence/studentlist', $data);
	}
	
	function save()
	{	
		$table = 'attendence';
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$data = array(
		   'RollNo' => $this->input->post('RollNo'),
		   'MonthId' => $this->input->post('MonthName'),
		   'TotalDays' => $this->input->post('TotalDays'),
		   'Morning' => $this->input->post('Morning'),
		   'Afternoon' => $this->input->post('Afternoon'),
		   'Year' => $year
        );
		$this->form_validation->set_rules('RollNo', 'Roll No', 'required');
		$this->form_validation->set_rules('MonthName', 'Month Name', 'required');
		$this->form_validation->set_rules('TotalDays', 'Total Working Days', 'required');
		$this->form_validation->set_rules('Morning', 'Morning Attendance', 'required');
		$this->form_validation->set_rules('Afternoon', 'Afternoon Attendance', 'required');
		if ($this->form_validation->run() == true) {
			$status = $this->Adminmodel->save_data($data, $table);
			echo $status;
		}else{
			//$this->listview();
		}
		
	}
	
	function edit()
	{
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$table = 'attendence';
		$field = 'AttendenceId';
		$where = array(
		 	array('condition' => $table.'.'.$field, 'value' => $id)
		 );
	    
		 $tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.RollNo = studentclass.RollNo'),
		 	array('TableName' => 'section', 'Condition' => 'studentclass.SectionId = section.SectionId'),
		 );
		 $data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		
		
		//$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'months';
		$data['months'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'section';
		$data['section'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('attendence/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'attendence';
		$field = 'RollNo';
		$id = $this->input->post('RollNo');
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$data = array(
		   'RollNo' => $this->input->post('RollNo'),
		   'MonthId' => $this->input->post('MonthName'),
		   'TotalDays' => $this->input->post('TotalDays'),
		   'Morning' => $this->input->post('Morning'),
		   'Afternoon' => $this->input->post('Afternoon')
        );
		
		$where = array(
			array('condition' => $table.'.'.$field, 'value' => $id),
			array('condition' => $table.'.Year', 'value' => $year )
		);
		$this->form_validation->set_rules('RollNo', 'Roll No', 'required');
		$this->form_validation->set_rules('MonthName', 'Month Name', 'required');
		$this->form_validation->set_rules('TotalDays', 'Total Working Days', 'required');
		$this->form_validation->set_rules('Morning', 'Morning Attendance', 'required');
		$this->form_validation->set_rules('Afternoon', 'Afternoon Attendance', 'required');
		if ($this->form_validation->run() == true) {
				$status = $this->Adminmodel->update_multi_data($where, $data, $table);
				echo $status;
		}else{
			$this->listview();
		}
		
	}
	
	function attendencerecords(){
		$data['event'] = 'Attendence Record';
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('attendence/report', $data);
		$this->load->view('footer');
	}
	
	function show_attendence(){
		$table = 'studentclass';
		$RollNo = $this->input->post('RollNo');
		$Class = $this->input->post('Class');
		$Year = $this->input->post('Year');
		$where = array(
			array('condition' => $table.'.RollNo', 'value' => $RollNo),
			array('condition' => $table.'.Year', 'value' => $Year)
		);
		$tjoin = array(
			array('TableName' => 'student' , 'Condition' => 'studentclass.RollNo=student.StudentRollNo' ),
			array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId' ),
			array('TableName' => 'section' , 'Condition' => 'studentclass.SectionId=section.SectionId' )
		);
		$data['records'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		
		$table = 'attendence';
		$where = array(
			array('condition' => $table.'.RollNo', 'value' => $RollNo),
			array('condition' => $table.'.Year', 'value' => $Year)
		);
		$tjoin = array(
			array('TableName' => 'months' , 'Condition' => $table.'.MonthId = months.MonthNo' )
		);
		//$sql = "";
		$data['attendence'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		
		/*$table = 'classsubject';
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $Class)
		);
		$tjoin = array(
			array('TableName' => 'subject' , 'Condition' => $table.'.SubjectId = subject.SubjectId' )
		);
		$data['subjects'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		
		$table = 'exam';*/
		
		
		/*$sql1 ="SELECT exam.ExamType, ";
		$sql2 = '';$totalmarks = 0;
		foreach($data['subjects'] as $subject){
			$sql2 .= "SUM(IF(marks.SubjectId = $subject->SubjectId, Marks, 0)) AS  $subject->SubjectName, ";
		}
		$sql3 = " exam.ExamMarks FROM marks join exam on marks.ExamTypeId = exam.ExamId";
		$sql4 = " WHERE marks.RollNo = $RollNo GROUP BY marks.ExamTypeId";
		$sql = $sql1.$sql2.$sql3.$sql4;
		$data['exammarks'] = $this->Adminmodel->query_fun($sql);*/
		
			
		$this->load->view('attendence/showattendence', $data);
	}	

	
	function export()
	{
		$table = 'attendence';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Attendence.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array();
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		
		//$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th align='center' >#</th>";
echo "<th align='center' >Roll No<a class = 'RollNo' >";
echo "<th align='center' >Month Name</th>";
echo "<th align='center' >Student Name</th>";											
echo "<th align='center' >Total <br/>Working Days</th>";
echo "<th align='center' >Morning<br/>Present</th>";
echo "<th align='center' >Afternoon<br/>Present</th>";
echo "</tr>";
		$i= 1;
		foreach($result as $row):
		if($i % 2){
			$master_tr_bgcolor = 'background-color:#f8fcfc; border-right:1px solid #a4a9a8; padding-left:5px;';
		}else{
			$master_tr_bgcolor = 'background-color:#e4ebec; border-right:1px solid #a4a9a8; padding-left:5px;';
		}
		
		echo "<tr style='" . $master_tr_bgcolor . "'>";
		echo "<td align='center' >" . $i++. "</td>";
		echo "<td align='center'>" . $row->RollNo . "</td>";
		echo "<td align='center'>" . $row->StudentName . "</td>";
		echo "<td align='center'>" . $row->MonthName . "</td>";
		echo "<td align='center'>" . $row->TotalDays . "</td>";
		echo "<td align='center'>" . $row->Morning . "</td>";
		echo "<td align='center'>" . $row->Afternoon . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file attendence.php */
/* Location: ./system/application/controllers/attendence.php */

