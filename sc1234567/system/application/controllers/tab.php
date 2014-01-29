<?php

class Tab extends Controller {

	var $pageinfo;
	var $url;
	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		//if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
	    $this->load->library('parser');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Home' );
	}
	
	function index()
	{
		 $this->load->view('tab/header', $this->pageinfo);
	     $this->load->view('tab/login');
	     $this->load->view('tab/footer');
	}
	
	function login()
	{
		$this->load->model('Loginmodel');
		$userid = $this->input->post('userid','User id', 'required');
		$userpd = $this->input->post('password', 'Password', 'required');
		$table = 'user';
		if(!empty($userid)  && !empty($userpd))
		{
			$where = array(
				array('condition' => $table.'.UserId', 'value' => $userid),
				array('condition' => $table.'.Password', 'value' => $userpd)
			);
			$flag = $this->Loginmodel->user_login($table, $where);
			if($flag == true)
			{
				$where = array(
					array('condition' => $table.'.UserId', 'value' => $userid),
				);
				$tableArray = array(
					array('TableName' => 'schoollist', 'CompairField' => $table.'.SchoolId=schoollist.SchoolId')
				);
				$result = $this->Loginmodel->fetch_row($table, $tableArray, $where);
				foreach($result as $row){
					$_SESSION['username'] = $row->UserName; 
					$this->session->set_userdata('username', $row->UserName);
					$this->session->set_userdata('rollid', $row->RollId);
					$this->session->set_userdata('database', $row->DatabaseNmae);
				}
				echo base_url().'tab/home';
			}else{
				echo base_url().'tab/index';
			}
		}else{
			echo base_url().'tab/index';
		}	
	}
	
	
	function home()
	{
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 $this->load->view('tab/header', $this->pageinfo);
		 $this->load->view('tab/menu');
	     $this->load->view('tab/home');
	     $this->load->view('tab/footer');
	}
	function dashboard()
	{
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 $this->load->view('tab/header', $this->pageinfo);
		 $this->load->view('tab/menu');
	     $this->load->view('tab/dashboard');
	     $this->load->view('tab/footer');
	}
	function attendance()
	{
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 $table = 'course';
		 $where = array();
		 $data['classes'] = $this->Adminmodel->show_rows($table, $where);
		 $this->load->view('tab/header', $this->pageinfo);
		 $this->load->view('tab/menu', $this->pageinfo);
	     $this->load->view('tab/attendance', $data);
	     $this->load->view('tab/footer');
	}
	
	function sectionlist(){
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 $table = 'sectionclass';
		 $class = $this->input->post('ClassId');
		 $where = array(
			array('condition' => $table.'.ClassId', 'value' => $class)
		 );
		 $tableArray = array(
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId = section.SectionId' )
		 );
		 $sections = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		 $str1 = '<option value = "x">-- Select Section --</option>';
		 $str2 = '';
		 foreach($sections as $sc){
		 	$str2 .= '<option value = "'.$sc->SectionId.'">'.$sc->SectionName.'</option>';
		 }
		 $str = $str1.$str2;
		 echo $str;
	}
	function show_student_list()
	{
		 $data['url'] = base_url();
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 $table = 'studentclass';
		 $class = $this->input->post('ClassId');
		 $section = $this->input->post('SectionId');
		 $where = array(
			array('condition' => $table.'.StudentClass', 'value' => $class),
			array('condition' => $table.'.SectionId', 'value' => $section)
		 );
		 $tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo = student.StudentRollNo' )
		 );
		 $data['studentlist'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
	     $this->load->view('tab/studentlist', $data);
	}
	
	function save_attendance(){
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 
		 $ClassId = $this->input->post('ClassId');
		 $SectionId = $this->input->post('SectionId');
		 $RollNo = $this->input->post('RollNo');
		 $Attendval = $this->input->post('attendval');
		 $SessionId = $this->input->post('SessionId');
		 $RollNoArray = explode(',', $RollNo);
		 $AttendArray = explode(',', $Attendval);
		 $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}

		for($i = 0; $i < (count($RollNoArray)); $i++ ){
			$table = 'dailyattendence';
		 	$data = array(
				'StudentId' => $RollNoArray[$i],
				'Attendance' => $AttendArray[$i],
				'ClassId' => $ClassId,
				'SectionId' => $SectionId,
				'SessionId' => $SessionId,
				'attendDate' => date('Y-m-d'),
				'Year' => $year
			);	
			$status = $this->Adminmodel->save_data($data, $table);
			if($status){
		 		$table = 'attendence';
				$where = array(
					array('condition' => $table.'.RollNo', 'value' => $RollNoArray[$i]),
					array('condition' => $table.'.MonthId', 'value' => date('m')),
					array('condition' => $table.'.Year', 'value' => $year)
				);
				$attendence = $this->Adminmodel->show_rows($table, $where);
				$Morning = 0;	
				$Afternoon = 0;
				if(isset($attendence) && count($attendence) > 0){
					foreach($attendence as $at){
						$Morning = $at->Morning;
						$Afternoon = $at->Afternoon;
					}
					if($SessionId == 1){
						$data = array(
							'Morning' => $Morning + $AttendArray[$i],
							'TotalDays' => ($Morning + $Afternoon)/2
						);
					}else{
						$data = array(
							'Afternoon' => $Afternoon + $AttendArray[$i],
							'TotalDays' => ($Morning + $Afternoon)/2
						);
					}	
					$this->Adminmodel->update_multi_data($where, $data, $table);
				}else{
					if($SessionId == 1){
						$data = array(
							'RollNo' => $RollNoArray[$i],
							'Year' => $year,
							'MonthId' => date('m'),
							'TotalDays' => (($AttendArray[$i] + $Afternoon)/2),
							'Morning' => $AttendArray[$i],
							'Afternoon' => $Afternoon
						);
					}else{
						$data = array(
							'RollNo' => $RollNoArray[$i],
							'Year' => $year,
							'MonthId' => date('m'),
							'TotalDays' => (($AttendArray[$i]+ $Morning) /2),
							'Morning' => $Morning,
							'Afternoon' => $AttendArray[$i],
						);
					}	
					$status = $this->Adminmodel->save_data($data, $table);
				}
			}
		 }
		 if($status){
			echo $this->url.'tab/attendsucces/'.urlencode($ClassId).'/'.urlencode($SectionId).'/'.urlencode($SessionId);
			//$this->attendsucces( $ClassId,  $SectionId,  $SessionId);
		 }else{
		 	echo 'error';
		 }
	}
	function attendsucces(){
		 $this->load->model('Adminmodel');
		 $this->load->database($this->session->userdata('database'), true);
		 $table = 'dailyattendence';
		 $ClassId = urldecode($this->uri->segment(3));
		 $SectionId = urldecode($this->uri->segment(4));
		 $SessionId = urldecode($this->uri->segment(5));
		 $where = array(
		 	array('condition' => $table.'.attendDate', 'value' => date('Y-m-d')),
			array('condition' => $table.'.ClassId', 'value' => $ClassId),
			array('condition' => $table.'.SectionId', 'value' => $SectionId),
			array('condition' => $table.'.SessionId', 'value' => $SessionId),
			
		 );
		 $data['attendsucces'] = $this->Adminmodel->show_rows($table, $where);
		 
		 $this->load->view('tab/header', $this->pageinfo);
		 $this->load->view('tab/menu', $this->pageinfo);
	     $this->load->view('tab/attendsucces', $data);
	     $this->load->view('tab/footer');
	}
	
	function todayinfo()
	{
		 $table = 'schoolfees';
		/* $this->where = array(
		 	array('condition' => $this->table.'.PaidDate', 'value' => '2011-09-21')
		 );
	    
		 $this->tjoin = array(
		 	array('TableName' => 'student', 'CompairField' => $this->table.'.RollNo = student.StudentRollNo'),
			array('TableName' => 'course', 'CompairField' => 'student.CourseId = course.ClassId')
		 );
		 $this->data['termfees'] = $this->Adminmodel->fetch_row($this->table, $this->tjoin, $this->where);*/
		 $this->load->model('Homemodel');
		 $sqla = "SELECT t1.RollNo, t2.StudentName, t3.ClassName, t1.TermNo, t1.ReceptNo, t1.Fees 
				FROM schoolfees AS t1
				JOIN student AS t2 ON t1.RollNo = t2.StudentRollNo
				JOIN studentclass AS t4 on t2.StudentRollNo = t4.RollNo 
				JOIN course AS t3 ON t4.StudentClass = t3.ClassId
				WHERE t1.PaidDate = '2011-09-21' ";
		 $data['termfees'] = $this->Homemodel->query_fun($sqla);		 
		 $table = 'expenditure';
		 $data['spentamount'] = $this->Homemodel->show_rows($table, $where = array());
		 $date = date('Y-m-d');		 
		 $sqla  = "SELECT  ClassName,ms,fs,totste,ma,fa,totatt,attper 
		        from (SELECT f2.ClassName,f1.ms,f1.fs,f1.totste,f1.ma,f1.fa,f1.totatt,f1.attper
				FROM
				(SELECT s1.CourseId,s1.ms,s1.fs,s1.totste,a1.ma,a1.fa,a1.totatt,(a1.totatt/s1.totste)*100 AS attper
				FROM
				(SELECT c1.CourseId,c1.tot AS fs,c2.tot AS ms,c1.tot+c2.tot AS totste
				FROM
				(SELECT a.CourseId, a.Gender, COUNT(*) AS tot FROM student AS a GROUP BY a.CourseId, a.Gender) AS c1,
				(SELECT a.CourseId, a.Gender, COUNT(*) AS tot FROM student AS a GROUP BY a.CourseId, a.Gender) AS c2
				WHERE
				c1.CourseId<>c2.CourseId AND c1.Gender=c2.Gender AND c1.Gender='f'
				ORDER BY c1.Courseid) AS s1,
				(SELECT d1.CourseId,d1.tot AS fa,d2.tot AS ma,d1.tot+d2.tot AS totatt
				FROM
				(SELECT b.CourseId,  b.Gender,COUNT(*) AS tot FROM dailyattendence AS a, student AS b 
				WHERE a.StudentId = b.StudentRollNo AND attendDate='$date' 
				GROUP BY b.CourseId,  b.Gender) AS d1,
				(SELECT b.CourseId,  b.Gender,COUNT(*) AS tot FROM dailyattendence AS a, student AS b 
				WHERE a.StudentId = b.StudentRollNo AND attendDate='$date' 
				GROUP BY b.CourseId,  b.Gender) AS d2
				WHERE d1.CourseId<>d2.CourseId AND d1.Gender=d2.Gender AND d1.Gender='f'
				ORDER BY d1.CourseId) AS a1
				WHERE
				s1.CourseId=a1.CourseId) AS f1,
				course AS f2
				WHERE
				f1.CourseId=f2.ClassId) as todayattend";
		 
		 //$data['todayattenda'] = $this->Homemodel->query_fun($sqla);
		 $sql1 = "select mtbl.cn, mtbl.male, mtbl.female, mtbl.sto from
		 	(SELECT course.ClassName as cn, COUNT(student.StudentId) as sto,
			SUM(IF(student.Gender = 'm', 1, 0)) AS  'male', 
			SUM(IF(student.Gender = 'f', 1, 0)) AS 'female' 
			FROM student
			JOIN studentclass ON student.StudentRollNo = studentclass.RollNo
			JOIN course ON studentclass.StudentClass = course.ClassId
			GROUP BY course.ClassId) 
			as mtbl";
		 $data['totalattend'] = $this->Homemodel->query_fun($sql1);
		 
		 $sql2 = "select stbl.male, stbl.female, stbl.ttol from
		 (SELECT course.ClassName, COUNT(student.StudentRollNo) as ttol,
			SUM(IF(student.Gender = 'm', 1, 0)) AS  'male', 
			SUM(IF(student.Gender = 'f', 1, 0)) AS 'female'
			FROM student
			JOIN dailyattendence ON dailyattendence.StudentId = student.StudentRollNo
			JOIN course ON course.ClassId = dailyattendence.ClassId 
			WHERE dailyattendence.attendDate = '2011-12-03'
			GROUP BY course.ClassId)
			as stbl";
		 
		 $data['todayattend'] = $this->Homemodel->query_fun($sql2);
	     $this->load->view('home/today', $data);

	}
	
	function studentinfo()
	{
	    $data['student']  = 0;
		$data['marks'] = 0;
		$data['attend'] = 0;
		$data['marksa'] = 0;
		$data['examtype'] = 0;
		$this->load->model('Homemodel');
		$table = 'exam';
		$where = array();
		$data['url'] = base_url();
		$data['examtype'] = $this->Homemodel->show_rows($table, $where);
		$this->load->view('home/student', $data);
	}
	
	function staffinfo()
	{
	     $data['staff']  = 0;
		 $this->load->view('home/staff', $data);

	}
	
	function staffsearch(){
		 $this->load->model('Homemodel');
		 $table = 'staff';
		 $StaffId = $_POST['StaffId'];
		 $field = 'StaffId';
		 $data['staff'] = $this->Homemodel->fetch_srow($field, $StaffId, $table);
		 $this->load->view('home/staff', $data);
	}
	
	function studentsearch(){
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		//$this->load->model('Homemodel');
		 //$table = 'student';
		 $rollno = $_POST['RollNo'];
		 //$field = 'StudentRollNo';
		 
		 $sqla1 = "SELECT * from student as t1 join nationality as t2 on t1.NationalityId = t2.NationalityId  
		 join studentclass as t5 on t1.StudentRollNo = t5.RollNo join course as t3 on t5.StudentClass = t3.ClassId join castcategory as t4 on t1.CastCategoryId = t4.CastCategoryId where t1.StudentRollNo = $rollno";
		 $data['student'] = $this->Homemodel->query_fun($sqla1);
		 //var_dump($data['student']);
		 
		 //$data['student'] = $this->Homemodel->fetch_strow($field, $rollno, $table);
		 
		 //$table = 'attendence';
		 //$field = 'RollNo';
		 
		 $sqlb1 = "SELECT * from attendence where RollNo = ".$rollno;
		 $data['attend'] = $this->Homemodel->query_fun($sqlb1);
		 
		 //$data['attend'] = $this->Homemodel->fetch_row($field, $rollno, $table);
		 
		 //$table = 'exam';
		 $sqlc1 = "SELECT * from exam";
		 $data['examtype'] = $this->Homemodel->query_fun($sqlc1);
		 //$data['examtype'] = $this->Homemodel->show_rows($table, $where);
		
		$i = 0;
		$rows = array();
		$SNo = array();
		foreach ($data['examtype'] as $row){
			$SNo[$i] = $row->ExamId;
			$SN[$i] = $row->ExamType;
			
			$i++;
		}
		
		  
		$sql = 'SELECT subject.SubjectName, '; 
		$sqla = ' ';
		for($j = 0; $j < count($SNo); $j++){
			  if($j != count($SNo)-1){
					$sqla = $sqla.' marks.TotalMarks,  SUM(IF(marks.ExamTypeId = '.($j+1).', Marks, 0)) AS  ExamTypeId'.($j+1).', ';
			   }else{
					$sqla = $sqla.' marks.TotalMarks,  SUM(IF(marks.ExamTypeId ='.($j+1).', Marks, 0)) AS  ExamTypeId'.($j+1);
			   }
		}
		$sqlb = $sql . $sqla .' FROM marks join subject on marks.SubjectId = subject.SubjectId WHERE marks.RollNo = '.$rollno.'  GROUP BY marks.SubjectId';
		//var_dump($sqlb);
		$data['marksa'] = $this->Homemodel->query_fun($sqlb);
		
		$sqlc3 = "SELECT * from schoolfees where RollNo = $rollno and Year = '$year'";
		 $data['schoolfee'] = $this->Homemodel->query_fun($sqlc3);
		 
		  $sqlc4 = "SELECT ClassFees from classfees where ClassId = 11 and Year = '$year'";
		 $data['classfees'] = $this->Homemodel->query_fun($sqlc4);
		 foreach($data['classfees'] as $row){
		 	$data['cfees'] = $row->ClassFees;
		 }
		 
		$this->load->view('home/student', $data);
	}
	
	function studentmarks(){
		 $this->load->model('Homemodel');
		 $table = 'student';
		 $rollno = $_POST['RollNo'];
		/* $field = 'StudentRollNo';
		 $data['student'] = $this->Homemodel->fetch_strow($field, $rollno, $table);
		 $table = 'marks';
		 $field = 'RollNo';
		 $data['marks'] = $this->Homemodel->fetch_mkrow($field, $rollno, $table);
		 $table = 'attendence';
		 $field = 'RollNo';
		 $data['attend'] = $this->Homemodel->fetch_row($field, $rollno, $table);
		*/ 
		 
		 $sqla1 = "SELECT * from student where StudentRollNo = ".$rollno;
		 $data['student'] = $this->Homemodel->query_fun($sqla1);
		 
		 
		 //$data['student'] = $this->Homemodel->fetch_strow($field, $rollno, $table);
		 
		 //$table = 'attendence';
		 //$field = 'RollNo';
		 
		 $sqlb1 = "SELECT * from attendence where RollNo = ".$rollno;
		 $data['attend'] = $this->Homemodel->query_fun($sqlb1);
		 
		 //$data['attend'] = $this->Homemodel->fetch_row($field, $rollno, $table);
		 
		 //$table = 'exam';
		 $sqlc1 = "SELECT * from marks where RollNo = ".$rollno;
		 $data['marks'] = $this->Homemodel->query_fun($sqlc1);
		 //$data['examtype'] = $this->Homemodel->show_rows($table, $where);
		 
		
			 $this->load->view('home/student');
	}
	
	function libraryinfo()
	{	
		 $this->load->model('Homemodel');
		 $table = 'libraryrecord';
		 $fielda = 'IssuedDate';
		 $fieldb = 'ReceivedDate';
		 $row = '2011-09-13';//date('Y-m-d');
		 $data['issued'] = $this->Homemodel->show_ilrows($fielda, $row, $table);
		 $data['received'] = $this->Homemodel->show_rlrows($fieldb, $row, $table);
		 $this->load->view('home/library', $data);
	}
	
	function sendmail()
	{
		 $this->load->model('Homemodel');
		 $table = 'course';
		 $data['course'] = $this->Homemodel->show_rows($table, $where = array());
		 
		 $table = 'student';
		 $data['student'] = $this->Homemodel->show_rows($table, $where = array());
		 
	     $this->load->view('home/sendmail', $data);

	}
	
	function sendsms()
	{
		 $this->load->model('Homemodel');
		 
		 $table = 'student';
		 $data['student'] = $this->Homemodel->show_rows($table, $where = array());

		 $table = 'course';
		 $data['course'] = $this->Homemodel->show_rows($table, $where = array());
	     $this->load->view('home/sendsms', $data);

	}
	
	function section()
	{
		 $table = 'sectionclass';
		 $fielda = 'ClassId';
		 $row = $_POST['ClassId'];
		
		$where = array(
		 	array('condition' => $table.'.'.$fielda, 'value' => $row)
		 );
	    
		 $tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId'),
		 );
		 $data['section'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 
		 $this->load->view('home/section', $data);
	}
	
	function numberslist()
	{
		 $table = 'student';
		 $fielda = 'SectionId';
		 $fieldb = 'CourseId';
		 $row = $_POST['ClassId'];
		 $row1 = $_POST['SectionId'];
		
		if($row1 != 'a'){
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $row),
				array('condition' => $table.'.'.$fielda, 'value' => $row1)
			 );
	    }else{
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $row)
				//array('condition' => $table.'.'.$fielda, 'value' => $row1)
			 );
		}
		 $tjoin = array(
		 	//array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId'),
		 );
		 $data['numbers'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 
		 $this->load->view('home/numbers', $data);
	}
	
	function emaillist(){
	
		 $table = 'student';
		 $fielda = 'SectionId';
		 $fieldb = 'CourseId';
		 $row = $_POST['ClassId'];
		 $row1 = $_POST['SectionId'];
		
		if($row1 != 'a'){
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $row),
				array('condition' => $table.'.'.$fielda, 'value' => $row1)
			 );
	    }else{
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $row)
				//array('condition' => $table.'.'.$fielda, 'value' => $row1)
			 );
		}
	    
		 $tjoin = array(
		 	//array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId'),
		 );
		 $data['emails'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 
		 $this->load->view('home/emails', $data);
	}
	
	function send_mail()
	{
		 
		 $emails = array();
		 $emailsa = array();
		 $Mail =  array();
		 $Mails = array();
		 $m = '<'.$_POST['Mail'].'>';
		 $ml = $_POST['MailList'];
		 if( $m != '')
		 {
		 	$Maila = explode(',', $m);
			if(count($Maila) <= 0){
				$Mail = $m; 
			}else{
				$Mail = explode(',', $m);
			}
		 }
		 
		if( $ml != ''){
			$Mailsa = explode(',',  $ml);
			if(count($Mailsa) <= 0){
				$Mails =  $ml; 
			}else{
				$Mails = explode(',',  $ml);
			}
		
		}
		
		 //var_dump($Mails);
		 if(count($Mail) > 0){
			array_push($emails, $Mail);
			echo '1'.'<br />';
		 }else if(count($Mails) > 0){
			array_push($emails, $Mails);
			echo '2'.'<br />';
		 }else if(count($Mail) > 0 && count($Mails) > 0){
		 
			array_push($emails, $Mail);
			array_push($emails, $Mails);
			echo '3'.'<br />';
		 }
		 
		 /*if($m != '<>'){
			array_push($emails, $m);
			echo '1'.'<br />';
		 }else if($ml != ''){
			array_push($emails, $ml);
			echo '2'.'<br />';
		 }else if($m != '<>' && $ml != ''){
		 
			array_push($emails, $m);
			array_push($emails, $ml);
			echo '3'.'<br />';
		 }*/
		 //$emails = array($ml);
		// var_dump($emails[0]);
		 //$_SESSION['maile'] = $_POST['MailList']; //$email = array($emails);
		 $emails = array("<valmiki.2505@gmail.com>", "<valmiki81@gmail.com>");
		 var_dump($emails );
		 $from = '<valmiki81@gmail.com>';
		 $to = "<valmiki.2505@gmail.com>";
		 $subject = $_POST['Subject'];
		 $body = $_POST['Message'];
		 
		 $host = "smtp.gmail.com";
		 $port = "465";
		 $username = "valmiki81@gmail.com";
		 $password = "sujata@1981";
		 
		 $headers = array ('From' => $from,
		   'To' => $to,
		   'Subject' => $subject);
		   $sm = new Mail(); 
		 $smtp = $sm->factory('smtp',
		   array ('host' => $host,
			 'port' => $port,
			 'auth' => true,
			 'username' => $username,
			 'password' => $password));
		 
		 $mail = $smtp->send($to, $headers, $body);
		 $pr = new PEAR();
		 if ($pr->isError($mail)) 
		 {
		   echo("<p>" . $mail->getMessage() . "</p>");
		 } else {
		   echo("1");
		 }

	}
	
	function send_sms(){
	$NumbersList = $_POST['NumberList'];
	$message = $_POST['Message'];
	if($_POST['Numbers'] != '' && $_POST['NumberList'] == ''){
		$numbers = $_POST['Numbers'];
	}else if($_POST['Numbers'] == '' && $_POST['NumberList'] != ''){
		$numbers = $_POST['NumberList'];
	}else {
		$numbers = $_POST['NumberList'] .','.$_POST['Numbers'];
	}
		//echo 'Numbers: '.$numbers;
		echo file_get_contents("http://s2.freesmsapi.com/messages/send?skey=afa1292d2d3b823d6bcb9c91cfa3db1a&message=".urlencode($message)."&recipient=".$numbers);
	
	}
	
}

/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */
