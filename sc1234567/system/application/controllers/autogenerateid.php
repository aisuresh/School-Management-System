<?php

class Autogenerateid extends Controller {

	var $pageinfo;
	var $url;
	function __construct()
	{
		parent::Controller();
		$this->load->helper('html');
		$this->load->library('session');
		$this->load->helper('url');
	    $this->load->library('parser');	
		$this->load->database();
		$this->load->model('Adminmodel');
		$this->url = base_url();
		$this->load->library('form_validation');
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url);
	}
	
	 function GenerateRollNo()
	{
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'studentclass';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['studentclass'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('autogenerateid/Rollno',$data);
		$this->load->view('footer');
	
	}
	 function updaterollno()
	 {
	   $table = 'student';
	   $class = $this->input->post('ClassId');
	   $section =  $this->input->post('SectionId');
	   $medium =  $this->input->post('Medium');
	   $field = 'StudentName';
	   $tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
	   );
	   $where = array(
			array('condition' => 'studentclass.StudentClass', 'value' => $class),
			array('condition' => 'studentclass.SectionId', 'value' =>  $section),
			array('condition' => 'studentclass.Medium', 'value' => $medium),
			
		);
		$studentname= $this->Adminmodel->order_by($table,$tableArray,$field,$where);
		var_dump($studentname);
		$i=1;
		foreach($studentname as $st):
		   for($i=0;$i<=count($st);$i++){
		       $sql="UPDATE studentclass SET RollNo =$i";
			   $status = $this->Adminmodel->query_fun($sql);
			   }
			   echo $status;
			 endforeach;
		$table = 'studentclass';
	   $class = $this->input->post('ClassId');
	   $section =  $this->input->post('SectionId');
	   $medium =  $this->input->post('Medium');
	   $where = array(
			array('condition' => 'studentclass.StudentClass', 'value' => $class),
			array('condition' => 'studentclass.SectionId', 'value' =>  $section),
			array('condition' => 'studentclass.Medium', 'value' => $medium),
			
		);
	   $status = $this->Adminmodel->show_rows($table,$where);  
	   if(isset($status) && count($status) >0){
	   foreach($status as $sl){
	   $sql1 ="SET @RollNo=0";
	    $sql2 ="SELECT IF(@RollNo:='', @RollNo+1,@RollNo) RollNo,StudentName FROM (SELECT StudentName FROM student JOIN studentclass ON           studentclass.StudentId = student.StudentId WHERE studentclass.StudentClass=$sl->StudentClass AND studentclass.SectionId=$sl->SectionId ORDER BY StudentName ASC) AS student
ORDER BY RollNo ASC";
        $sql3= $this->Adminmodel->query_fun($sql1);
		$sql4= $this->Adminmodel->query_fun($sql2);
        $sql5= $sql3.$sql4;
		$sql= $this->Adminmodel->query_fun($sql5);
	 		}
			} 
			
		echo $sql;
		
	
	 
	  
	}
	 
	

}
/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */
