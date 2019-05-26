
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
		//echo ($this->pyear  = $this->uri->segment(3));
		
	}
	
	function listview()
	{
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'marks/listview/' . $this->pyear;
		$table = 'marks';
		//$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		//$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearmx', $this->pyear);
	     	/*$sortby = 'MarksId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'subject', 'CompairField'=> $table.'.SubjectId=subject.SubjectId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear ),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);*/
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'exam';
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['exam'] = $this->Adminmodel->show_rows($table, $where);
		//print_r($data['exam']);
		$this->load->view('marks/list', $data);
		$this->load->view('footer');
	}
	function examtypelist1()
	{
	    $config['base_url'] = base_url() . 'marks/listview/' . $this->pyear;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
	    $table = 'marks';
		$class=$this->input->post('ClassId');
		$section=$this->input->post('SectionId');
		$StudentId=$this->input->post('StudentId');
		$ExamTypeId=$this->input->post('ExamTypeId');
		$year =$this->input->post('Year');
	   
		$where = array(
		     array('condition' => 'studentclass.StudentClass', 'value' => $class),
			array('condition' => 'studentclass.SectionId', 'value' => $section),
			array('condition' => $table.'.StudentId', 'value' => $StudentId),
			array('condition' => $table.'.ExamTypeId', 'value' => $ExamTypeId),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		
		$tjoin = array(
			array('TableName' => 'exam' , 'Condition' => $table.'.ExamTypeId=exam.ExamId'),
			array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId')
			//array('TableName' => 'section' , 'Condition' => 'studentclass.SectionId=section.SectionId')
		);
		$data['result'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		//print_r($data);
		//$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'classsubject';
		$where = array(
		    array('condition' => $table.'.ClassId', 'value' => $class),
			
			);
		$tjoin = array(
			array('TableName' => 'subject' , 'Condition' => $table.'.SubjectId=subject.SubjectId'),
		);
		$data['subjects'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		$this->load->view('marks/examtypelist1', $data);
		
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
		//$this->load->view('marks/list', $data);
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
		$id = $this->uri->segment(3);
		$table = 'marks';
		$tableArray = array(
						array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
						array('TableName' => 'exam', 'CompairField' => $table.'.ExamTypeId=exam.ExamId'),
											
		);
		
		$where = array(
			 array('condition' => $table.'.MarksId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('marks/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
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
		$where = array(
			array('condition' => $table.'.Year', 'value' => $year),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['subject'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'section';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['sect'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'course';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$this->load->view('marks/addnew', $data);
		$this->load->view('footer');
	}
	
	function section()
	{
		 $table='sectionclass';
		$tableArray = array(
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId = section.SectionId')
		);
		$id=$this->input->post('ClassId');
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $id)
		);
		
		$data['section'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$this->load->view('marks/class_section', $data);
	}
	
	
	function studentlist()
	{
		$ClassId = $this->input->post('ClassId');
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
			 array('condition' => $table.'.Year', 'value' => $Year),
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		 );
		 
		 $tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId'),
		 );
		 $data['studentlist'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		echo $data['studentlist'];
		echo '<option value="x" >-- Select RollNo --</option>';
	   foreach($data['studentlist']  as $rno ){
			echo '<option value="'.$rno->StudentId.'" >'.$rno->StudentRollNo.'-'.$rno->StudentName.'</option>';
		//$this->load->view('attendence/studentlist', $data);
	}
	}
	function subjectlist()
	{
		$table = 'classsubject';
		$ClassId = $this->input->post('ClassId');
		
		$where = array(
		 	 array('condition' => $table.'.ClassId', 'value' => $ClassId)
		);
		$tjoin = array(
		 	array('TableName' => 'subject', 'Condition' => $table.'.SubjectId = subject.SubjectId')
		 );
		 $data['subjectlist'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 
	     $this->load->view('marks/subjectlist', $data);
		 
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
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'ExamTypeId' => $this->input->post('ExamTypeId'),
		   'StudentId' => $this->input->post('StudentId'),
		   'Marks' => $this->input->post('marksarray'),
		   'SubjectId' => $this->input->post('subjectarray'),
		   'Year' => $year, 
	   );
	   //print_r($data);
		$table= 'marks';
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('ExamTypeId', 'ExamTypeId', 'required');
		$this->form_validation->set_rules('StudentId', 'StudentId', 'required');
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
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$table = 'marks';
		$where = array(
			array('condition' => $table.'.MarksId', 'value' => $id)
		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.StudentId = studentclass.StudentId'),
			array('TableName' => 'exam', 'Condition' => $table.'.ExamTypeId = exam.ExamId')
		);
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		//print_r($data);
		foreach($data['result'] as $at){
			$ClassId = $at->StudentClass;
			$sectionId = $at->SectionId;
		}
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$table = 'studentclass';
		$where = array(
		 	array('condition' => $table.'.StudentClass', 'value' => $ClassId),
			array('condition' => $table.'.SectionId', 'value' => $sectionId),
			array('condition' => $table.'.Year', 'value' => $year)
		 );
		$data['studentclass'] = $this->Adminmodel->show_rows($table, $where);
				
		$table = 'exam';
		$where = array(
					array('condition' => $table.'.Year', 'value' => $year),
			        array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where = array());
		
		$table = 'section';
		$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['section'] = $this->Adminmodel->show_rows($table, $where);
				
		$table = 'course';
		$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
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
		
		$data = array(
			   'Marks' => $this->input->post('marksarray'),
		       'ExamTypeId' => $this->input->post('ExamTypeId'),
			   'StudentId' => $this->input->post('StudentId')
               
               
             );
		//print_r($data);
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('ExamTypeId', 'ExamTypeId', 'required');
		$this->form_validation->set_rules('StudentId', 'StudentId', 'required');
		//$this->form_validation->set_rules('Year', 'Year', 'required');
		if ($this->form_validation->run() == true) {
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
		    echo $status;
		}
		else{
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
		echo "<td style='padding:5px; text-align:center; ' >" . $i++ . "</td>";  
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

