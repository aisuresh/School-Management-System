<?php
class Marks extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Marks', 'event' => 'Show Marks Record');
		$this->input->post();
		$this->load->library('session');
		$this->load->helper('url');
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
	}
	
	function listview()
	{
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'marks/listview/' . $this->pyear;
		$table = 'marks';
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
		$sortby = 'MarksId';
		$this->session->set_userdata('yearmx', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'subject', 'CompairField'=> $table.'.SubjectId=subject.SubjectId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear ),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$table = 'exam';
		$data['exam'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where = array());
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('marks/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Marks', 'url' => $url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'marks/listview/'.$this->pyear;
		$table = 'marks';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$this->session->set_userdata('yearmx', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'subject', 'CompairField'=> $table.'.SubjectId=subject.SubjectId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$table = 'exam';
		$data['exam'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where = array());
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('marks/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Marks', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'marks/listview/'.$this->pyear;
		$table = 'marks';
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
		$sortby = 'MarksId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'subject', 'CompairField'=> $table.'.SubjectId=subject.SubjectId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$table = 'exam';
		$data['exam'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where = array());
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('marks/list', $data);
	}
	
	 function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'marks';
		$id = $this->uri->segment(3);
		$where = array(
			 array('condition' => $table.'.MarksId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
		$table = 'student';
		$where = array();
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'exam';
		$where = array();
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$where = array();
		$data['subject'] = $this->Adminmodel->show_rows($table, $where);		
		$this->load->view('marks/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		/*$table = 'marks';
		//$this->field = 'MarksId';
		$where = array(
			array('condition' => $table.'.MarksId', 'value' => $id)
		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.RollNo = studentclass.RollNo')
		);
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);*/
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'exam';
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'section';
		$data['sect'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'course';
		$where = array();
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$this->load->view('marks/addnew', $data);
		$this->load->view('footer');
	}
	
	function section()
	{
		 $table = 'sectionclass';
		 $fielda = 'ClassId';
		 $ClassId = $this->input->post('Class');
		
		 $where = array(
		 	array('condition' => $table.'.'.$fielda, 'value' => $ClassId)
		 );
	    
		 $tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId')
		 );
		 $section = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 $str1 = '<option value ="x">- - Section - -</option>';
		 $str2 = '';
		 	if(count($section) > 0){
		 foreach($section as $row){
		 	$str2 =$str2. '<option value ="'.$row->SectionId.'">'.$row->SectionName.'</option>';
		 }
		 $str =  $str1 . $str2;
		 echo $str;
	}
	else{
			echo $str1;
		}	
		
	}
	
	function studentlist()
	{
		 $ClassId = $this->input->post('Class');
		 $SectionId = $this->input->post('SectionId');
		 $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$Year = $yno->AcademicYear;
			}
		}
		 $table = 'studentclass';
		 $where = array(
		 	 array('condition' => $table.'.StudentClass', 'value' => $ClassId),
		 	 array('condition' => $table.'.SectionId', 'value' => $SectionId),
			// array('condition' => $table.'.Year', 'value' => $Year)
		 );
		 $tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentClassId=student.StudentId'),
			);
		
		/*$tjoin = array(
			array('TableName' => 'student' , 'Condition' => $table.'.RollNo=student.StudentRollNo' ),
			array('TableName' => 'section' , 'Condition' => $table.'.SectionId=section.SectionId' )
		);
		
		$studenclass = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		//$rollno = $this->Adminmodel->show_rows($table, $where);
		$str1  = "<option value = 'x'>- - RollNo - -</option>";
		$str2 = '';
		foreach(studenclass as $rowa):
			$str2.= "<option value = '".$rowa->RollNo."' >".$rowa->RollNo."</option>";
		endforeach;
		$str = $str1.$str2;
		echo $str;*/
		$studenclass = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$str1 = '';
		if(count($studenclass)>0){
		foreach($studenclass as $rd){
			$str1=$str1. '<option value = "'.$rd->RollNo.'">'. $rd->RollNo.' </option>';
		}
		echo $str1;
		}
	}
	function subjectlist(){
		$table = 'classsubject';
		$ClassId = $this->input->post('Class');
		$SubjectId = $this->input->post('SubjectId');
		$where = array(
		 	 array('condition' => $table.'ClassId', 'value' => $ClassId)
		);
		$tjoin = array(
		 	array('TableName' => 'subject', 'Condition' => $table.'.SubjectId = subject.SubjectId')
		 );
		 $subjects = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 $str1 = '<option value = "x">- -  Subject - -</option>';
		 $str2 = '';
		 foreach($subjects as $sub){
		 	$str2 .='<option value = "'. $sub->SubjectId.'">'.$sub->SubjectName.'</option>';
		 }
		  $str = $str1.$str2;
		  echo  $str;
	
	}
	
	function examtype()
	{
		$table = 'exam';
		$id = $this->input->post('ExamTypeId');
		if($id != 'x'){
			$where = array(
				array('condition' => $table.'.ExamId', 'value' => $id)
			);
			$data = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
			foreach($data as $row ){
				echo $row->ExamMarks;
			}
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
		
		$data = array(
		   'RollNo' => $this->input->post('RollNo'),
		   'ExamTypeId' => $this->input->post('ExamId'),
		   'TotalMarks' => $this->input->post('TotalMarks'),
		   'SubjectId' => $this->input->post('SubjectId'),
		   'Marks' => $this->input->post('Marks'),
		   'Year' => $year, 
		   'MarksDes' => $this->input->post('MarksDes')
        );
		$table= 'marks';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('RollNo', 'Roll No', 'required');
		$this->form_validation->set_rules('ExamId', 'Exam Id', 'required');
		$this->form_validation->set_rules('TotalMarks', 'Total Marks', 'required');
		$this->form_validation->set_rules('SubjectId', 'Subject Id', 'required');
		$this->form_validation->set_rules('Marks', 'Marks', 'required');
		//$this->form_validation->set_rules('Year', 'Year', 'required');
		if ($this->form_validation->run() == true) {
			$status = $this->Adminmodel->save_data($data,$table);
		    echo $status;
		}
		else{
			$this->listview();
		}
		
		
	}
	
	function edit()
	{
		$this->session->set_userdata('yearmx', $this->pyear);
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$table = 'marks';
		//$this->field = 'MarksId';
		$where = array(
			array('condition' => $table.'.MarksId', 'value' => $id)
			
		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.RollNo = studentclass.RollNo')
		);
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		//var_dump($data['result']); 
		//$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'exam';
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$table = 'section';
		$data['section'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'academicyear';
		$data['years'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'course';
		$where = array();
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('marks/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'marks';
		$field = 'MarksId';
		$id = $this->input->post('MarksId');
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$Year = $yno->AcademicYear;
			}
		}
		$table = 'marks';
		$data = array(
		       //'ClassId' => $this->input->post('ClassId'),
			   //'SectionId' => $this->input->post('SectionId'),
               'RollNo' => $this->input->post('RollNo'),
               'ExamTypeId' => $this->input->post('ExamId'),
			   'TotalMarks' => $this->input->post('TotalMarks'),
			   'SubjectId' => $this->input->post('SubjectId'),
			   'Marks' => $this->input->post('Marks'),
			   'Year' => $Year,
			   'MarksDes' => $this->input->post('MarksDes')
             );
		$this->load->library('form_validation');
		$this->form_validation->set_rules('RollNo', 'Roll No', 'required');
		$this->form_validation->set_rules('ExamId', 'Exam Id', 'required');
		$this->form_validation->set_rules('TotalMarks', 'Total Marks', 'required');
		$this->form_validation->set_rules('SubjectId', 'Subject Id', 'required');
		$this->form_validation->set_rules('Marks', 'Marks', 'required');
		if ($this->form_validation->run() == true) {
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			//echo 1;
			/*$table = 'studentclass';
				$data = array(
				   'RollNo' => $this->input->post('RollNo'),
				   'StudentClass' => $this->input->post('ClassId'),
				   'SectionId' => $this->input->post('SectionId'),
				   'Medium' => $this->input->post('Medium'),
				   'Year' => $year
				);
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);*/
			
			echo $status;
		} else{
			$this->listview();
		}
		
	}
	 /*function section()
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
		 $fielda = 'ClassId';
		 $rowa = $this->input->post('ClassId');
		 $rowb = $this->input->post('SectionId');
		 $table = 'classyear';
		 $where = array(
		 	 array('condition' => $table.'.ClassId', 'value' => $rowa),
		 	 array('condition' => $table.'.SectionId', 'value' => $rowb),
			 array('condition' => $table.'.Year', 'value' => '2011-2012')
		 );
		if($rowb == 'a'){
			$where = array(
		 	 array('condition' => $table.'.ClassId', 'value' => $rowa),
			 array('condition' => $table.'.Year', 'value' => '2011-2012')
		 );
		}			   
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('attendence/studentlist', $data);
	}*/

	function marksrecords(){
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('marks/report', $data);
		$this->load->view('footer');
	}
	
	function show_marks(){
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
		
		$table = 'marks';
		$where = array(
			array('condition' => $table.'.RollNo', 'value' => $RollNo),
			array('condition' => $table.'.Year', 'value' => $Year)
		);
		$tjoin = array(
			array('TableName' => 'subject' , 'Condition' => $table.'.SubjectId = subject.SubjectId' ),
			array('TableName' => 'exam' , 'Condition' => $table.'.ExamTypeId = exam.ExamId' )
		);
		$data['result'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		
		$table = 'classsubject';
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $Class)
		);
		$tjoin = array(
			array('TableName' => 'subject' , 'Condition' => $table.'.SubjectId = subject.SubjectId' )
		);
		$data['subjects'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		
		$table = 'exam';
		/*$where = array(
			array('condition' => $table.'.RollNo', 'value' => $RollNo),
			array('condition' => $table.'.Year', 'value' => $Year)
		);
		$tjoin = array(
			array('TableName' => 'subject' , 'Condition' => $table.'.SubjectId = subject.SubjectId' ),
			array('TableName' => 'exam' , 'Condition' => $table.'.ExamTypeId = exam.ExamId' )
		);
		$data['exams'] = $this->Adminmodel->show_rows($table, $where = array());*/
		
		$sql1 ="SELECT exam.ExamType, ";
		$sql2 = '';$totalmarks = 0;
		foreach($data['subjects'] as $subject){
			$sql2 .= "SUM(IF(marks.SubjectId = $subject->SubjectId, Marks, 0)) AS  $subject->SubjectName, ";
			//$totalmarks = $totalmarks += "$subject->SubjectName";
		}
		//$sql3 = " exam.ExamMarks, $totalmarks as totalmarks, ($totalmarks/count($data['subjects'])) as percent FROM marks join exam on marks.ExamTypeId = exam.ExamId";
		$sql3 = " exam.ExamMarks FROM marks join exam on marks.ExamTypeId = exam.ExamId";
		$sql4 = " WHERE marks.RollNo = $RollNo GROUP BY marks.ExamTypeId";
		$sql = $sql1.$sql2.$sql3.$sql4;
		$data['exammarks'] = $this->Adminmodel->query_fun($sql);
		//var_dump($data['exammarks']);
		/*$sql1 = "select exam.ExamType, exam.ExamMarks, ";
		$sql2 = '';
		foreach($data['subjects'] as $subject){
			$sql2 .= "SUM(IF(marks.TotalMarks = '.($j+1).', Marks, 0)) AS  ExamTypeId";
		}*/
			
		$this->load->view('marks/showmarks', $data);
	}	
	
	
	function export()
	{
		$table = 'marks';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Marks.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Roll No</th>";
		echo "<th align='center' >Exam Type</th>";
		echo "<th align='center' >Subject</th>";
		echo "<th align='center' >Total Marks</th>";
		echo "<th align='center' >Marks</th>";
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
		echo "<td align='center'>" . $row->ExamTypeId . "</td>";
		echo "<td align='center'>" . $row->SubjectId . "</td>";
		echo "<td align='center'>" . $row->TotalMarks . "</td>";
		echo "<td align='center'>" . $row->Marks . "</td>";
		echo "<td align='center'>" . $row->MarksDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

