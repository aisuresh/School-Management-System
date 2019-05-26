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
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
		$this->load->library('table');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
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
		$table = 'dailyattendence';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearat', $this->pyear);
		/*$sortby = 'AttendenceId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			//array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
			
			
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
	
	 $data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring,     $sortby, $where);
		$data['links'] = $this->pagination->create_links();*/
		$table = 'section';
		$where=array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['sect'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'course';
		$where=array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$this->data['pages'] = $page;
		$this->load->view('attendence/list', $data);
		$this->load->view('footer');
	}
	
	function showattendence()
	{
		$config['base_url'] = base_url() . 'attendence/listview/'.$this->pyear;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
	    $table = 'dailyattendence';
	    $class=$this->input->post('ClassId');
		$section=$this->input->post('SectionId');
		$year =$this->input->post('Year');
	   
		$where = array(
		    array('condition' => 'studentclass.StudentClass', 'value' => $class),
			array('condition' => 'studentclass.SectionId', 'value' => $section),
			array('condition' => 'studentclass.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		
		$tjoin = array(
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId'),
		);
		$data['attendance'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('attendence/attendence', $data);
		
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
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
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
		$table = 'dailyattendence';
		$config['base_url'] = base_url() . 'attendence/listview/'.$this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption =''; $searchstring='';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'AttendenceId';
		$this->session->set_userdata('yearat', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			//array('TableName' => 'student', 'CompairField' => $table.'.Name=student.StudentName'),
			//array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('attendence/list', $data);
	}
	/*function attendancesearch(){
	    
		 //$table = 'dailyattendance';
		 $ClassId = $this->input->post('ClassId');
		 $SectionId = $this->input->post('SectionId');
		 $AttendenceId=$this->input->post('AttendenceId');
		 $this->load->model('Adminmodel');
		// $field = 'StudentClass';
		
		 /*$sqlb1 = "SELECT * from studentclass where StudentClass = ".$ClassId." and ".$SectionId;
		 $data['attend'] = $this->Adminmodel->query_fun($sqlb1);
		 foreach($data['attend'] as $at){
			$RollNo = $at->RollNo;
		}
		$table = 'dailyattendence';
		/*$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			);*/
		/*$where = array(
		 	array('condition' => $table.'.AttendenceId', 'value' => $AttendenceId),
			//array('condition' => $table.'.Year', 'value' => $year)
		 );*/
		//$data['attendance'] = $this->Adminmodel->show_rows($table, $where);
		//$this->load->model('Adminmodel');
		//$data['links'] = $this->pagination->create_links();

		 
	//$data['attend'] = $this->Adminmodel->fetch_row( $where, $tableArray,$table);
		
		// $this->load->view('attendence/list', $data);
	//}
	
	 function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$table = 'dailyattendence';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
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
		$id = $this->uri->segment(3);
		/*$table = 'dailyattendence';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.AttendenceId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);*/
		$table = 'student';
		$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'months';
		$data['months'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'section';
		$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['sect'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'course';
		$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
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
			//array('TableName' => 'student',  'Condition' => $table.'.RollNo=student.StudentRollNo'),
		 );
		 $section = $this->Adminmodel->fetch_row_where( $where, $table,$tjoin);
		 $str2 = '';
		$str1 = "<option value = 'x'>- - Select Section - -</option>";
		if(count($section) > 0){
			foreach($section as $row){
				$str2 =$str2. "<option value = '".$row->SectionId."' >".$row->SectionName."</option>";
			}
			$str = $str1.$str2;
			echo $str;
		}else{
			echo $str1;
		}	
		
		 
		 //$this->load->view('attendence/section', $data);
	}
	
	function studentlist()
	{
		
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
		 $class = $this->input->post('ClassId');
		 $section = $this->input->post('SectionId');
		
		$tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId'),
			
		);
	
		$where = array(
			array('condition' => $table.'.StudentClass', 'value' => $class),
			array('condition' => $table.'.SectionId', 'value' => $section),
			//array('condition' => $table.'.Year', 'value' => $year)
		);
		
		$data['studentlist'] = $this->Adminmodel->fetch_row_where($where,$table,$tjoin);
		echo '<option value="x" >-- Select RollNo --</option>';
	   foreach($data['studentlist']  as $rno ){
		echo '<option value="'.$rno->StudentId.'" >'.$rno->StudentRollNo.'-'.$rno->StudentName.'</option>';
	}
	}
	function save()
	{	
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$table = 'dailyattendence';
		$monthid = explode('-',$this->input->post('PDate'));
		$PDate= date("Y-m-d", strtotime($this->input->post('PDate')));
		$data = array(
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'StudentId' => $this->input->post('StudentId'),
		   'AttendDate' => $PDate,
		   'SessionId' => $this->input->post('SessionId'),
		   'Attendance' => $this->input->post('Attendance'),
		   'MonthId' => $monthid[1],
		   'Year' => $year
        );
		//print_r($data);
	    $this->form_validation->set_rules('ClassId', 'Class Id', 'required');
		$this->form_validation->set_rules('SectionId', 'Section Id', 'required');
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('PDate', 'Present Date', 'required');
		$this->form_validation->set_rules('SessionId', 'Session Type', 'required');
		$this->form_validation->set_rules('Attendance', 'Attendance', 'required');
		
		if ($this->form_validation->run() == true) {
			$status = $this->Adminmodel->save_data($data, $table);
		     echo $status;
			/*if($status){
				$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
				foreach($yearno as $yno){
					if($yno->AcademicYear != NULL)
					{
					    $year = $yno->AcademicYear;
					}
				}
				
			$table = 'studentclass';
				$data = array(
				   'InstituteId' =>  $this->session->userdata('InstituteId'),
				   'RollNo' => $this->input->post('RollNo'),
				   'StudentClass' => $this->input->post('StudentClass'),
				   'SectionId' => $this->input->post('SectionId'),
				   'Year' => $year
				   
				);
				$status = $this->Adminmodel->save_data($data, $table);
				echo($status);
		}
		}*/
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
		$table = 'dailyattendence';
		$field = 'AttendenceId';
		$where = array(
		 	array('condition' => $table.'.'.$field, 'value' => $id)
		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.StudentId = studentclass.StudentId'),
		);
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		foreach($data['result'] as $at){
			$CourseId = $at->StudentClass;
		}
		
		$table = 'studentclass';
		$where = array(
		 	array('condition' => $table.'.StudentClass', 'value' => $CourseId),
			array('condition' => $table.'.Year', 'value' => $year)
		 );
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		
		
		//$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$table = 'dailyattendence';
		$field = 'AttendenceId';
		$where = array(
		 	array('condition' => $table.'.'.$field, 'value' => $id)
		 );
	    
		 $tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.StudentId = studentclass.StudentId'),
			array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId'),
		 	array('TableName' => 'section', 'Condition' => 'studentclass.SectionId = section.SectionId'),
		 );
		 $data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
	
		$table = 'course';
		$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where );
		$table = 'section';
		$where=array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['section'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('attendence/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$field = 'AttendenceId';
		$id = $this->input->post('AttendenceId');
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'dailyattendence';
		$monthid = explode('-',$this->input->post('PDate'));
		$AttendDate=date("Y-m-d", strtotime($this->input->post('PDate')));

		$data = array(
		   'StudentId' => $this->input->post('StudentId'),
		   'AttendDate' => $AttendDate,
		   'SessionId' => $this->input->post('SessionId'),
		   'Attendance' => $this->input->post('Attendance'),
		   'MonthId' => $monthid[1],
		   'Year' => $year
        );
		//print_r($data);exit;
		/*$where = array(
			array('condition' => $table.'.'.$field, 'value' => $id),
			array('condition' => $table.'.Year', 'value' => $year )
		);*/
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('PDate', 'Present Date', 'required');
		$this->form_validation->set_rules('SessionId', 'Session Id', 'required');
		$this->form_validation->set_rules('Attendance', 'Attendance', 'required');
		
		if ($this->form_validation->run() == true) {
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
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
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$table = 'dailyattendence';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Attendence.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'months', 'CompairField' => $table.'.MonthId=months.MonthNo')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $year)
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		
		//$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th align='center' >#</th>";
		echo "<th align='center' >Student Id</th>";
		echo "<th align='center' >Student Name</th>";
		echo "<th align='center' >Month Name</th>";
		echo "<th align='center' >Session</th>";
		echo "<th align='center' >Attendance</th>";
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
		echo "<td align='center'>" . $row->StudentId . "</td>";
		echo "<td align='center'>" . $row->StudentName . "</td>";
		echo "<td align='center'>" . $row->MonthName . "</td>";
		if( $row->SessionId == 1){
			echo "<td align='center'>Morning</td>";
		}else{
			echo "<td align='center'>Afternoon</td>";
		}	
		if( $row->Attendance ==  1){
			echo "<td align='center'>Present</td>";
		}else{
			echo "<td align='center'>Absent</td>";
		}	
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file attendence.php */
/* Location: ./system/application/controllers/attendence.php */

