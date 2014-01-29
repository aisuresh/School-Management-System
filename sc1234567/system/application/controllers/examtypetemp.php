<?php
class Examtype extends Controller 
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Exam Type');
		$this->input->post();
	}
	
	function listview()
	{
		$table = 'exam';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'examtype/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'ExamId';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('examtype/list', $data);
		$this->load->view('footer');
	}
	
	function view()
	{
		$table = 'exam';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			 array('condition' => $table.'.ExamId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
		$this->load->view('examtype/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('examtype/addnew');
		$this->load->view('footer');
	}
	
	function save()
	{	
		$table = 'exam';
		$data = array(
		   'ExamType' => $this->input->post('ExamType'),
		   'ExamMarks' => $this->input->post('ExamMarks'),
		   'ExamDes' => $this->input->post('ExamDes'),
		   'InstituteId' => $this->session->userdata('InstituteId')
        );
		$where = array(
			array('condition' => $table.'.ExamType', 'value' => $this->input->post('ExamType')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('ExamType', 'Exam Type', 'required');
			$this->form_validation->set_rules('ExamMarks', 'Exam Marks', 'required');

			
			if ($this->form_validation->run() == true)
			{
			$status = $this->Adminmodel->save_data($data, $table);
				echo $status;
			}else{
				$this->listview();
			}
		}else{
			echo 2;
		}	
	}
	
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('ExamType', 'Exam Type', 'required');
		$this->form_validation->set_rules('ExamMarks', 'Exam Marks', 'required');
		if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->save_data($data, $table);
			echo $status;
		}else{
			$this->listview();
		}
	}*/
	
	function edit()
	{
		$table = 'exam';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'ExamId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('examtype/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'exam';
		$field = 'ExamId';
		$id = $this->input->post('ExamId');
		$data = array(
		   'ExamType' => $this->input->post('ExamType'),
		   'ExamMarks' => $this->input->post('ExamMarks'),
		   'ExamDes' => $this->input->post('ExamDes')
        );
		$where = array(
			array('condition' => $table.'.ExamType', 'value' => $this->input->post('ExamType')),
			array('condition' => $table.'.ExamMarks', 'value' => $this->input->post('ExamMarks')),
			array('condition' => $table.'.ExamDes', 'value' => $this->input->post('ExamDes')),						
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('ExamType', 'Exam Type', 'required');
			$this->form_validation->set_rules('ExamMarks', 'Exam Marks', 'required');
					
			if ($this->form_validation->run() == true)
			{
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
				echo $status;
			}else{
				$this->listview();
			}
		}else{
			echo 2;
		}	
	}
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('ExamType', 'Exam Type', 'required');
		$this->form_validation->set_rules('ExamMarks', 'Exam Marks', 'required');
		if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->update_data($field, $id, $data, $table);
			echo $status;
		}else{
			$this->listview();
		}
	}*/
	
	function export()
	{
		$table = 'exam';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = ExamType.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Exam Type</th>";
		echo "<th align='center' >Exam Marks</th>";
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
		echo "<td align='center'>" . $row->ExamType . "</td>";
		echo "<td align='center'>" . $row->ExamMarks . "</td>";
		echo "<td align='center'>" . $row->ExamDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

