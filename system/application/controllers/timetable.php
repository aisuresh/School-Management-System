<?php

class Timetable extends Controller {
	
	var $pageinfo;
	var $url;
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		//if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Time Table', 'event' => 'List');
	}
	
	function listview()
	{
		  $this->parser->parse('header', $this->pageinfo);
		  $this->load->view('menu');
		  $this->load->view('timetable/list');
		  $this->load->view('footer');
	}
	
	function addnew()
	{
		  $this->pageinfo['event'] = 'AddNew'; 
		  $this->parser->parse('header', $this->pageinfo);
		  $this->load->view('menu');
		  $this->load->view('timetable/addnew');
		  $this->load->view('footer');
	}
	
	function edit()
	{
		  $this->pageinfo['event'] = 'Edit'; 
		  $this->parser->parse('header', $this->pageinfo);
		  $this->load->view('menu');
		  $this->load->view('timetable/edit');
		  $this->load->view('footer');
	}
	
	function showsubjects(){
		$table = 'facultylist';
		$id = $this->input->post('teacher');
		//$SubjectId = $this->input->post('subject');
		$tableArray = array(
			array('TableName' => 'subject', 'CompairField' => $table.'.SubjectId = subject.SubjectId')
		);
		$where = array(
			array('condition' => $table.'.TeacherId', 'value' => $id)
		);
		
		$subjets = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$str2 = '';
		$str1 = '<option value = "x" >-- Subject --</option>';
		foreach($subjets  as $sub){
			//if($SubjectId  == $sub->SubjectId){
				//$str2 .= '<option value ='. $sub->SubjectId.' selected >'.$sub->SubjectName.'</option>';
			//}else{
				$str2 .= '<option value ='. $sub->SubjectId.' >'.$sub->SubjectName.'</option>';
			//}
		}
		echo $str = $str1.$str2;
	}
	
	function save(){
		$teachers = $this->input->post('teachers');
		$subjects = $this->input->post('subjects');
		$class = $this->input->post('classid');
		$week = $this->input->post('week');
		$period = $this->input->post('period');
		//echo $teachers;
		$teacherArray = explode(',', $teachers);
		$subjectsArray = explode(',', $subjects);
		$classArray = explode(',', $class);
		$weekArray = explode(',', $week);
		$periodArray = explode(',', $period);
		$table = 'timetable';
		
		for($i = 0; $i < count($teacherArray); $i++){
			$data = array(
				'TeacherId' => $teacherArray[$i],
				'SubjectId' => $subjectsArray[$i],
				'ClassId' => $classArray[$i],
				'PeriodId' => $periodArray[$i],
				'DayId' => $weekArray[$i],
				'Year' => $year,
			);
			$status = $this->Adminmodel->save_data($data, $table);
			
		}
		if($status){
			echo 1;
		}else{
			echo 2;
		}
	}
	
	function update(){
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$teachers = $this->input->post('teachers');
		$subjects = $this->input->post('subjects');
		$class = $this->input->post('classid');
		$week = $this->input->post('week');
		$period = $this->input->post('period');
		//echo $teachers;
		$teacherArray = explode(',', $teachers);
		$subjectsArray = explode(',', $subjects);
		$classArray = explode(',', $class);
		$weekArray = explode(',', $week);
		$periodArray = explode(',', $period);
		
		echo $week;
		$table = 'timetable';
		
		for($i = 0; $i < count($teacherArray); $i++){
			$data = array(
				'TeacherId' => $teacherArray[$i],
				'SubjectId' => $subjectsArray[$i],
				'ClassId' => $classArray[$i],
				'PeriodId' => $periodArray[$i],
				'DayId' => $weekArray[$i],
				'Year' => $year,
			);
			$sql = "select * from timetable where ClassId = '$classArray[$i]' and SubjectId = '$subjectsArray[$i]' and TeacherId = '$teacherArray[$i]' and PeriodId = '$periodArray[$i]' and  DayId = '$weekArray[$i]' and Year = '$year'";
			$timetablelist = $this->Adminmodel->query_fun($sql);
			if(count($timetablelist) > 0){
				$where = array(
					array('condition' => $table.'.ClassId', 'value' => $classArray[$i]),
					array('condition' => $table.'.PeriodId', 'value' => $periodArray[$i]),
					array('condition' => $table.'.DayId', 'value' => $weekArray[$i]),
					array('condition' => $table.'.Year', 'value' => $year)
				);
				if($i <= 8){
					$status = $this->Adminmodel->update_multi_data( $where, $data, $table);
				}
			}else{
				$status = $this->Adminmodel->save_data($data, $table);
			}	
			
		}
		if($status){
			echo 1;
		}else{
			echo 2;
		}
	}
	
}

/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */