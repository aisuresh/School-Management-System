<?php
class Schoolfee extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'School Fees');
		$this->input->post();
		$this->load->library('session');
        $this->load->helper('url');
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
	}
	
	function listview()
	{
		$table = 'schoolfees';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'schoolfee/listview/'.$this->pyear;
		$table = 'schoolfees';		
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'SchoolFeeId';
		$this->session->set_userdata('yearsf', $this->pyear);
		$tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId')
		);
		//$tableArray=array();
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => 'studentclass'.'.Year', 'value' => $this->pyear),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		//$where = array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('schoolfee/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'schoolfees';
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'School Fees', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'schoolfee/listview/'.$this->pyear;
		$table = 'schoolfees';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$this->session->set_userdata('yearsf', $this->pyear);
		$tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId')
		);
	
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
		    array('condition' => 'studentclass'.'.Year', 'value' => $this->pyear),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('schoolfee/list', $data);
	}
	
	function search_data(){
		$table = 'schoolfees';
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'School Fees', 'url' =>$this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'schoolfee/listview/'.$this->pyear;
		$table = 'schoolfees';
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
		$sortby = 'SchoolFeeId';
		$this->session->set_userdata('yearsf', $this->pyear);
		$tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			 array('condition' => 'studentclass'.'.Year', 'value' => $this->pyear),
			 array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('schoolfee/list', $data);
	}
	
	 function view()
	{
		$table = 'schoolfees';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId')
		);
		$where = array(
			 array('condition' => $table.'.SchoolFeeId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$where = array();
		$table = 'student';
		$data['rollno'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'exam';
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where);		
		$this->load->view('schoolfee/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$where = array();
		$table = 'exam';
		$data['examtype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'subject';
		$data['subject'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'course';
		$where = array(
		 			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			
		 );
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('schoolfee/addnew', $data);
		$this->load->view('footer');
	}
	
	function section()
	{
		$table = 'sectionclass';
		 $fielda = 'ClassId';
		 $row = $this->input->post('ClassId');
		
		$where = array(
		 	array('condition' => $table.'.ClassId', 'value' => $row),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
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
			 array('condition' => $table.'.Year', 'value' => $Year),
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		 );
		 
		 $tjoin = array(
		 	array('TableName' => 'student', 'Condition' => $table.'.StudentId = student.StudentId'),
		 );
		 $data['studentlist'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		//echo $data['studentlist'];
		echo '<option value="x" >-- Select RollNo --</option>';
	   foreach($data['studentlist']  as $rno ){
		echo '<option value="'.$rno->StudentId.'" >'.$rno->StudentRollNo.'-'.$rno->StudentName.'</option>';
		//$this->load->view('attendence/studentlist', $data);
	}
	}

	
	function examtype()
	{
		$table = 'exam';
		$field = 'ExamId';
		$id = $this->input->post('ExamTypeId');
		$data = $this->Adminmodel->fetch_row($field, $id, $table);
		foreach($data as $row ){
			echo $row->ExamMarks;
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
		 $MaxreceiptNo = $this->Adminmodel->maxvalue($table = 'schoolfees', $fields = array('ReceiptNo'), $where = array());
		foreach($MaxreceiptNo as $yno){
			if($yno->ReceiptNo != NULL){
				$MaxreceiptNo = $yno->ReceiptNo;
			}
		}	
		$table = 'schoolfees';
		$data = array(
		    'InstituteId' =>  $this->session->userdata('InstituteId'),
			'StudentId' => $this->input->post('StudentId'),
			'Fees' =>  $this->input->post('Fees'),
			'ReceiptNo' =>  $MaxreceiptNo+1,
			'TermNo' =>  $this->input->post('TermNo'),
			'PaidDate' =>  date('Y-m-d'),
			'SchoolFeeDes' => $this->input->post('SchoolFeeDes'),
			'Year' => $year
		);
		
	    $this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('Fees', 'Fees', 'required');
		//$this->form_validation->set_rules('ReceiptNo', 'Receipt No', 'required');
		$this->form_validation->set_rules('TermNo', 'Term No', 'required');
		$this->form_validation->set_rules('PaidDate', 'PaidDate', 'required');
		
		if ($this->form_validation->run() == true){ 
			$status = $this->Adminmodel->save_data($data, $table);
			echo $status;
			//if($status == true){
				//$this->load->view('schoolfee/receipt', $data);
			//}
			//echo 1;
		} else{
			//$this->listview();
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
		
		$table = 'schoolfees';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'SchoolFeeId';
		$class=$this->input->post('ClassId');
		$where = array(
		 	array('condition' => $table.'.'.$field, 'value' => $id),
			array('condition' => $table.'.Year', 'value' => $year),
		    array('condition' => 'studentclass'.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			


		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.StudentId = studentclass.StudentId'),
			//array('TableName' => 'studentclass' , 'Condition' => $table.'.Year=studentclass.Year' )
		);
		
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
	
		foreach($data['result'] as $cs){
			$class = $cs->StudentClass;
		}
		$data['class'] = $class;
		$table = 'sectionclass';
		$field='ClassId';
		$where = array(
		 	array('condition' => $table.'.ClassId', 'value' => $class)
		);
		$tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId')
		);
		$data['section'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		/*$table = 'studentclass';
		$where= array(
			array('condition' => $table.'.StudentClass', 'value' => $class),
		);
		$data['student'] = $this->Adminmodel->show_rows($table, $where);*/
		$table = 'course';
		$where = array(
				
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'section';
		$where = array();
		$data['section'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('schoolfee/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$table = 'schoolfees';
		$field = 'SchoolFeeId';
		$id = $this->input->post('SchoolFeeId');
		$PaidDate=date("Y-m-d", strtotime($this->input->post('PaidDate')));
		$data = array(
		    'InstituteId' =>  $this->session->userdata('InstituteId'),
			'StudentId' => $this->input->post('StudentId'),
			'Fees' =>  $this->input->post('Fees'),
			'ReceiptNo' =>  $this->input->post('ReceiptNo'),
			'TermNo' =>  $this->input->post('TermNo'),
			'PaidDate' => $PaidDate,
			'SchoolFeeDes' => $this->input->post('SchoolFeeDes'),
			'Year' => $year
		);
	    
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('Fees', 'Fees', 'required');
		$this->form_validation->set_rules('ReceiptNo', 'ReceiptNo', 'required');
		$this->form_validation->set_rules('TermNo', 'TermNo', 'required');
		$this->form_validation->set_rules('PaidDate', 'PaidDate', 'required');
		
		if ($this->form_validation->run() == true) {
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			echo $status;
		} else{
			$this->listview();
		}
		
	}
	
	//---------------------------------------------------------------------------------------------------
	/*--- Class wise fees display and calculation is done here ---*/
	/*--- Done By: Priti ---*/
	/*--- Dated: 8th February,2012 ---*/
	//---------------------------------------------------------------------------------------------------
	function classwisefees(){
		$this->pageinfo['event'] ='ClassWise Fees';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		/*/*$table = 'section';
		$data['section'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'classrollnumbers';
		$data['classroll'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'course';
		$data['class'] = $this->Adminmodel->show_rows($table, $where);
*/		
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('schoolfee/classwisefees', $data);
		$this->load->view('footer');
	
	}
	function getSection(){
		$table='sectionclass';
		$tableArray = array(
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId = section.SectionId')
		);
		$id=$this->input->post('ClassId');
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $id)
		);
		
		$data['section'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$this->load->view('schoolfee/class_section', $data);
	}
	function getRollNo(){
		$table='classyear';
		$tableArray = array(
			//array('TableName' => 'student', 'CompairField' => $table.'.RollNumberId = studentrollnumbers.RollNumberId')
		);
		$class=$this->input->post('ClassId');
		$section=$this->input->post('SectionId');
		$where = array(
				 array('condition' => $table.'.ClassId', 'value' => $class),
				 array('condition' => $table.'.SectionId', 'value' => $section)
		);
		
		$data['rollno'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$this->load->view('schoolfee/studentroll', $data);
	}
	function getSchoolfees(){
		$table = 'schoolfees';
		$class=$this->input->post('ClassId');
		$section=$this->input->post('SectionId');
		$StudentId = $this->input->post('StudentId');
		$year = $this->input->post('Year');
		$where = array(
			array('condition' => $table.'.StudentId', 'value' => $StudentId),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		
		$tjoin = array(
			array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId'),
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId'),
			array('TableName' => 'section' , 'Condition' => 'studentclass.SectionId=section.SectionId')
		);
		$data['records'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		$table = 'schoolfees';
		$where = array(
			array('condition' => $table.'.StudentId', 'value' => $StudentId),
			array('condition' => $table.'.Year', 'value' => $year),
		);
		$tjoin = array(
		  array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId'),
		  array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId'),
		  array('TableName' => 'section' , 'Condition' => 'studentclass.SectionId=section.SectionId')
		  );
		$studentfees = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		//print_r($studentfees);exit;
		$studenttfees  = '';
		foreach($studentfees  as $sf){
			$studenttfees += $sf->Fees;
		}
		$data['studentfees'] = $studenttfees;
			
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table='schoolfees';
		$StudentId = $this->input->post('StudentId');
		$tableArray = array(
								 //array('TableName' => 'studentrollnumbers', 'CompairField' => $table.'.RollNo = studentrollnumbers.RollNumberId')
		);

		$where = array(
			//array('condition' => $table.'.ClassId', 'value' => $class),
			 //array('condition' => $table.'.SectionId', 'value' => $section),
			 array('condition' => $table.'.StudentId', 'value' => $StudentId),
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		//var_dump($data['result']);
		foreach($data['result'] as $row)
		{
			//print_r ($row->Fees);
			$paid = $row->Fees;
			$table = 'classfees';
			$class=$this->input->post('ClassId');
			$where = array(
							 array('condition' => $table.'.ClassId', 'value' => $class)
			);
			$tableArray = array();
			
			$data['fees'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
			foreach($data['fees'] as $fee)
			{
				if($fee->ClassFees > $paid)
				{
					$data['totalfee'] = $fee->ClassFees;
					$data['amtRemaining'] = $fee->ClassFees - $paid;
				}
			}
		}
			$table = 'studentfees';
			$StudentId = $this->input->post('StudentId');
			
			$where = array(
				array('condition' => $table.'.StudentId', 'value' => $StudentId),
				array('condition' => $table.'.Year', 'value' => $year),
				//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			
			);
			
			$data['fees'] = $this->Adminmodel->show_rows($table, $where);
			$Tfees  = 0;
			foreach($data['fees'] as $fee)
			{
				 $Tfees += $fee->Fees;
			}
			$data['totalfee'] = $Tfees;
			$this->load->view('schoolfee/showschoolfees', $data);
	
	}
	function getstudentinfo(){
	
		$table = 'studentclass';
		$rollno = $this->input->post('StudentId');
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId = student.StudentId'),
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId = section.SectionId')
		);

		$where = array(
			 array('condition' => $table.'.StudentId', 'value' => $rollno)
		);
		
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		foreach($result as $sinfo){
			$StudentName = $sinfo->StudentName;
			$FatherName = $sinfo->FatherName;
			$Class = $sinfo->StudentClass;
			$Section = $sinfo->SectionName;
		}
		
		$str = '<tr style  = "height:25px;" >
				<td width="20%" align="right" class = "datafield" style  = "height:25px;" >Name:</td>
				<td width="40%" class = "dataview" style ="padding-left:10px;" >'.$StudentName.'</td>
				<td width="20%" align="right" class = "datafield" style  = "height:25px;" >Father Name:</td>
				<td width="40%" class = "dataview" style ="padding-left:10px;" >'.$FatherName.'</td>
			</tr>
			 <tr>
				<td align="right" class = "datafield" style  = "height:25px;" >Class:</td>
				<td class = "dataview" style ="padding-left:10px;" >'.$Class.'</td>
				<td align="right" class = "datafield"style  = "height:25px;"  >Section:</td>
				<td class = "dataview" style ="padding-left:10px;" >'.$Section.'</td>
			 </tr>
			<tr>
				<td align="right" class = "datafield" style  = "height:25px;" >Paid Date:</td>
				<td class = "dataview" style ="padding-left:10px;" >'.date('d-m-Y').'</td>
				<td align="right" class = "datafield" style  = "height:25px;" >Receipt No:</td>
				<td class = "dataview" style ="padding-left:10px;" >1234</td>
			</tr>';
			echo $str;
	}
	
	
	//---------------------------------------------------------------------------------------------------
	/*--- Class wise fees function details ends here ---*/
	//---------------------------------------------------------------------------------------------------
	function export()
	{
		$table = 'schoolfees';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = SchoolFees.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$tableArray = array(
			//array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId'),
			//array('TableName' => 'course', 'CompairField' => 'studentclass.StudentClass=course.ClassId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->session->userdata('yearsf'))
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		//$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Roll No</th>";
		echo "<th align='center' >School Fees</th>";
		echo "<th align='center' >Recept No</th>";
		echo "<th align='center' >Term No</th>";
		echo "<th align='center' >Paid Date</th>";
		echo "<th align='center' >Description</th>";
		echo "</tr>";
		$i= 1;
		//var_dump($result);
		foreach($result as $row):
		if($i % 2){
			$master_tr_bgcolor = 'background-color:#f8fcfc; border-right:1px solid #a4a9a8; padding-left:5px;';
		}else{
			$master_tr_bgcolor = 'background-color:#e4ebec; border-right:1px solid #a4a9a8; padding-left:5px;';
		}
		
		echo "<tr style='" . $master_tr_bgcolor . "'>";
		echo "<td style='padding:5px; text-align:center; ' >" . $i ++ . "</td>";  
		echo "<td align='center'>" . $row->RollNo . "</td>";
		echo "<td align='center'>" . $row->Fees . "</td>";
		echo "<td align='center'>" . $row->ReceiptNo . "</td>";
		echo "<td align='center'>" . $row->TermNo . "</td>";
		echo "<td align='center'>" . $row->PaidDate . "</td>";
		echo "<td align='center'>" . $row->SchoolFeeDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

	function termno(){
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		 foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'schoolfees';
		$id = $this->input->post('RollNo');
		$sql ="select MAX(TermNo) as tno from schoolfees where RollNo = $id and Year = '$year'";
		$data['termno'] = $this->Adminmodel->query_fun($sql);
		foreach ($data['termno'] as $row){
			if($row->tno != NULL){ 
				echo $row->tno;
			}else{
				echo 0;
			}	
		}
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

