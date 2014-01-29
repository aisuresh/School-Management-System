<?php
class Classsubject extends Controller 
{

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
		$this->load->library('table');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
		$this->load->library('pagination');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Class Subject');
		$this->input->post();
	}
	
	function listview()
	{
		$table = 'classsubject';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		
		$config['base_url'] = base_url() . 'classsubject/listview';
		
		$config['uri_segment'] = 3;
		
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption')!= NULL && $this->input->post('searchstring')!= NULL){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'ClassSubjectId';
		
		$tableArray = array(
		    array('TableName' => 'course', 'CompairField' => $table.'.ClassId=course.ClassId'),
			array('TableName' => 'subject', 'CompairField' => $table.'.SubjectId=subject.SubjectId')
		);
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$data['result'] = $this->Adminmodel->fetch_records(9999, $page, $table, $tableArray, $searchoption , $searchstring,        $sortby, $where);
		
		$table = 'course';
		$where = array(   			
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$tableArray = array(
			array('TableName' => 'classsubject', 'CompairField' => $table.'.ClassId=classsubject.ClassId'),
		);
		$groupby = 'course.ClassId, course.ClassName';
		$data['course'] = $this->Adminmodel->fetch_distinct_row($table, $tableArray, $where, $groupby);
		
		//$data['pages'] = $page;
		$this->load->view('classsubject/list', $data);
		$this->load->view('footer');
	}
	
	function view()
	{
		$this->pageinfo['event'] = 'View';
		
		$table = 'course';
		$where = array(			
			array('condition' => $table.'.ClassId', 'value' => $this->uri->segment(3)),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
	  	$table = 'classsubject';		
		$where = array(
			array('condition' => $table.'.ClassId', 'value' => $this->uri->segment(3)),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$data['result'] = $this->Adminmodel->show_rows($table, $where);
	  	
		$this->load->view('header', $this->pageinfo);
      	$this->load->view('menu');
	  	$this->load->view('classsubject/view', $data);
      	$this->load->view('footer');
	
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		
		$table = 'course';
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('classsubject/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
		$table = 'classsubject';		
		$Subjects = $this->input->post('Subject');
		$Class = $this->input->post('Class');
		$subjectarry = explode(',', $Subjects);
		var_dump($subjectarry);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Subject', 'Subject Name', 'required');
		$this->form_validation->set_rules('Class', 'Class Name', 'required');
		
		if($this->form_validation->run() == true)
		{
			$table = 'classsubject';
			$where = array(
	 			array('condition' => $table.'.ClassId', 'value' => $Class)
	 		);
			
			$classsubject = $this->Adminmodel->show_rows($table, $where);

			// if subjects already mapped for class, delete them from table. 
			if(count($classsubject) > 0)
			{
			    $id = $Class;
				$where = array(
					array('condition' => $table.'.ClassId', 'value' => $id)
				);
				
				$status = $this->Adminmodel->delete_one_row($table, $where);
			}
			
			// Now insert the subjects selected for class.			
			foreach($subjectarry  as $sub)
			{
				$table='classsubject';
				$data = array(
				   'ClassId' => $Class,
				   'SubjectId' => $sub,
				   'InstituteId' => $this->session->userdata('InstituteId')
				);
				
				$status = $this->Adminmodel->save_data($data, $table);
			}			
			echo $status;			
		}else{
			$this->listview();
		}
	}
	
	function edit()
	{
	    $this->pageinfo['event'] = 'Edit';
	    
		$table = 'course';
		$where = array(			
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['course'] = $this->Adminmodel->show_rows($table, $where);
		
	  	$table = 'classsubject';
		$field = 'ClassId';
		$id = $this->uri->segment(3);
	  	
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		
	  	$this->load->view('header', $this->pageinfo);
      	$this->load->view('menu');
	  	$this->load->view('classsubject/edit', $data);
      	$this->load->view('footer');
    }	
	
	function getAvailableSubjects(){
	
		$table = 'subject';
		$where = array(			
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['subject'] = $this->Adminmodel->show_rows($table, $where);
			
		$table = 'classsubject';
		$Class = $this->input->post('Class');
		$where = array(
			 array('condition' => $table.'.ClassId', 'value' => $Class),
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId'),
			array('TableName' => 'subject', 'CompairField' => $table.'.SubjectId = subject.SubjectId'),
		);
		
		$data['classsubject'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		
		//compare list of subjects and classsubject table data. This ensures that already added subjects will not
		//present in the left side(available subjects list) for a particular Class in an institue.
		foreach($data['subject'] as $sub){
		  $subjectAddedAlready = false;

  		  foreach($data['classsubject'] as $cs){
		    if($sub->SubjectId == $cs->SubjectId){
    			$subjectAddedAlready = true;
			}
		  }	
		 // print_r($subjectAddedAlready);
		  if(!$subjectAddedAlready){
  		   echo '<option value = "'.$sub->SubjectId.'"' . 'selected="selected">' .$sub->SubjectName. '</option>';
		  }
		}
	}
	
	function getSelectedSubjects(){
		$table = 'classsubject';
		$Class = $this->input->post('Class');
		$where = array(
			 array('condition' => $table.'.ClassId', 'value' => $Class),
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId'),
			array('TableName' => 'subject', 'CompairField' => $table.'.SubjectId = subject.SubjectId'),
		);		
		
		$data['classsubject'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
				
		foreach($data['classsubject'] as $cb){
   			echo '<option value = "'.$cb->SubjectId.'"' . 'selected="selected">' .$cb->SubjectName. '</option>';
		}		
	}
		
	function update()
	{	
		$table = 'classsubject';		
		$Subjects = $this->input->post('Subject');
		$Class = $this->input->post('Class');
		
		$subjectarry = explode(',', $Subjects);
		var_dump($subjectarry);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Subject', 'Subject Name', 'required');
		$this->form_validation->set_rules('Class', 'Class Name', 'required');
		
		if($this->form_validation->run() == true)
		{
			$table = 'classsubject';
			$where = array(
	 			array('condition' => $table.'.ClassId', 'value' => $Class)
	 		);
			
			$classsubject = $this->Adminmodel->show_rows($table, $where);

			// if subjects already mapped for class, delete them from table. 
			if(count($classsubject) > 0)
			{
			    $id = $Class;
				$where = array(
					array('condition' => $table.'.ClassId', 'value' => $id)
				);
				
				$status = $this->Adminmodel->delete_one_row($table, $where);
			}
			
			// Now insert the subjects selected for class.			
			foreach($subjectarry  as $sub)
			{
				$table='classsubject';
				$data = array(
				   'ClassId' => $Class,
				   'SubjectId' => $sub,
				   'InstituteId' => $this->session->userdata('InstituteId')
				);
				
				$status = $this->Adminmodel->save_data($data, $table);
			}
			
			echo $status;
			
		}else{		    
			$this->listview();
		}
	}
		
	function export()
	{	
		$table = 'classsubject';
		$where = array(			 
			 array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId'),
			array('TableName' => 'subject', 'CompairField' => $table.'.SubjectId = subject.SubjectId'),
		);
		
		$result = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = ClassSubject.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Class Name</th>";
		echo "<th align='center' >Subject Name</th>";
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
		echo "<td align='center'>" . $row->ClassName . "</td>";
		echo "<td align='center'>" . $row->SubjectName . "</td>";
		echo "</tr>";
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

