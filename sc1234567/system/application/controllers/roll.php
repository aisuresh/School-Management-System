<?php

class Roll extends Controller {

	var $pageinfo;
	var $url;
	function Roll()
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Rolls');
		$this->input->post();
	}
	
	function listview()
	{
	  	$table = 'roll';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'roll/listview';
		
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'RollId';
		$tableArray = array();
		$where =array(
		array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('roll/list', $data);
		$this->load->view('footer');
   }
	
	function view()
	{
		$table = 'roll';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$tableArray=array();
		$id = $this->uri->segment(3);
		$where = array(
			 array('condition' => $table.'.RollId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$this->load->view('roll/view', $data);
		$this->load->view('footer');
    }		
	
	function addnew()
	{
	  	$this->pageinfo['event'] ='Addnew';
	  	$this->load->view('header', $this->pageinfo);
      	$this->load->view('menu');
	  	$this->load->view('roll/addnew');
      	$this->load->view('footer');
   }
   
	function save()
	{
		$table = 'roll';
		$data = array(
               'RollType' => $this->input->post('RollType'),
               'RollDes' => $this->input->post('RollDes'),
			   'InstituteId' => $this->session->userdata('InstituteId')
        );
		$where = array(
			array('condition' => $table.'.RollType', 'value' => $this->input->post('RollType')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('RollType', 'Roll Type', 'required');
			
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

		$this->form_validation->set_rules('RollType', 'Roll Type', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$flag = $this->Adminmodel->save_data( $data, $table);
			echo $flag;
		}else{
			$this->listview();
		}
	}*/


	function edit()
	{
	  	$table = 'roll';
		$this->pageinfo['event'] = 'Edit';
		$field = 'RollId';
		$id = $this->uri->segment(3);
	  	$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
	  	$this->load->view('header', $this->pageinfo);
      	$this->load->view('menu');
	  	$this->load->view('roll/edit', $data);
      	$this->load->view('footer');
    }	
	
	function update()
	{

		$table = 'roll';
		$field = 'RollId';
		$id = $this->input->post('RollId');
		$data = array(
		   'RollType' => $this->input->post('RollType'),
		   'RollDes' => $this->input->post('RollDes')
        );
		$where = array(
			array('condition' => $table.'.RollType', 'value' => $this->input->post('RollType')),
			array('condition' => $table.'.RollDes', 'value' => $this->input->post('RollDes')),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('RollType', 'Roll Type', 'required');
			
			if ($this->form_validation->run() == true)
			{
				$flag = $this->Adminmodel->update_data($field, $id, $data, $table);
				echo $flag;
		}else{
				$this->listview();
			}
		}else{
			echo 2;
		}	
	}
		
		
		/*$this->load->library('form_validation');

		$this->form_validation->set_rules('RollType', 'Roll Type', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$flag = $this->Adminmodel->update_data($field, $id, $data, $table);
			echo $flag;
		}else{
			$this->listview();
		}
	}*/
	
	function export()
	{
		$table = 'roll';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = Rolls.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' width='28%' >Roll Name</th>";
		echo "<th align='center' width='25%' >Roll Type</th>";
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
		echo "<td align='center'>" . $row->RollType . "</td>";
		echo "<td align='center'>" . $row->RollDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}
	
			
	

}

	
/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */