<?php
class Hostelrecord extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Hostel Record');
		$this->input->post();
		$this->load->library('session');
        $this->load->helper('url');
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
	}
	
	function listview()
	{
		$table = 'hostelrecord';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'hostelrecord/listview/'.$this->pyear;
		
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}

		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'HostelRecordId';
		
		
		$this->session->set_userdata('yearhr', $this->pyear);
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		   //$where->// array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$where = array(
		     array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		     array('condition' => $table.'.Year', 'value' => $this->pyear)
		
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelrecord/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'hostelrecord';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Record', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'hostelrecord/listview/'.$this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		
		
		$this->session->set_userdata('yearhr', $this->pyear);
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		//$tableArray = array();
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			
		);
		
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelrecord/list', $data);
	}
	
	function search_data(){
		$table = 'hostelrecord';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Record', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'hostelrecord/listview/'.$this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'HostelRecordId';
		
		
		$this->session->set_userdata('yearhr', $this->pyear);
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		//$tableArray = array();
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('hostelrecord/list', $data);
	}
	
	 function view()
	{
		$table = 'hostelrecord';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.HostelRecordId', 'value' => $id)
		);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId')
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$where = array();
		$this->load->view('hostelrecord/view', $data);
		$this->load->view('footer');
	}
	
	function records($url)
	{
		$this->pageinfo['event'] ='Show Records';
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'hostelrecord';
		$tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId')
		);
		 $data['rollno']= $this->Adminmodel->fetch_row($table, $tableArray, $where=array());
	        //$id = $this->input->post('RollNo');
			//$year = $this->input->post('Year');
			
		if($url === 'view'){
		
			$this->load->view('header', $this->pageinfo);
			$this->load->view('menu');
			$this->load->view('hostelrecord/records',$data);
			$this->load->view('footer');
			
		}else if($url === 'show'){
		
			/* $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		      foreach($yearno as $yno){
			      if($yno->AcademicYear != NULL){
				       $year = $yno->AcademicYear;
			        }
				}*/
				
			$year =$_POST['Year'];
			$StudentId = $_POST['StudentId'];
			$table = 'hostelregister';
			
		
			$where = array(
				//array('condition' => $table.'.StudentId', 'value' => $id),
				array('condition' => $table.'.Year', 'value' => $year),
				array('condition' => $table.'.StudentId', 'value' => $StudentId),
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			);
			
			$tjoin = array(
				array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId'),
				array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId'),
				array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId'),
				array('TableName' => 'section' , 'Condition' => 'studentclass.SectionId=section.SectionId')
			);
			$data['records'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
			//print_r($data);exit;
			
			$table = 'hostelrecord';
			
			$where = array(
				array('condition' => $table.'.Year', 'value' => $year),
				array('condition' => $table.'.StudentId', 'value' => $StudentId),
				array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
			$tjoin = array(
				array('TableName' => 'hostelregister' , 'Condition' => $table.'.StudentId=hostelregister.StudentId' ),
				array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId'),
			);
			$data['result'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
			//print_r($data);exit;
			
			$this->load->view('hostelrecord/report', $data);
		}	
	}
	
	function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'academicyear';
		$data['years'] = $this->Adminmodel->show_rows($table, $where=array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('hostelrecord/addnew', $data);
		$this->load->view('footer');
	}
	
	function hostelterm(){
		$table = 'hostelrecord';
		$id = $this->input->post('StudentId');
		$fields = array('HostelTermNo');
		$where = array(
			array('condition' => $table.'.StudentId', 'value' => $id),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$termnoarray = $this->Adminmodel->maxvalue($table, $fields, $where);		
		foreach($termnoarray as $tr){
			if($tr->HostelTermNo != NULL){
				echo $tr->HostelTermNo;
			}else{
				echo '0';
			}
		}	
		
	}
	
	function studentlist(){
	
		$table = 'studentclass';
		$id = $this->input->post('Class');
		$where = array(
			array('condition' => $table.'.StudentClass', 'value' => $id),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$tjoin = array(
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId' ),
		);
		$data['studenclass'] = $this->Adminmodel->fetch_row_where($where,$table,$tjoin);
		//echo $studenclass;exit;
	    echo "<option value = 'x'>- - Select RollNo - -</option>";
		//$str2 = '';
		foreach($data['studenclass'] as $rd){
            echo '<option value = "'.$rd->StudentId.'">'. $rd->StudentRollNo.'-'.$rd->StudentName.'</option>';			
			//$str2 = $str2.'<option value = "'.$rd->StudentName.'">'. $rd->StudentName.'</option>';
			}
		
	}
	
	/*function hostelstudentlist(){
	
		$table = 'hostelregister';
		$id = $this->input->post('Class');
		$year = $this->input->post('Year');
		$where = array(
			array('condition' => 'studentclass.StudentClass', 'value' => $id),
			//array('condition' => 'studentclass.Year', 'value' => $year)
		);
		$tjoin = array(
			array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId' ),
			array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId' )
		);
		$studenclass = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		$str1 = "<option value = 'x'>- - Select RollNo - -</option>";
		$str2 = '';
		foreach($studenclass as $rd){
			$str2 = $str2.'<option value = "'.$rd->StudentId.'">'. $rd->StudentId . '</option>';
		}
		echo $str1 . $str2; 
	}*/
	
	function save()
	{	
	  
	  $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				 $year = $yno->AcademicYear;
			}
		}
		//echo 'hai1';exit;
	    $table = 'hostelrecord';
		$TermPaidDate = date("Y-m-d", strtotime($this->input->post('TermPaidDate')));
		$data = array(
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'StudentId' => $this->input->post('StudentId'),
		   'HostelTermNo' => $this->input->post('HostelTermNo'),
		   'HostelTermFee' => $this->input->post('HostelTermFee'),
		   'TermPaidDate' => $TermPaidDate,
		   'PaidBy' => $this->input->post('PaidBy'),
		   'Year' => $year,
		   'HostelTermDes' => $this->input->post('HostelTermDes')
       );
	  $where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentId', 'value' =>$this->input->post('StudentId')),
			//array('condition' => $table.'.ReceiptNo', 'value' =>$MaxreceiptNo+1),
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
	
        if(!isset($result) && $result <= 0){
		$this->form_validation->set_rules('StudentId', 'Student Id', 'required');
		$this->form_validation->set_rules('HostelTermNo', 'Hostel Term No', 'required');
		$this->form_validation->set_rules('TermPaidDate', 'Term Paid Date', 'required');
		$this->form_validation->set_rules('PaidBy', 'Paid By', 'required');
	
		//echo $status;
		if($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->save_data($data, $table);
	   		echo $status;
		}else{
			//$this->listview();
		}
		}else{
			echo 2;
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
		
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$table = 'hostelrecord';
		$where= array(
			array('condition' => $table.'.HostelRecordId', 'value' => $id),
			 array('condition' => $table.'.Year', 'value' => $year),
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$tjoin = array(
			array('TableName' => 'studentclass' , 'Condition' => $table.'.StudentId=studentclass.StudentId' ),
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId' ),
            array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId' )
		);
		$data['result'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
	    foreach($data['result'] as $cr){
			$class = $cr->StudentClass; 
		}
		$data['class'] = $class;
		$table = 'studentclass';
		//$class=$this->input->post('Class');
		$where= array(
			array('condition' => $table.'.StudentClass', 'value' => $class),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			//array('condition' => $table.'.Year', 'value' => $year)
		);
		$data['studentclass'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('hostelrecord/edit', $data);
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
		//echo 'hai1';exit;
		$table = 'hostelrecord';
		$field = 'HostelRecordId';
		$id = $this->input->post('HostelRecordId');
		$data = array(
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'StudentId' => $this->input->post('StudentId'),
		   'HostelTermNo' => $this->input->post('HostelTermNo'),
		   'HostelTermFee' => $this->input->post('HostelTermFee'),
		   'PaidBy' => $this->input->post('PaidBy'),
		   'Year' => $year,
		   'HostelTermDes' => $this->input->post('HostelTermDes')
       );
	     $where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentId', 'value' =>$this->input->post('StudentId')),
			array('condition' => $table.'.HostelTermNo', 'value' =>$this->input->post('HostelTermNo')),
			array('condition' => $table.'.HostelTermFee', 'value' =>$this->input->post('HostelTermFee')),
			array('condition' => $table.'.TermPaidDate', 'value' => date('Y-m-d')),
			array('condition' => $table.'.PaidBy', 'value' =>$this->input->post('PaidBy')),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.HostelTermDes', 'value' =>$this->input->post('HostelTermDes')),
			
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
	
        if(!isset($result) && $result <= 0){
		$this->form_validation->set_rules('StudentId', 'StudentId', 'required');
		$this->form_validation->set_rules('HostelTermNo', 'Hostel Term No', 'required');
		//$this->form_validation->set_rules('TermPaidDate', 'Term Paid Date', 'required');
		$this->form_validation->set_rules('PaidBy', 'Paid By', 'required');
	
		
		if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			echo $status;
		}else{
			//$this->listview();
		}
		}else{
			echo 2;
		}	
	}
	
	function export()
	{
		$table = 'hostelrecord';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = HostelRecords.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		$this->session->set_userdata('yearhr', $this->pyear);
		
		/*$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);*/
		
		//$result = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where );
		$result=$this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Roll No</th>";
		echo "<th align='center' >Hostel Term No</th>";
		echo "<th align='center' >Hostel Term Fee</th>";
		echo "<th align='center' >Term Paid Date</th>";
		echo "<th align='center' >Paid By</th>";
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
		echo "<td align='center'>" . $row->StudentId . "</td>";
		echo "<td align='center'>" . $row->HostelTermNo . "</td>";
		echo "<td align='center'>" . $row->HostelTermFee . "</td>";
		echo "<td align='center'>" . $row->TermPaidDate . "</td>";
		echo "<td align='center'>" . $row->PaidBy . "</td>";
		echo "<td align='center'>" . $row->HostelTermDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

