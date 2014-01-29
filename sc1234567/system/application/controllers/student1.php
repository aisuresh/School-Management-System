<?php
class Student extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Students');
		$this->input->post();
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
	}
	
	function listview()
	{
		
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'student/listview/' . $this->pyear;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearsh', $this->pyear);
		/*$sortby = 'StudentClassId';
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'course', 'CompairField' => $table.'.StudentClass=course.ClassId'),
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId=section.SectionId'),
			array('TableName' => 'castcategory', 'CompairField' => 'student.CastCategoryId=castcategory.CastCategoryId'),
			array('TableName' => 'nationality', 'CompairField' => 'student.NationalityId=nationality.NationalityId')
		);
		
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption, $searchstring, $sortby, $where);*/

		
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('student/list', $data);
		$this->load->view('footer');
	}
	function studentlist1()
	{
	    $config['base_url'] = base_url() . 'student/listview/' . $this->pyear;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
	    $table = 'studentclass';
	    $class=$this->input->post('ClassId');
		$section=$this->input->post('SectionId');
		$year =$this->input->post('Year');
	   
		$where = array(
		    array('condition' => $table.'.StudentClass', 'value' => $class),
			array('condition' => $table.'.SectionId', 'value' => $section),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		
		$tjoin = array(
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'course' , 'Condition' => 'studentclass.StudentClass=course.ClassId'),
			array('TableName' => 'section' , 'Condition' => 'studentclass.SectionId=section.SectionId')
		);
		$data['result'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		//$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('student/studentlist1', $data);
		
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Students', 'url' => $this->url,'event' => 'List view' );
		$config['base_url'] = base_url() . 'student/listview/'.$this->pyear;
		$table = 'studentclass';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = $this->input->post('sortkey');
		$order = $this->input->post('order');	
		$this->session->set_userdata('yearsh', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'course', 'CompairField' => $table.'.StudentClass=course.ClassId'),
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId=section.SectionId'),
			array('TableName' => 'castcategory', 'CompairField' => 'student.CastCategoryId=castcategory.CastCategoryId'),
			array('TableName' => 'nationality', 'CompairField' => 'student.NationalityId=nationality.NationalityId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('student/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Students', 'url' => $this->url, 'event' => 'List view' );
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring')!= NULL)
		{
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
			$config['base_url'] = base_url() . 'student/listview/'.$this->pyear;
			$table = 'studentclass';
			$config['total_rows'] = $this->Adminmodel->record_count($table, $searchoption, $searchstring);
			$config['per_page'] = 20;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);	
			$page = ($this->uri->segment(6))? $this->uri->segment(6) : 0;
			$sortby = 'StudentClassId';
			$this->session->set_userdata('yearsh', $this->pyear);
			$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.StudentId=student.StudentId'),
			array('TableName' => 'course', 'CompairField' => $table.'.StudentClass=course.ClassId'),
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId=section.SectionId'),
			array('TableName' => 'castcategory', 'CompairField' => 'student.CastCategoryId=castcategory.CastCategoryId'),
			array('TableName' => 'nationality', 'CompairField' => 'student.NationalityId=nationality.NationalityId')
		);
		
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption, $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
			$data['pages'] = $page;
			$this->load->view('student/list', $data);
		}
	}
	
	 function view()
	{
		$table = 'student';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.StudentId', 'value' => $id),
			//array('condition' => 'studentclass'.'.Year', 'value' => $year),
			//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array() , $where);
		$table = 'course';
		$data['class'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'section';
		$data['section'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'castcategory';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['castcategory'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'nationality';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['nationality'] = $this->Adminmodel->show_rows($table, $where);					
		$table = 'mothertongue';
		$where = array(
					//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['mothertongue'] = $this->Adminmodel->show_rows($table, $where);					
		
		$table = 'bloodgroup';
		$where = array(
					//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['bloodgroup'] = $this->Adminmodel->show_rows($table, $where);					
		$this->load->view('student/view', $data);
		$this->load->view('footer');
	}
	
	
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'course';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['class'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'section';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['sect'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'castcategory';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['castc'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'nationality';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);		
		$data['nationality'] = $this->Adminmodel->show_rows($table, $where );
		$table = 'mothertongue';
		$where = array(
					//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);		
		$data['mothertongue'] = $this->Adminmodel->show_rows($table, $where );
		$table = 'bloodgroup';
		$where = array(
					//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['bloodgroup'] = $this->Adminmodel->show_rows($table, $where);					
		$this->load->view('student/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{
	
	   $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}	
		$DateOfBirth = date("Y-m-d", strtotime($this->input->post('DateOfBirth')));
		$table = 'student';
		$data = array(
		       'InstituteId' =>  $this->session->userdata('InstituteId'),
			   //'StudentId'  =>  $this->input->post('StudentId'),
               'StudentRollNo' => $this->input->post('StudentRollNo'),
               'StudentName' => $this->input->post('StudentName'),
			   'FatherName' => $this->input->post('FatherName'),
			   'MotherName' => $this->input->post('MotherName'),
			   'FatherAccupation' => $this->input->post('FatherOccupation'),
			   'MotherAccupation' => $this->input->post('MotherOccupation'),
			   'DateOfBirth' => $DateOfBirth,
			   'Gender' => $this->input->post('Gender'),
			   'Town' => $this->input->post('Town'),
			   'Cast' => $this->input->post('Cast'),
			   'CastCategoryId' => $this->input->post('CastCategoryId'),
			   'NationalityId' => $this->input->post('NationalityId'),
			   'MotherTongueId' => $this->input->post('MotherTongueId'),
			   'PH' => $this->input->post('PH'),
			   'Address' => $this->input->post('Address'),
			   'PhoneNo' => $this->input->post('PhoneNo'),
			   'MobileNo' => $this->input->post('MobileNo'),
			   'Email' => $this->input->post('Email'),
			   'OnTC' => $this->input->post('OnTc'),
			   'BloodGroupId' => $this->input->post('BloodGroupId'),
			   'PhotoPath' => $this->input->post('imgpath')
          );
			
		  print_r($data);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('StudentRollNo', ' Student Roll No', 'required');
			$this->form_validation->set_rules('StudentName', 'Student Name', 'required');
			$this->form_validation->set_rules('FatherName', 'Father Name', 'required');
			$this->form_validation->set_rules('MotherName', 'Mother Name', 'required');
			$this->form_validation->set_rules('FatherOccupation', 'Father Occupation', 'required');
			$this->form_validation->set_rules('DateOfBirth', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('Gender', 'Gender', 'required');
			$this->form_validation->set_rules('StudentClass', 'Student Class', 'required');
			$this->form_validation->set_rules('Town', 'Town', 'required');
			$this->form_validation->set_rules('Cast', 'Cast', 'required');
			$this->form_validation->set_rules('CastCategoryId', 'Cast Category', 'required');
			$this->form_validation->set_rules('NationalityId', 'Nationality', 'required');
			$this->form_validation->set_rules('MotherTongueId', 'MotherTongueId', 'required');
			$this->form_validation->set_rules('PH', 'PH', 'required');
			$this->form_validation->set_rules('MobileNo', 'MobileNo', 'required');
			$this->form_validation->set_rules('Email', 'Email', 'required');
			$this->form_validation->set_rules('AdmissionFee', 'Admission Fee', 'required');
			$this->form_validation->set_rules('OnTc', 'On Tc', 'required');
			$this->form_validation->set_rules('BloodGroupId', 'BloodGroup', 'required');
			
			if ($this->form_validation->run() == true) {
				
					$status = $this->Adminmodel->save_data($data, $table);
			if($status){
				$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
				foreach($yearno as $yno){
					if($yno->AcademicYear != NULL){$year = $yno->AcademicYear;}
				}
				$table='student';
				$InstituteId= $this->session->userdata('InstituteId');
				$studentname= $this->input->post('StudentName');
				$dateofbirth = $this->input->post('DateOfBirth');
				$where = array(
			            array('condition' => $table.'.InstituteId', 'value' => $InstituteId),
						 array('condition' => $table.'.StudentName', 'value' => $studentname),
						  array('condition' => $table.'.DateOfBirth', 'value' => $dateofbirth)
			      );
				$newstudentid =  $this->Adminmodel->show_rows($table, $where);
				foreach($newstudentid as $sid){
					if($sid->StudentId != NULL){$StudentId = $sid->StudentId;}
				}
				$table = 'studentclass';
				$data = array(
				   'InstituteId' =>  $this->session->userdata('InstituteId'),
				   'StudentId' => $StudentId,
				   'RollNo' => $this->input->post('StudentRollNo'),
				   'StudentClass' => $this->input->post('StudentClass'),
				   'SectionId' => $this->input->post('SectionId'),
				   'Medium' => $this->input->post('Medium'),
				   'Year' => $year
				);
			/*$where = array(
			
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
					//array('condition' => $table.'.StudentId', 'value' => $StudentId),
					array('condition' => $table.'.StudentClass', 'value' => $this->input->post('StudentClass')),
					array('condition' => $table.'.SectionId', 'value' => $this->input->post('SectionId')),
					array('condition' => 'student'.'.StudentName', 'value' => $this->input->post('StudentName')),
					array('condition' => 'student'.'.FatherName', 'value' => $this->input->post('FatherName')),
					array('condition' => 'student'.'.DateOfBirth', 'value' => $this->input->post('DateOfBirth'))
			);
			$result = $this->Adminmodel->show_rows($table, $where);
			print_r($result);exit;*/
		
			//if(!isset($result) && $result <= 0){
			    $status = $this->Adminmodel->save_data($data, $table);
				echo($status);
				$table = 'classfees';
				$classfees = $this->Adminmodel->show_rows($table, $where = array());
				$yearfees = 0;
				foreach($classfees as $cf){$yearfees = $cf->ClassFees;}
				
				$table = 'schoolfees';
				$data = array(
				    'InstituteId' =>  $this->session->userdata('InstituteId'),
				   'StudentId' => $StudentId,
				   'Fees' => 0,
				   'ReceiptNo' => 0,
				   'TermNo' => 0,
				   'PaidDate' => '',
				   'Year' => $year,
				   'SchoolFeeDes' => $this->input->post('SchoolFeeDes')
				);
				$status = $this->Adminmodel->save_data($data, $table);
				$schoolfees = $yearfees * 10;
				$fees = array($this->input->post('AdmissionFee'), $this->input->post('BusFees'), $schoolfees);
				if($status == 1){
					$table = 'studentfees';
					for($i = 1; $i <= 3; $i++){
						$data = array(
						    'InstituteId' =>  $this->session->userdata('InstituteId'),
						   'StudentId' => $StudentId,
						   'FeesTypeId' => ($i),
						   'Fees' => $fees[($i-1)],
						   'Year' => $year
						);
						$status = $this->Adminmodel->save_data($data, $table);
						}	}	
			}
		
		} else{
			$this->listview();
		}
		//}else{
			//  echo 2;
		//}	
	}
	
	function edit()
	{
	   $yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		
		$id = $this->uri->segment(3);
		$table = 'student';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		
		$field = 'StudentId';
		
		$where = array(
		 	array('condition' => $table.'.'.$field, 'value' => $id),
			//array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))

		);
		$tjoin = array(
		 	array('TableName' => 'studentclass', 'Condition' => $table.'.StudentId = studentclass.StudentId'),
			//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		$table = 'course';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['class'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'section';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['sect'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'castcategory';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['castc'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'nationality';
		$where = array(
					array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['nationality'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'mothertongue';
		$where = array(
					//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['mothertongue'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'bloodgroup';
		$where = array(
					//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['bloodgroup'] = $this->Adminmodel->show_rows($table, $where);					
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('student/edit', $data);
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
		$table = 'student';
		$field = 'StudentId';
		$id = $this->input->post('StudentId');
		$DateOfBirth = date("Y-m-d", strtotime($this->input->post('DateOfBirth')));
		$data = array(
		       'InstituteId' =>  $this->session->userdata('InstituteId'),
			   'StudentRollNo' => $this->input->post('StudentRollNo'),
               'StudentName' => $this->input->post('StudentName'),
			   'FatherName' => $this->input->post('FatherName'),
			   'MotherName' => $this->input->post('MotherName'),
			   'FatherAccupation' => $this->input->post('FatherOccupation'),
			   'MotherAccupation' => $this->input->post('MotherOccupation'),
			   'DateOfBirth' => $DateOfBirth,
			   'Gender' => $this->input->post('Gender'),
			   'Town' => $this->input->post('Town'),
			   'Cast' => $this->input->post('Cast'),
			   'CastCategoryId' => $this->input->post('CastCategoryId'),
			   'NationalityId' => $this->input->post('NationalityId'),
			   'MotherTongueId' => $this->input->post('MotherTongueId'),
			   'Address' => $this->input->post('Address'),
			   'PhoneNo' => $this->input->post('PhoneNo'),
			   'MobileNo' => $this->input->post('MobileNo'),
			   'Email' => $this->input->post('Email'),
			   'OnTC' => $this->input->post('OnTc'),
			  // 'Year' => $year,
			   //'AdmissionFee' => $this->input->post('AdmissionFee')
			   
          );
		   $where = array(
			
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.StudentRollNo', 'value' => $this->input->post('StudentRollNo')),
			array('condition' => $table.'.StudentName', 'value' => $this->input->post('StudentName')),
			array('condition' => $table.'.FatherName', 'value' => $this->input->post('FatherName')),
			array('condition' => $table.'.MotherName', 'value' => $this->input->post('MotherName')),
			array('condition' => $table.'.FatherAccupation', 'value' => $this->input->post('FatherOccupation')),
			array('condition' => $table.'.MotherAccupation', 'value' => $this->input->post('MotherOccupation')),
			array('condition' => $table.'.DateOfBirth', 'value' => $this->input->post('DateOfBirth')),
			array('condition' => $table.'.Gender', 'value' => $this->input->post('Gender')),
			array('condition' => $table.'.Town', 'value' => $this->input->post('Town')),
			array('condition' => $table.'.Cast', 'value' => $this->input->post('Cast')),
			array('condition' => $table.'.CastCategoryId', 'value' => $this->input->post('CastCategoryId')),
			array('condition' => $table.'.NationalityId', 'value' => $this->input->post('NationalityId')),
			array('condition' => $table.'.MotherTongueId', 'value' => $this->input->post('MotherTongueId')),
			array('condition' => $table.'.Address', 'value' => $this->input->post('Address')),
			array('condition' => $table.'.PhoneNo', 'value' => $this->input->post('PhoneNo')),
			array('condition' => $table.'.MobileNo', 'value' => $this->input->post('MobileNo')),
			array('condition' => $table.'.Email', 'value' => $this->input->post('Email')),
			array('condition' => $table.'.OnTC', 'value' => $this->input->post('OnTc')),
			
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		//if(!isset($result) && $result <= 0){
			$this->form_validation->set_rules('StudentRollNo', ' Student Roll No', 'required');
			$this->form_validation->set_rules('StudentName', 'Student Name', 'required');
			$this->form_validation->set_rules('FatherName', 'Father Name', 'required');
			$this->form_validation->set_rules('MotherName', 'Mother Name', 'required');
			$this->form_validation->set_rules('FatherOccupation', 'Father Occupation', 'required');
			$this->form_validation->set_rules('DateOfBirth', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('Gender', 'Gender', 'required');
			$this->form_validation->set_rules('StudentClass', 'Student Class', 'required');
			$this->form_validation->set_rules('Town', 'Town', 'required');
			$this->form_validation->set_rules('Cast', 'Cast', 'required');
			$this->form_validation->set_rules('CastCategoryId', 'Cast Category Id', 'required');
			$this->form_validation->set_rules('NationalityId', 'Nationality Id', 'required');
			$this->form_validation->set_rules('MotherTongueId', 'MotherTongue', 'required');
			$this->form_validation->set_rules('MobileNo', 'MobileNo', 'required');
			//$this->form_validation->set_rules('AdmissionFee', 'Admission Fee', 'required');
			$this->form_validation->set_rules('OnTc', 'On Tc', 'required');
						
			if ($this->form_validation->run() == true)
			{
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
				
				$table = 'studentclass';
				$field = 'StudentClassId';
		        $id = $this->input->post('StudentClassId');
				$data = array(
				   'InstituteId' =>  $this->session->userdata('InstituteId'),
				   'StudentId' => $this->input->post('StudentId'),
				   'RollNo'  => $this->input->post('StudentRollNo'),
				   'StudentClass' => $this->input->post('StudentClass'),
				   'SectionId' => $this->input->post('SectionId'),
				   'Medium' => $this->input->post('Medium'),
				   'Year' => $year,
				);
				 //print_r($data);exit;
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			    echo $status;
			}else{
				$this->listview();
			}
		//}else{
		//	echo 2;
		//}	
	}
	  // print_r($data);exit;
		/*$this->form_validation->set_rules('StudentRollNo', ' Student Roll No', 'required');
		$this->form_validation->set_rules('StudentName', 'Student Name', 'required');
		$this->form_validation->set_rules('FatherName', 'Father Name', 'required');
		$this->form_validation->set_rules('MotherName', 'Mother Name', 'required');
		$this->form_validation->set_rules('FatherOccupation', 'Father Occupation', 'required');
		$this->form_validation->set_rules('DateOfBirth', 'Date Of Birth', 'required');
		$this->form_validation->set_rules('Gender', 'Gender', 'required');
		$this->form_validation->set_rules('StudentClass', 'Student Class', 'required');
		$this->form_validation->set_rules('Town', 'Town', 'required');
		$this->form_validation->set_rules('Cast', 'Cast', 'required');
		$this->form_validation->set_rules('CastCategoryId', 'Cast Category Id', 'required');
		$this->form_validation->set_rules('NationalityId', 'Nationality Id', 'required');
		//$this->form_validation->set_rules('PH', 'PH', 'required');
		$this->form_validation->set_rules('MobileNo', 'MobileNo', 'required');
		//$this->form_validation->set_rules('AdmissionFee', 'Admission Fee', 'required');
		$this->form_validation->set_rules('OnTc', 'On Tc', 'required');
		
		if ($this->form_validation->run() == true) {
		
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
	         
			/* if($status){
				$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
				foreach($yearno as $yno){
					if($yno->AcademicYear != NULL){
						$year = $yno->AcademicYear;
					}
				}*/
			/*	$table = 'studentclass';
				$field = 'StudentClassId';
		        $id = $this->input->post('StudentClassId');
				$data = array(
				   'InstituteId' =>  $this->session->userdata('InstituteId'),
				   'StudentId' => $this->input->post('StudentId'),
				   'RollNo'  => $this->input->post('StudentRollNo'),
				   'StudentClass' => $this->input->post('StudentClass'),
				   'SectionId' => $this->input->post('SectionId'),
				   'Medium' => $this->input->post('Medium'),
				   'Year' => $year,
				);
				 //print_r($data);exit;
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			    echo $status;
				}
		 else{
			$this->listview();
		}
		
	}*/
	
	function section(){
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'sectionclass';
		$fielda = 'ClassId';
		$row = $this->input->post('ClassId');
		$where = array(
		 	array('condition' => $table.'.'.$fielda, 'value' => $row),
			array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$tjoin = array(
		 	array('TableName' => 'section', 'Condition' => $table.'.SectionId = section.SectionId')
		);
		$section = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		
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
		
	}
	
	function assignlist(){
		
		$table = 'studentclass';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'student/assignlist/'. $this->pyear;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption ='';
		$searchstring = '';
		if(isset($_POST['searchoption']) && isset($_POST['searchstring'])){
			$searchoption = $_POST['searchoption'];
			$searchstring = $_POST['searchstring'];
		}
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'StudentClassId';
		$this->session->set_userdata('yearas', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student' , 'CompairField' => $table.'.StudentId=student.StudentId' ),
		    array('TableName' => 'course' , 'CompairField' => $table.'.StudentClass=course.ClassId' ),
			array('TableName' => 'section' , 'CompairField' =>  $table.'.SectionId=section.SectionId' )
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);

		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('student/assignlist', $data);
		$this->load->view('footer');
		
	}
	
	function assignlist_sort(){
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Students', 'url' => $this->url,'event' => 'Class List view' );
		$table = 'studentclass';
		$this->pageinfo['event'] = 'List view';
		//$this->load->view('header', $this->pageinfo);
		//$this->load->view('menu');
		$config['base_url'] = base_url() . 'student/assignlist/'. $this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$searchoption ='';
		$searchstring = '';
		if(isset($_POST['searchoption']) && isset($_POST['searchstring'])){
			$searchoption = $_POST['searchoption'];
			$searchstring = $_POST['searchstring'];
		}
		$this->pagination->initialize($config);
		$sort = $this->input->post('sortkey');
		$order = $this->input->post('order');	
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$this->session->set_userdata('yearas', $this->pyear);
		$tableArray = array(
			array('TableName' => 'student' , 'CompairField' => $table.'.StudentId=student.StudentRollNo' ),
			array('TableName' => 'course' , 'CompairField' => $table.'.StudentClass=course.ClassId' ),
			array('TableName' => 'section' , 'CompairField' => 'student.SectionId=section.SectionId' )
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		//$this->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $this->sortby, $this->where);
		
		$this->data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('student/assignlist', $data);
		//$this->load->view('footer');
		
	}
	
	function assign_search_data(){
		$data = array( 'project' => 'SCHOOL', 'pagetitle' => 'Students', 'url' => $this->url, 'event' => 'List view' );
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring')!= NULL)
		{
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
			$config['base_url'] = base_url() . 'student/assignlist/'.$this->pyear;
			$table = 'studentclass';
			$config['total_rows'] = $this->Adminmodel->record_count($table, $searchoption , $searchstring);
			$config['per_page'] = 20;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);	
			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
			$sortby = 'StudentId';
			$this->session->set_userdata('yearsh', $this->pyear);
			$tableArray = array(
			array('TableName' => 'student' , 'CompairField' => $table.'.RollNo=student.StudentRollNo' ),
			array('TableName' => 'course' , 'CompairField' => $table.'.StudentClass=course.ClassId' ),
			array('TableName' => 'section' , 'CompairField' => 'student.SectionId=section.SectionId' )
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
			$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
			$data['links'] = $this->pagination->create_links();
			$data['pages'] = $this->page;
			$this->load->view('student/assignlist', $data);
		}
	}	
	
	function newassign(){
	
		$this->pageinfo['event'] ='Assign New';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'course';
		$data['course'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'castcategory';

		$data['castc'] = $this->Adminmodel->show_rows($table, $where = array());
		$table = 'nationality';
		$data['nationality'] = $this->Adminmodel->show_rows($table, $where = array());
		$this->load->view('student/newassign', $data);
		$this->load->view('footer');
	}
	
	function studentlist(){
	
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'studentclass';
		$class = $this->input->post('ClassId');
		$section = $this->input->post('SectionId');
		$where = array(
			array('condition' => $table.'.StudentClass', 'value' => $class),
			array('condition' => $table.'.SectionId', 'value' => $section),
			array('condition' => $table.'.Year', 'value' => $year)
		);
		/*$data['studentlist'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('student/studentlist', $data);*/
		
		$tjoin = array(
			array('TableName' => 'student' , 'Condition' => $table.'.StudentId=student.StudentRollNo' ),
			array('TableName' => 'section' , 'Condition' => $table.'.SectionId=section.SectionId' )
		);
		
		$studenclass = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		$str1 = '';
		foreach($studenclass as $rd){
			$str1 = $str1.'<option value = "'.$rd->StudentRollNo.'">'. $rd->StudentRollNo.'. '.$rd->StudentName . '</option>';
		}
		 echo $str1;
	}
	
	function assignsave(){
		
		$table = 'academicyear';
		$academicyear = $this->Adminmodel->show_rows($table, $where = array());
		$ayear = array();
		foreach($academicyear as $ar){
			$ayear[] = $ar->AcademicYear;
		}
		$num = count($academicyear)-1;	
		$rolls = explode(',', $this->input->post('RollNo'));
		
		for($i = 0; $i < count($rolls); $i++){
			$table = 'studentfees';
			$where = array(
				array('condition' => $table.'.RollNo', 'value' => $rolls[$i]),
				array('condition' => $table.'.Year', 'value' => $ayear[$num])
			);
			$studentfees = $this->Adminmodel->show_rows($table, $where);
			$StdTfees = 0;
			foreach($studentfees as $sf){
				$StdTfees += $sf->Fees;
			}
			$table = 'schoolfees';
			$where = array(
				array('condition' => $table.'.RollNo', 'value' => $rolls[$i]),
				array('condition' => $table.'.Year', 'value' => $ayear[$num])
			);
			$studentfees = $this->Adminmodel->show_rows($table, $where);
			$StdPTfees = 0;
			foreach($studentfees as $sf){
				$StdPTfees += $sf->Fees;
			}
			
			$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
			foreach($yearno as $yno){
				if($yno->AcademicYear != NULL){
					$year = $yno->AcademicYear;
				}
			}
			$table = 'studentclass';
			$data = array(
			   'RollNo' => $rolls[$i],
			   'StudentClass' => $this->input->post('Class'),
			   'SectionId' => $this->input->post('SectionId'),
			   'Year' => $year
			);
			
			$status = $this->Adminmodel->save_data($data, $table);
		}
		if($status){
			$table = 'studentfees';
			$data = array(
			   'RollNo' => $rolls[$i],
			   'FeesTypeId' => 4,
   			   'Fees' => ($StdTfees - $StdPTfees),
			   'Year' => $year,
			);
			$status = $this->Adminmodel->save_data($data, $table);
			
			$table = 'schoolfees';
			$data = array(
			   'RollNo' => $rolls[$i],
			   'Fees' => 0,
			   'ReceptNo' => 0,
			   'TermNo' => 0,
			   'PaidDate' => '',
			   'Year' => $year,
			   'SchoolFeeDes' => $this->input->post('SchoolFeeDes')
			);
			$status = $this->Adminmodel->save_data($data, $table);
			echo true;
		}else{
			echo 'error';
		}	
	}
	
	function upload(){
		$this->pageinfo['event'] ='Upload Student List';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('student/upload');
		$this->load->view('footer');
	}
	
	function uploadstudentinfo(){
		$filename = basename($_FILES['uploadfile']['name']); 
		$time = time();
		if(!file_exists('./xls/'.$this->session->userdata('rollid'))){
			mkdir('./xls/'.$this->session->userdata('rollid'),0777); 
		}
		$uploaddir = './xls/'.$this->session->userdata('rollid').'/';
		$file = $uploaddir.$time.'_'.$filename; //=========add time stamp with image file name=========================
		$file_name = $time.'_'.$filename;
		if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
			$file_name = $time.'_'. $filename;
			$file_path = $uploaddir. $file_name;
		}		
		//echo($file_path);
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('UTF-8');
		$data->read($file_path);
		if($data->sheets[0]['numCols'] != 18){
			echo 'invalid'; 
			exit;
		}	
		$table = 'student';
		$info = array('StudentRollNo','StudentName', 'FatherName', 'MotherName', 'FatherAccupation', 'MotherAccupation', 'DateOfBirth', 'Gender', 'Town', 'Cast', 'CastCategoryId', 'NationalityId','MotherTongueId', 'PH', 'Address', 'PhoneNo', 'MobileNo', 'Email', 'OnTC','BloodGroup');
		error_reporting(E_ALL ^ E_NOTICE);
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
				if($data->sheets[0]['cells'][$i][$j] == 'Male'){
					$datainfo[$info[$j-1]] = 'm';
				}else if($data->sheets[0]['cells'][$i][$j] == 'Female'){
					$datainfo[$info[$j-1]] = 'f';
				}else if($data->sheets[0]['cells'][$i][$j] == 'OC'){
					$datainfo[$info[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'BC-A'){
					$datainfo[$info[$j-1]] = 2;
				}else if($data->sheets[0]['cells'][$i][$j] == 'BC-B'){
					$datainfo[$info[$j-1]] = 3;
				}else if($data->sheets[0]['cells'][$i][$j] == 'BC-C'){
					$datainfo[$info[$j-1]] = 4;
				}else if($data->sheets[0]['cells'][$i][$j] == 'BC-D'){
					$datainfo[$info[$j-1]] = 5;
				}else if($data->sheets[0]['cells'][$i][$j] == 'ST'){
					$datainfo[$info[$j-1]] = 6;
				}else if($data->sheets[0]['cells'][$i][$j] == 'SC'){
					$datainfo[$info[$j-1]] = 7;
				}else if($data->sheets[0]['cells'][$i][$j] == 'Indian Hindu'){
					$datainfo[$info[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'Indian Muslim'){
					$datainfo[$info[$j-1]] = 2;
				}else if($data->sheets[0]['cells'][$i][$j] == 'Indian Christians'){
					$datainfo[$info[$j-1]] = 3;
				}else if($data->sheets[0]['cells'][$i][$j] == 'YesPH'){
					$datainfo[$info[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'NoPH'){
					$datainfo[$info[$j-1]] = 2;
				}else if($data->sheets[0]['cells'][$i][$j] == 'Yes'){
					$datainfo[$info[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'No'){
					$datainfo[$info[$j-1]] = 2;
				}else if($j == 7){
					$datearray = explode('/',$data->sheets[0]['cells'][$i][$j]);
					$Bdate = $datearray[2].'-'.$datearray[1].'-'.$datearray[0];
					$datainfo[$info[$j-1]] = $Bdate;
				}else{
					$datainfo[$info[$j-1]] = $data->sheets[0]['cells'][$i][$j];
				}
				
			}
			$status = $this->Adminmodel->save_data($datainfo, $table);
		}
		if($status){
			echo $filename;
		}else{
			echo 'error';
		}	
	}
	
	function uploadstudentclass(){
		$filename = basename($_FILES['uploadfile']['name']); 
		$time = time();
		if(!file_exists('./xls/'.$this->session->userdata('rollid'))){
			mkdir('./xls/'.$this->session->userdata('rollid'),0777); 
		}
		$uploaddir = './xls/'.$this->session->userdata('rollid').'/';
		$file = $uploaddir.$time.'_'.$filename; //=========add time stamp with image file name=========================
		$file_name = $time.'_'.$filename;
		if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
			$file_name = $time.'_'. $filename;
			$file_path = $uploaddir. $file_name;
		}	
		
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('UTF-8');
		$data->read($file_path);
	    if($data->sheets[0]['numCols'] != 18){
			echo 'invalid'; 
			exit;
		}	
		
		$table = 'studentclass';
		$class = array('StudentId','Medium', 'StudentClass', 'SectionId','Year');
		//print_r($class);
		error_reporting(E_ALL ^ E_NOTICE);
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
				if($data->sheets[0]['cells'][$i][$j] == 'Telugu'){
					$datainfo[$class[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'English'){
					$datainfo[$class[$j-1]] = 2;
				}else if($data->sheets[0]['cells'][$i][$j] == 'Nursery'){
					$datainfo[$class[$j-1]] = 1;	
				}else if($data->sheets[0]['cells'][$i][$j] == 'LKG'){
					$datainfo[$class[$j-1]] = 2;
				}else if($data->sheets[0]['cells'][$i][$j] == 'UKG'){
					$datainfo[$class[$j-1]] = 3;
				}else if($data->sheets[0]['cells'][$i][$j] == 'I'){
					$datainfo[$class[$j-1]] = 4;
				}else if($data->sheets[0]['cells'][$i][$j] == 'II'){
					$datainfo[$class[$j-1]] = 5;
				}else if($data->sheets[0]['cells'][$i][$j] == 'III'){
					$datainfo[$class[$j-1]] = 6;
				}else if($data->sheets[0]['cells'][$i][$j] == 'IV'){
					$datainfo[$class[$j-1]] = 7;
				}else if($data->sheets[0]['cells'][$i][$j] == 'V'){
					$datainfo[$class[$j-1]] = 8;
				}else if($data->sheets[0]['cells'][$i][$j] == 'VI'){
					$datainfo[$class[$j-1]] = 9;
				}else if($data->sheets[0]['cells'][$i][$j] == 'VII'){
					$datainfo[$class[$j-1]] = 10;
				}else if($data->sheets[0]['cells'][$i][$j] == 'VIII'){
					$datainfo[$class[$j-1]] = 11;
				}else if($data->sheets[0]['cells'][$i][$j] == 'IX'){
					$datainfo[$class[$j-1]] = 12;
				}else if($data->sheets[0]['cells'][$i][$j] == 'X'){
					$datainfo[$class[$j-1]] = 13;
				}else if($data->sheets[0]['cells'][$i][$j] == 'A'){
					$datainfo[$class[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'B'){
					$datainfo[$class[$j-1]] = 2;
				}else if($data->sheets[0]['cells'][$i][$j] == 'C'){
					$datainfo[$class[$j-1]] = 3;
		        }else{
					$datainfo[$class[$j-1]] = $data->sheets[0]['cells'][$i][$j];
				}	
			}
			//print_r($datainfo);
			$status = $this->Adminmodel->save_data($datainfo, $table);
		}
		//echo($status);exit;
		if($status){
			echo $filename;
		}else{
			echo 'error';
		}	
	}
	
	function uploadstudentfees(){
		$filename = basename($_FILES['uploadfile']['name']); 
		$time = time();
		if(!file_exists('./xls/'.$this->session->userdata('schoolid'))){
			mkdir('./xls/'.$this->session->userdata('schoolid'),0777); 
		}
		$uploaddir = './xls/'.$this->session->userdata('schoolid').'/';
		$file = $uploaddir.$time.'_'.$filename; //=========add time stamp with image file name=========================
		$file_name = $time.'_'.$filename;
		if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
			$file_name = $time.'_'. $filename;
			$file_path = $uploaddir. $file_name;
		}	
		
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('UTF-8');
		$data->read($file_path);
		//echo($data->sheets[0]['numCols']);
		if($data->sheets[0]['numCols'] != 18){
			echo 'invalid'; 
			exit;
		}	
		$table = 'studentfees';
		$fees = array('StudentId', 'FeesTypeId', 'Fees', 'Year');
		error_reporting(E_ALL ^ E_NOTICE);
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
				if($data->sheets[0]['cells'][$i][$j] == 'Admission Fees'){
					$datainfo[$fees[$j-1]] = 1;
				}else if($data->sheets[0]['cells'][$i][$j] == 'Bus Fees'){
					$datainfo[$fees[$j-1]] = 2;
				}else{
					$datainfo[$fees[$j-1]] = $data->sheets[0]['cells'][$i][$j];
				}	
			}
			$status = $this->Adminmodel->save_data($datainfo, $table);
		}
		if($status){
			echo $filename;
		}else{
			echo 'error';
		}	
	}

	
	function export()
	{
		$table = 'studentclass';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Students.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		$tableArray = array(
			array('TableName' => 'student', 'CompairField' => $table.'.RollNo=student.StudentRollNo'),
			array('TableName' => 'course', 'CompairField' => $table.'.StudentClass=course.ClassId'),
			array('TableName' => 'section', 'CompairField' => $table.'.SectionId=section.SectionId'),
			array('TableName' => 'castcategory', 'CompairField' => 'student.CastCategoryId=castcategory.CastCategoryId'),
			array('TableName' => 'nationality', 'CompairField' => 'student.NationalityId=nationality.NationalityId'),
			array('TableName' => 'mothertongue', 'CompairField' => 'student.MotherTongueId=mothertongue.MotherTongueId'),
			array('TableName' => 'bloodgroup', 'CompairField' => 'student.BloodGroupId=bloodgroup.BloodGroupId')
		);
		$where = array(
			array('condition' => $table.'.Year', 'value' => $this->session->userdata('yearsh'))
		);
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
echo "<th align='center' >Roll No</th>";
echo "<th align='center' >Student Name</th>";
echo "<th align='center' >Father Name</th>";
echo "<th align='center' >Mother Name</th>";
echo "<th align='center' >Father Occupation</th>";
echo "<th align='center' >Mother Occupation</th>";
echo "<th align='center' >Date of Birth</th>";
echo "<th align='center' >Gender</th>";
echo "<th align='center' >Village / Town</th>";
echo "<th align='center' >Cast</th>";
echo "<th align='center' >Cast Category</th>";
echo "<th align='center' >Nationality</th>";
echo "<th align='center' >MotherTongue</th>";
echo "<th align='center' >PH</th>";
echo "<th align='center' >Address</th>";
echo "<th align='center' >Phone No</th>";
echo "<th align='center' >Mobile No</th>";
echo "<th align='center' >Email</th>";
echo "<th align='center' >On TC</th>";
echo "<th align='center' >BloodGroup</th>";
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
		echo "<td align='center'>" . $row->StudentRollNo . "</td>";
		echo "<td align='center'>" . $row->StudentName . "</td>";
		echo "<td align='center'>" . $row->FatherName . "</td>";
		echo "<td align='center'>" . $row->MotherName . "</td>";
		echo "<td align='center'>" . $row->FatherAccupation . "</td>";
		echo "<td align='center'>" . $row->MotherAccupation . "</td>";
		echo "<td align='center'>" . $row->DateOfBirth . "</td>";
		echo "<td align='center'>" . $row->Gender . "</td>";
		echo "<td align='center'>" . $row->Town . "</td>";
		echo "<td align='center'>" . $row->Cast . "</td>";
		echo "<td align='center'>" . $row->CastCategory. "</td>";
		echo "<td align='center'>" . $row->Nationality."</td>";
		echo "<td align='center'>" . $row->MotherTongue."</td>";
		echo "<td align='center'>" . $row->PH . "</td>";
		echo "<td align='center'>" . $row->Address . "</td>";
		echo "<td align='center'>" . $row->PhoneNo . "</td>";
		echo "<td align='center'>" . $row->MobileNo . "</td>";
		echo "<td align='center'>" . $row->Email . "</td>";
		echo "<td align='center'>" . $row->BloodGroupType . "</td>";
		echo "<td align='center'>";
			if($row->OnTC == 'Y'){
				echo 'Yes';
			}else{
				echo 'No';
			}
		
		echo "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}
	
	function photoupload(){
		
		$filename = basename($_FILES['uploadfile']['name']); 
		$time = time();
		$uploaddir = './images/photos/big/';
		$file = $uploaddir.$time.'_'.$filename; //=========add time stamp with image file name=========================
		$file_name = $time.'_'.$filename;
		if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
			$file_name = $time.'_'. $filename;
			$file_path = $uploaddir. $file_name;
			$src = $file_path;
			$desired_width = 180;
			$dest = './images/photos/thumb/';
			$fm = $this->Adminmodel->createThumbs($uploaddir, $file_name, $dest, $desired_width);
			echo $fm,$filename;
		}		
	}

	
	function print_data()
	{
		$table = 'studentclass';
		$result = $this->Adminmodel->export_records($table);
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
		echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
		echo "<head>";
		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
		echo "<title>Break Bulk</title>";
		echo "</head>";
		echo "<body onload='print();'>";
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0' onload='load_print();'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>
		<th>Country Code</th>  
		<th>Country Name</th> 
		<th>Currency Name</th> 
		<th>Currency Code</th> 
		<th>Rate Column Indicator</th> 
		<th>Restriction Indicator</th> 
		<th>GSP</th> 
		<th>GSP Start Date</th> 
		<th>GSP End Date</th> 
		<th>Drawback Eligibility</th> 
		<th>Schedule CCntry Code</th> 
		<th>AGOACBTPA</th> 
		<th>AGOALDD</th>";
		echo "</tr>";
		$i= 0;
		foreach($result as $row):
		if($i % 2){
			$master_tr_bgcolor = 'background-color:#f8fcfc; border-right:1px solid #a4a9a8; padding-left:5px;';
		}else{
			$master_tr_bgcolor = 'background-color:#e4ebec; border-right:1px solid #a4a9a8; padding-left:5px;';
		}
		
		echo "<tr style='" . $master_tr_bgcolor . "'>";
		echo "<td style='padding:5px; text-align:center; ' >" . $i ++ . "</td>  
		<td>" . $row->CountryCode . "</td>  
		<td>" . $row->CountryName . " </td> 
		<td>" . $row->CurrencyName . "</td> 
		<td>" . $row->CurrencyCode . "</td> 
		<td>" . $row->RateColumnIndicator . "</td> 
		<td>" . $row->RestrictionIndicator . "</td> 
		<td>" . $row->GSP . "</td> 
		<td>" . $row->GSPStartDate . "</td> 
		<td>" . $row->GSPEndDate . "</td> 
		<td>" . $row->DrawbackEligibility . "</td> 
		<td>" . $row->ScheduleCCntryCode . "</td> 
		<td>" . $row->AGOACBTPA . "</td> 
		<td>" . $row->AGOALDD . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		echo "</body>";
		echo "</html>";
		echo "<script>";
		echo "function load_print(){";
		echo "window.print();";
		echo "}";
		echo "</script>";
	}
	
	
}

/* End of file student.php */
/* Location: ./system/application/controllers/student.php */

