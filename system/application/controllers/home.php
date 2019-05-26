<?php
include ('Mail.php');
class Home extends Controller {

	var $pageinfo;
	var $url;
	function Home()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		//if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
	    $this->load->library('parser');
	    $this->load->model('Adminmodel');
		$this->load->database();
		//$this->load->database($this->session->userdata('database'), true);
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Home' );
	}
	
	function listview()
	{
		 $this->data['spentamount'] = 0;
		 $rollid = $this->session->userdata('rollid');
		 $menu['rollmenu'] = $this->Adminmodel->menu_show($rollid);
		 $this->pageinfo['event'] = 'List view';
		 $this->load->view('header', $this->pageinfo);
		 $this->load->view('menu', $menu);
	     $this->load->view('home/list');
	     $this->load->view('footer');
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
	   $sqla = "SELECT t1.StudentId, t2.StudentName, t3.ClassName, t1.TermNo, t1.ReceiptNo, t1.Fees 
		FROM schoolfees AS t1
		JOIN student AS t2 ON t1.StudentId = t2.StudentId
		JOIN studentclass AS t4 on t2.StudentRollNo = t4.RollNo 
		JOIN course AS t3 ON t4.StudentClass = t3.ClassId
		WHERE t1.PaidDate = '2013-12-17' and t1.InstituteId='1'";
	   $data['termfees'] = $this->Adminmodel->query_fun($sqla);   
	   $table = 'expenditure';
	   $data['spentamount'] = $this->Adminmodel->show_rows($table, $where = array());
	   $table = 'expendituretype';
	   $data['spentamount1'] = $this->Adminmodel->show_rows($table, $where = array());
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
	   
	   //$data['todayattenda'] = $this->Adminmodel->query_fun($sqla);
	   $sql1 = "select mtbl.cn, mtbl.male, mtbl.female, mtbl.sto from
		(SELECT course.ClassName as cn, COUNT(student.StudentId) as sto,
	   SUM(IF(student.Gender = 'm', 1, 0)) AS  'male', 
	   SUM(IF(student.Gender = 'f', 1, 0)) AS 'female' 
	   FROM student
	   JOIN studentclass ON student.StudentRollNo = studentclass.RollNo
	   JOIN course ON studentclass.StudentClass = course.ClassId
	   GROUP BY course.ClassId) 
	   as mtbl";
	   $data['totalattend'] = $this->Adminmodel->query_fun($sql1);
	   
	   $sql2 = "select stbl.male, stbl.female, stbl.ttol from
	   (SELECT course.ClassName, COUNT(student.StudentRollNo) as ttol,
	   SUM(IF(student.Gender = 'm', 1, 0)) AS  'male', 
	   SUM(IF(student.Gender = 'f', 1, 0)) AS 'female'
	   FROM student
	   JOIN dailyattendence ON dailyattendence.StudentId = student.StudentId
	   JOIN studentclass ON studentclass.RollNo = student.StudentRollNo
	   JOIN course ON course.ClassId = studentclass.StudentClass 
	   WHERE dailyattendence.attendDate = '2012-12-25'
	   GROUP BY course.ClassId)
	   as stbl";
	   
	   $data['todayattend'] = $this->Adminmodel->query_fun($sql2);
		  $this->load->view('home/today', $data);
	}
	
	function studentinfo()
	{
	    $data['student']  = 0;
		$data['marks'] = 0;
		$data['attend'] = 0;
		$data['marksa'] = 0;
		$data['examtype'] = 0;
		//$data['schoolfee'] = 0;
		$this->load->model('Adminmodel');
		$table = 'exam';
		$where = array();
		$data['url'] = base_url();
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('home/student', $data);
	}
	
	function staffinfo()
	{
	     $data['staff']  = 0;
		 $this->load->view('home/staff', $data);

	}
	
	function staffsearch(){
		 $table = 'staff';
		 $StaffId = $this->input->post('StaffId');
		 $field = 'StaffId';
		 $data['staff'] = $this->Adminmodel->fetch_srow($field, $StaffId, $table);
		 $this->load->view('home/staff', $data);
	}
	
	function studentsearch(){
		 $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			 if($yno->AcademicYear != NULL){
				 $year = $yno->AcademicYear;
			 }
		 }
		 $StudentId = $this->input->post('StudentId');
		 //$field = 'StudentRollNo';
		 
		 $sqla1 = "SELECT * from student as t1 join nationality as t2 on t1.NationalityId = t2.NationalityId  
		 join studentclass as t5 on t1.StudentId = t5.StudentId join course as t3 on t5.StudentClass = t3.ClassId join castcategory as t4 on t1.CastCategoryId = t4.CastCategoryId where t1.StudentId = $StudentId";
		 $data['student'] = $this->Adminmodel->query_fun($sqla1);
		 //var_dump($data['student']);
		 
		 //$data['student'] = $this->Adminmodel->fetch_strow($field, $rollno, $table);
		 
		 //$table = 'attendence';
		 //$field = 'RollNo';
		 
		 //$sqlb1 = "SELECT * from attendence where StudentId = ".$StudentId;
		 //$data['attend'] = $this->Adminmodel->query_fun($sqlb1);
		 
		 //$data['attend'] = $this->Adminmodel->fetch_row($field, $rollno, $table);
		 
		 //$table = 'exam';
		 $sqlc1 = "SELECT * from exam";
		 $data['examtype'] = $this->Adminmodel->query_fun($sqlc1);
		 //$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		
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
		$sqlb = $sql . $sqla .' FROM marks join subject on marks.SubjectId = subject.SubjectId WHERE marks.RollNo = '.$StudentId.'  GROUP BY marks.SubjectId';
		//var_dump($sqlb);
		$data['marksa'] = $this->Adminmodel->query_fun($sqlb);
		
		$sqlc3 = "SELECT * from schoolfees where StudentId = $StudentId and Year = '$year'";
		 $data['schoolfee'] = $this->Adminmodel->query_fun($sqlc3);
		 
		  $sqlc4 = "SELECT ClassFees from classfees where ClassId = 11 and Year = '$year'";
		 $data['classfees'] = $this->Adminmodel->query_fun($sqlc4);
		 foreach($data['classfees'] as $row){
		 	$data['cfees'] = $row->ClassFees;
		 }
		 
		$this->load->view('home/student', $data);
	}
	
	function studentmarks(){
		 $table = 'student';
		 $StudentId = $this->input->post('StudentId');
		/* $field = 'StudentRollNo';
		 $data['student'] = $this->Adminmodel->fetch_strow($field, $rollno, $table);
		 $table = 'marks';
		 $field = 'RollNo';
		 $data['marks'] = $this->Adminmodel->fetch_mkrow($field, $rollno, $table);
		 $table = 'attendence';
		 $field = 'RollNo';
		 $data['attend'] = $this->Adminmodel->fetch_row($field, $rollno, $table);
		*/ 
		 
		 $sqla1 = "SELECT * from student where StudentId = ".$StudentId;
		 $data['student'] = $this->Adminmodel->query_fun($sqla1);
		 
		 
		 //$data['student'] = $this->Adminmodel->fetch_strow($field, $rollno, $table);
		 
		 //$table = 'attendence';
		 //$field = 'RollNo';
		 
		 $sqlb1 = "SELECT * from attendence where StudentId = ".$StudentId;
		 $data['attend'] = $this->Adminmodel->query_fun($sqlb1);
		 
		 //$data['attend'] = $this->Adminmodel->fetch_row($field, $rollno, $table);
		 
		 //$table = 'exam';
		 $sqlc1 = "SELECT * from marks where StudentId = ".$StudentId;
		 $data['marks'] = $this->Adminmodel->query_fun($sqlc1);
		 //$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		 
		
			 $this->load->view('home/student');
	}
	
	function libraryinfo()
	{	
		 $table = 'libraryrecord';
		 $fielda = 'IssuedDate';
		 $fieldb = 'ReturnDate';
		 $row = '2013-10-09';//date('Y-m-d');
		 $row1 = '2013-10-15';
		 $data['issued'] = $this->Adminmodel->show_ilrows($fielda, $row1, $table);
		 $data['received'] = $this->Adminmodel->show_rlrows($fieldb, $row, $table);
		 $this->load->view('home/library', $data);
	}
	
	function sendmail()
	{
		 $table = 'course';
		 $data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		 
		 $table = 'student';
		 $data['student'] = $this->Adminmodel->show_rows($table, $where = array());
		 
	     $this->load->view('home/sendmail', $data);

	}
	
	function sendsms()
	{		 
		 $table = 'student';
		 $data['student'] = $this->Adminmodel->show_rows($table, $where = array());

		 $table = 'course';
		 $data['course'] = $this->Adminmodel->show_rows($table, $where = array());
	     $this->load->view('home/sendsms', $data);

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
		 
		 $this->load->view('home/section', $data);
	}
	
	function numberslist()
	{
	 	 $table = 'studentclass';
		 $fielda = 'SectionId';
		 $fieldb = 'StudentClass';
		 $ClassId = $this->input->post('ClassId');
		 $SectionId = $this->input->post('SectionId');
		
		if($SectionId != 'a'){
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $ClassId),
				array('condition' => $table.'.'.$fielda, 'value' => $SectionId)
			 );
	    }else{
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $ClassId)
			 );
		}
	    
		 $tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.RollNo = student.StudentRollNo'),
		 );
		 $data['numbers'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		 
		 $this->load->view('home/numbers', $data);
	}
	
	function emaillist(){
	
		 $table = 'studentclass';
		 $fielda = 'SectionId';
		 $fieldb = 'StudentClass';
		 $ClassId = $this->input->post('ClassId');
		 $SectionId = $this->input->post('SectionId');
		
		if($SectionId != 'a'){
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $ClassId),
				array('condition' => $table.'.'.$fielda, 'value' => $SectionId)
			 );
	    }else{
			$where = array(
				array('condition' => $table.'.'.$fieldb, 'value' => $ClassId)
			 );
		}
	    
		 $tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId'),
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
		 $m = '<'.$this->input->post('Mail').'>';
		 $ml = $this->input->post('MailList');
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
		  $sm = new  Mail(); 
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
	$NumbersList = $this->input->post('NumberList');
	$message = $this->input->post('Message');
	if($this->input->post('Numbers') != '' && $this->input->post('NumberList') == ''){
		$numbers = $this->input->post('Numbers');
	}else if($this->input->post('Numbers') == '' && $this->input->post('NumberList') != ''){
		$numbers = $this->input->post('NumberList');
	}else {
		$numbers = $this->input->post('NumberList') .','.$this->input->post('Numbers');
	}
		//echo 'Numbers: '.$numbers;
		echo file_get_contents("http://s2.freesmsapi.com/messages/send?skey=afa1292d2d3b823d6bcb9c91cfa3db1a&message=".urlencode($message)."&recipient=".$numbers);
	
	}
	
}

/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */
