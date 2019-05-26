<?php

class Bookcode extends Controller {

	var $pageinfo;
	var $url;

	
	function Bookcode()
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Book Code');
		$this->input->post();
		
	}
	
	function listview()
	{
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'bookcode';
		$config['base_url'] = base_url() . 'bookcode/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption ='';
		$searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post()$_POST['searchoption'];
			$searchstring = $this->input->post()$_POST['searchstring'];
		}
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'BookCodeId';
		$tableArray = array();
		$where = array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('bookcode/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'bookcode';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Book Code', 'event' => 'List view' );
		$config['base_url'] = base_url() . 'bookcode/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($this->table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$tableArray = array();
		$where = array();
		$data['query'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('bookcode/list', $data);
	}
	
	function search_data(){
		$table = 'bookcode';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Book Code', 'event' => 'List view' );
		$config['base_url'] = base_url() . 'bookcode/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
	
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'BookCodeId';
		$tableArray = array();
		$where = array();
		$data['query'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('bookcode/list', $data);
	}
	
	 function view()
	{
		$table = 'bookcode';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.BookCodeId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		$table = 'bookcategory';
		$where = array();
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('bookcode/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$table = 'bookcategory';
		$where = array();
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('menu');
		$this->load->view('bookcode/addnew', $data);
		$this->load->view('footer');
	}
	
	function save()
	{	
		$table = 'bookcode';
		$data = array(
		   'BookCode' => $this->input->post('BookCode'),
		   'BookCategoryId' => $this->input->post('BookCategoryId'),
		   'BookCodeDes' => $this->input->post('BookCodeDes')
        );
		
		$status = $this->Adminmodel->save_data($data, $table);
		echo $status;
	}
	
	function edit()
	{
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'BookCodeId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'bookcategory';
		$where = array();
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('bookcode/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'bookcode';
		$field = 'BookCodeId';
		$id =  $this->input->post('BookCodeId');
		$data = array(
		   'BookCode' => $this->input->post('BookCode'),
		   'BookCategoryId' => $this->input->post('BookCategoryId'),
		   'BookCodeDes' => $this->input->post('BookCodeDes')
        );
		
		$status = $this->Adminmodel->update_data($field, $id, $data, $table);
		echo $status;
	}
	
	function export()
	{
		$table = 'bookcode';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = BookCodes.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$result = $this->Adminmodel->export_records($table);
		
		$table = 'bookcategory';
		$where = array();
		$bookcategory = $this->Adminmodel->show_rows($table, $where);
		
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Book Code</th>";
		echo "<th align='center' >Book Category</th>";
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
		echo "<td align='center'>" . $row->BookCode . "</td>";
		echo "<td align='center'>";
		 foreach($bookcategory as $rowa):
			if($rowa->BookCategoryId == $row->BookCategoryId){
				echo $rowa->BookCategory;
			}
		endforeach;

		echo "</td>";
		
		echo "<td align='center'>" . $row->BookCodeDes . "</td>";

		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

	
/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */