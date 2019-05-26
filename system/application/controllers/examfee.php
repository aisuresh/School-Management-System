<?php
class Examfee extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Exam Fees');
		$this->input->post();
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
		
	}
	
	function listview()
	{
		$table = 'examfee';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'examfee/listview/'.$this->pyear;
		$table = 'examfee';		
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'ExamFeeId';
		$this->session->set_userdata('yearef', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
			//array('TableName' => 'classexamfeestype', 'CompairField' => 'studentclass.StudentClass=classexamfeestype.ClassId'),
			array('TableName' => 'course', 'CompairField' => 'studentclass.StudentClass=course.ClassId'),
		);
		//$tableArray=array();
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => 'studentclass'.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		//$where = array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'exam';
		$data['exam'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'subject';
		$data['subjects'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('examfee/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'examfee';
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Exam Fees', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'marks/listview/'.$this->pyear;
		$table = 'examfee';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$this->session->set_userdata('yearef', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
			array('TableName' => 'course', 'CompairField' => 'studentclass.StudentClass=course.ClassId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => 'studentclass'.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$table = 'exam';
		$data['exam'] = $this->Adminmodel->show_rows($table, $where = array());
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'subject';
		$data['subjects'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('examfee/list', $data);
	}
	
	function search_data(){
		$table = 'examfee';
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Exam Fees', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'examfee/listview/'.$this->pyear;
		$table = 'examfee';
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
		$sortby = 'ExamFeeId';
		$this->session->set_userdata('yearef', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
			array('TableName' => 'course', 'CompairField' => 'studentclass.StudentClass=course.ClassId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => 'studentclass'.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$table = 'exam';
		$data['exam'] = $this->Adminmodel->show_rows($table, $where  = array());
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'subject';
		$data['subjects'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('examfee/list', $data);
	}
	
	 function view()
	{
		$table = 'examfee';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.ExamFeeId', 'value' => $id)
		);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
			array('TableName' => 'course', 'CompairField' => 'studentclass.StudentClass=course.ClassId')
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray,$where);
		$where = array();
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'exam';
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$data['subjects'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('examfee/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'classexamfeestype';
		$data['classexamfeestype'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'exam';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where );
		$table = 'examfeesclass';
		$where = array(
		  	array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$tjoin = array(
			array('TableName' => 'course', 'Condition' => $table.'.ClassId = course.ClassId'),
		);
		$data['examfessclass'] = $this->Adminmodel->fetch_row_where( $where, $table,$tjoin);
		$this->load->view('examfee/addnew', $data);
		$this->load->view('footer');
	}
	
	
	function section()
	{
		 $table = 'sectionclass';
		 $fielda = 'ClassId';
		 $row = $this->input->post('ExamClass');
		 $where = array(
		 	array('condition' => $table.'.'.$fielda, 'value' => $row),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		 );
		 $tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId'),
		 );
		 $data['section'] = $this->Adminmodel->fetch_row_where( $where, $table,$tjoin);
		 
		 echo '<option value="x" >-- Select Section --</option>';
		 
	    foreach($data['section']as $se ){
		   echo '<option value="'.$se->SectionId.'" >'.$se->SectionName.'</option>';
	
	}
		 
		// $this->load->view('examfee/section', $data);
	}
	
	function studentlist()
	{
		$ClassId = $this->input->post('ExamClass');
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
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			 array('condition' => $table.'.Year', 'value' => $Year)
		 );
		 $tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId'),
			
		);
		$data['studentlist'] = $this->Adminmodel->fetch_row_where($where,$table,$tjoin);
		echo '<option value="x" >-- Select RollNo --</option>';
	   foreach($data['studentlist']  as $rno ){
		echo '<option value="'.$rno->StudentId.'" >'.$rno->StudentRollNo.'-'.$rno->StudentName.'</option>';
	}
		//$this->load->view('examfee/studentlist', $data);
	}
	
	function noofsubjects(){
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'classexamfeestype';
		$class = $this->input->post('ExamClass');
		$where = array(
		 	//array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.ClassId', 'value' => $class),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['classexamfeestype'] = $this->Adminmodel->show_rows($table, $where);
		echo '<option value = "x">-- Select no of subjects --</option>';
		foreach($data['classexamfeestype'] as $cft){
			echo  '<option value = '.$cft->NoOfSubjects.'>'.$cft->NoOfSubjects.'</option>';
		}
		
	}

	
	function examtype()
	{
		$table = 'exam';
		$field = 'ExamId';
		$id = $this->input->post('ExamTypeId');
		$where = array(
			array('condition' => $table.'.ExamId', 'value' => $id)
		);
		$data = $this->Adminmodel->fetch_row($field, $id, $table);
		foreach($data as $row ){
			echo $row->ExamMarks;
		}
	}
	
	
	function examfees(){
		$ClassId = $this->input->post('ExamClass');
		$noofsubjects = $this->input->post('noofsubjects');
		$table = 'classexamfeestype';
		$where = array(
			array('condition' => $table.'.ClassId', 'value' =>$this->input->post('ExamClass') ),
			array('condition' => $table.'.NoOfSubjects', 'value' => $noofsubjects),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['examfeeses'] = $this->Adminmodel->show_rows($table, $where);
		//echo $data['examfeeses'] ;
		$examfees='';
	 	foreach($data['examfeeses'] as $ef){
	        $examfees= $ef->ExamFees;
			
	       }
		
		//$data['examfees']=$examfees;
		$table = 'classsubject';
		$where = array(
		 	array('condition' => $table.'.ClassId', 'value' => $ClassId),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$tjoin = array(
		 	array('TableName' => 'subject', 'Condition' => $table.'.SubjectId = subject.SubjectId')
		);
		$data['subjects'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		$str2 ='';
	    $str1 = '<select name = "Subjects" id = "Subjects" multiple = "multiple" >';
		 foreach($data['subjects'] as $sb){
		 	$str2 .= '<option value ="'.$sb->SubjectId.'">'.$sb->SubjectName.'</option>';
		  }
		  $str = $str1.$str2; 
		echo $examfees.'===='.$str.
		'</select>;
		<script>
			$(document).ready(function(){
				$("#Subjects").multiselect({
					SelectedText: "Subject List"
				});
			
			});
		</script>' ;
	}
	
	function save()
	{
	
	  $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}	
		 $MaxReceiptNo = $this->Adminmodel->maxvalue($table = 'examfee', $fields = array('ReceiptNo'), $where = array());
		foreach($MaxReceiptNo as $yno){
			if($yno->ReceiptNo != NULL){
				$MaxReceiptNo = $yno->ReceiptNo;
			}
		}	
		$PaidDate=date("Y-m-d", strtotime($this->input->post('PaidDate')));
		$data = array(
		       'InstituteId' =>  $this->session->userdata('InstituteId'),
               'StudentId' => $this->input->post('StudentId'),
			   'ExamFeeClass' => $this->input->post('ExamClass'),
               'ExamFee' => $this->input->post('ExamFee'),
			   'ExamTypeId'=>$this->input->post('ExamType'),
			   'NoOfSubjects' => $this->input->post('NoOfSubjects'),
			   'Subjects' => $this->input->post('Subjects'),
			   'ReceiptNo' => $MaxReceiptNo+1,
			   'PaidDate' => $PaidDate,
			   'Year' => $year,
			   'ExamFeeDes' => $this->input->post('ExamFeeDes')
        );
		$table = 'examfee';
	    $where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentId', 'value' =>$this->input->post('StudentId')),
			//array('condition' => $table.'.ExamTypeId', 'value' =>$this->input->post('ExamType')),
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
	
        if(!isset($result) && $result <= 0){
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('ExamClass', 'Exam Class', 'required');
		$this->form_validation->set_rules('NoOfSubjects', 'No Of Subjects', 'required');
		$this->form_validation->set_rules('ExamFee', 'Exam Fee', 'required');
		$this->form_validation->set_rules('Subjects', 'Subjects', 'required');
		//$this->form_validation->set_rules('ReceiptNo', 'Receipt Number', 'required');
		$this->form_validation->set_rules('PaidDate', 'Paid Date', 'required');
		//$this->form_validation->set_rules('Year', 'Year', 'required');
		
		if ($this->form_validation->run() == true) {
				$status = $this->Adminmodel->save_data($data, $table);
				echo $status;
		} else{
			//$this->listview();
		}
		}else{
			echo 2;
		}	
	}
	
	function edit()
	{
		$table = 'examfee';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'ExamFeeId';
		$where = array(
		 	array('condition' => $table.'.ExamFeeId', 'value' => $id),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.StudentId = studentclass.StudentId'),
			//array('TableName' => 'section', 'Condition' => 'studentclass.SectionId = section.SectionId'),
			array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId')
		);
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		$class='';
		foreach($data['result'] as $cs){
			$class = $cs->StudentClass;
			
		}
		$table = 'studentclass';
		$where = array(
		 	array('condition' => $table.'.StudentClass', 'value' => $class )
		);
		$tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId')
		);
		$data['section'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
        $where = array();
	    $table = 'classsubject';
		$data['classsubject'] = $this->Adminmodel->show_rows($table,$where);
		$table = 'exam';
		$data['examtype'] = $this->Adminmodel->show_rows($table,$where);
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		/*$table = 'examfeesclass';
		$examfeeid=$this->input->post('ExamFeeId');
		$where = array(
		      array('condition'=>$table.'.ExamFeesClassId','value'=>$id),
		);
		 $tjoin = array(
		 	array('TableName' => 'course', 'Condition' => $table.'.ClassId= course.ClassId'),
			//array('TableName' => 'examfeesclass', 'Condition' => $table.'.ExamFeeId = examfeesclass.ExamFeesClassId')
			
		 );
		 $data['examfeesclass'] = $this->Adminmodel->fetch_row_where( $where,$table,$tjoin);*/
		 
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('examfee/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$field = 'ExamFeeId';
		$id = $this->input->post('ExamFeeId');
		$PaidDate = date("Y-m-d", strtotime($this->input->post('PaidDate')));
		$data = array(
		       'InstituteId' =>  $this->session->userdata('InstituteId'),
               'StudentId' => $this->input->post('StudentId'),
			   'ExamFeeClass' => $this->input->post('ExamClass'),
               'ExamFee' => $this->input->post('ExamFee'),
			   'ExamTypeId'=> $this->input->post('ExamTypeId'),
			   'NoOfSubjects' => $this->input->post('NoOfSubjects'),
			   'Subjects' => $this->input->post('Subjects'),
			   'ReceiptNo' => $this->input->post('ReceiptNo'),
			   'PaidDate' => $PaidDate,
			   'ExamFeeDes' => $this->input->post('ExamFeeDes')
         );
		 //print_r($data);exit;
	
		$table = 'examfee';
	    $where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentId', 'value' =>$this->input->post('StudentId')),
			array('condition' => $table.'.ExamFeeClass', 'value' =>$this->input->post('ExamClass')),
			array('condition' => $table.'.ExamFee', 'value' =>$this->input->post('ExamFee')),
			array('condition' => $table.'.ExamTypeId', 'value' =>$this->input->post('ExamTypeId')),
			array('condition' => $table.'.NoOfSubjects', 'value' =>$this->input->post('NoOfSubjects')),
			array('condition' => $table.'.Subjects', 'value' =>$this->input->post('Subjects')),
			array('condition' => $table.'.ReceiptNo', 'value' =>$this->input->post('ReceiptNo')),
			array('condition' => $table.'.PaidDate', 'value' =>$this->input->post('PaidDate')),
			array('condition' => $table.'.ExamFeeDes', 'value' =>$this->input->post('ExamFeeDes')),
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);exit;
		if(!isset($result) && $result <= 0){
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('ExamClass', 'Exam Class', 'required');
		$this->form_validation->set_rules('NoOfSubjects', 'No Of Subjects', 'required');
		$this->form_validation->set_rules('ExamFee', 'Exam Fee', 'required');
		$this->form_validation->set_rules('Subjects', 'Subjects', 'required');
		$this->form_validation->set_rules('ReceiptNo', 'Receipt No', 'required');
		$this->form_validation->set_rules('PaidDate', 'Paid Date', 'required');
		
		if ($this->form_validation->run() == true) {
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
				echo $status;
		} else{
			//$this->listview();
		}
		}else{
			echo 2;
		}	
	}
	
	function export()
	{
		$table = 'examfee';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Examfee.xls");
        header("Pragma: no-cache");
        header("Expires: 0");		
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
			array('TableName' => 'course', 'CompairField' => 'studentclass.StudentClass=course.ClassId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->session->userdata('yearef'))
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$table = 'subject';
		$subjects = $this->Adminmodel->show_rows($table, $where = array());
		
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Roll No</th>";
		echo "<th align='center' >Class</th>";
		echo "<th align='center' >No of Subjects</th>";
		echo "<th align='center' >Subjects</th>";
		echo "<th align='center' >Exam Fees</th>";
		echo "<th align='center' >Recept No</th>";
		echo "<th align='center' >Paid Date</th>";
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
		echo "<td align='center'>" . $row->RollNo . "</td>";
		echo "<td align='center'>" . $row->ClassName . "</td>";
		echo "<td align='center'>" . $row->NoOfSubjects . "</td>";
		echo "<td align='center'>";
		$subarray = explode(',', $row->Subjects);
		$subjectnewarray = array();
		foreach($subjects as $sub){
			$subject[] = $sub->SubjectName;
		}
		foreach($subarray as $id){
			$subjectnewarray[] = $subject[$id-1];
		}
		$showsubjects = implode(', ', $subjectnewarray);
		echo $showsubjects;
		echo "</td>";
		echo "<td align='center'>" . $row->ExamFee . "</td>";
		echo "<td align='center'>" . $row->ReceiptNo . "</td>";
		echo "<td align='center'>" . $row->PaidDate . "</td>";
		echo "<td align='center'>" . $row->ExamFeeDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file examfee.php */
/* Location: ./system/application/controllers/examfee.php */

