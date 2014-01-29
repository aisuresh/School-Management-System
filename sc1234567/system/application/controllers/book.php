<?php
class Book extends Controller 
{

	var $pageinfo;
	var $url;
	
	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
		$this->load->library('table');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
		$this->load->library('pagination');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Books');
		$this->input->post();
	}
	
	function listview()
	{
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'book';
		$config['base_url'] = base_url() . 'book/listview';
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'BookId';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, 
		$sortby, $where);
		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$table = 'bookcategory';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$data['links'] = $this->pagination->create_links();
		$this->data['pages'] = $page;
		$this->load->view('book/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Books', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = $this->url . 'book/listview';
		$table = 'book';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sort = (string)$this->input->post('sortkey');
		$order = (string)$this->input->post('order');
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$table = 'bookcategory';
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('book/list', $data);
	}
	
	function search_data(){
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Books', 'url' => $this->url, 'event' => 'List view' );
		$table = 'book';
		$config['base_url'] = base_url() . 'book/listview';
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
		$sortby = 'BookId';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, 
		$sortby, $where);
		$table = 'bookcategory';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('book/list', $data);
	}
	
	 function view()
	{
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'book';
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.BookId', 'value' => $id)
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
		$table = 'bookcategory';
		$where = array();
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('book/view', $data);
		$this->load->view('footer');
	}
	
	 function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'bookcategory';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('book/addnew', $data);
		$this->load->view('footer');
	}
	
	function examtype()
	{
		$table = 'exam';
		$id = $this->input->post('ExamTypeId');
		$where = array(
			array('condition' => $table.'.ExamId', 'value' => $id)
		);
		$data = $this->Adminmodel->fetch_row($table, $tableArray, $where);
		foreach($data as $row ){
			echo $row->ExamMarks;
		}
	}
	
	function save()
	{	
		$table = 'book';
		$data = array(
		   'InstituteId' => $this->session->userdata('InstituteId'),
		   'BookName' => $this->input->post('BookName'),
		   'BookCode' => $this->input->post('BookCode'),
		   'BookCategoryId' => $this->input->post('BookCategoryId'),
		   'BookAuthor' => $this->input->post('BookAuthor'),
		   'BookVolume' => $this->input->post('BookVolume'),
		   'BookEdition' => $this->input->post('BookEdition'),
		   'BookDes' => $this->input->post('BookDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.BookName', 'value' => $this->input->post('BookName'))
			
		);		
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('BookName', 'Book Name', 'required');
			$this->form_validation->set_rules('BookCode', 'Book Code', 'required');
			$this->form_validation->set_rules('BookCategoryId', 'Book Category', 'required');
			$this->form_validation->set_rules('BookAuthor', 'Book Author', 'required');
			$this->form_validation->set_rules('BookVolume', 'Book Volume', 'required');
			$this->form_validation->set_rules('BookEdition', 'Book Edition', 'required');
			
			
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
		$this->form_validation->set_rules('BookName', 'Book Name', 'required');
		$this->form_validation->set_rules('BookCode', 'Book Code', 'required');
		$this->form_validation->set_rules('BookCategoryId', 'Book Category', 'required');
		$this->form_validation->set_rules('BookAuthor', 'Book Author', 'required');
		$this->form_validation->set_rules('BookVolume', 'Book Volume', 'required');
		$this->form_validation->set_rules('BookEdition', 'Book Edition', 'required');
		
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
		$table = 'book';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'BookId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'bookcategory';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('book/edit', $data);
		$this->load->view('footer');
	}
	
	function update()
	{
		$table = 'book';
		$field = 'BookId';
		$id = $_POST['BookId'];
		$data = array(
		   'BookName' => $this->input->post('BookName'),
		   'BookCode' => $this->input->post('BookCode'),
		   'BookCategoryId' => $this->input->post('BookCategoryId'),
		   'BookAuthor' => $this->input->post('BookAuthor'),
		   'BookVolume' => $this->input->post('BookVolume'),
		   'BookEdition' => $this->input->post('BookEdition'),
		   'BookDes' => $this->input->post('BookDes')
        );
		$where = array(
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.BookName', 'value' => $this->input->post('BookName')),
			array('condition' => $table.'.BookCode', 'value' => $this->input->post('BookCode')),
			array('condition' => $table.'.BookCategoryId', 'value' => $this->input->post('BookCategoryId')),
			array('condition' => $table.'.BookAuthor', 'value' => $this->input->post('BookAuthor')),
			array('condition' => $table.'.BookVolume', 'value' => $this->input->post('BookVolume')),
			array('condition' => $table.'.BookEdition', 'value' => $this->input->post('BookEdition')),
			array('condition' => $table.'.BookDes', 'value' => $this->input->post('BookDes'))
			
			
			
		);
		$result = $this->Adminmodel->show_rows($table, $where);
		//print_r($result);
		if(!isset($result) && $result <= 0){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('BookName', 'Book Name', 'required');
			$this->form_validation->set_rules('BookCode', 'Book Code', 'required');
			$this->form_validation->set_rules('BookCategoryId', 'Book Category', 'required');
			$this->form_validation->set_rules('BookAuthor', 'Book Author', 'required');
			$this->form_validation->set_rules('BookVolume', 'Book Volume', 'required');
			$this->form_validation->set_rules('BookEdition', 'Book Edition', 'required');
			
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
		$this->form_validation->set_rules('BookName', 'Book Name', 'required');
		$this->form_validation->set_rules('BookCode', 'Book Code', 'required');
		$this->form_validation->set_rules('BookCategoryId', 'Book Category', 'required');
		$this->form_validation->set_rules('BookAuthor', 'Book Author', 'required');
		$this->form_validation->set_rules('BookVolume', 'Book Volume', 'required');
		$this->form_validation->set_rules('BookEdition', 'Book Edition', 'required');
		
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
		$table = 'book';
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = books.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		$result = $this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb; height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Book Name</th>";
		echo "<th align='center' >Book Code</th>";
		echo "<th align='center' >Book Category</th>";
		echo "<th align='center' >Book Author</th>";
		echo "<th align='center' >Book Volunm</th>";
		echo "<th align='center' >Book Edition</th>";
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
		echo "<td align='center'>" . $row->BookName . "</td>";
		echo "<td align='center'>" . $row->BookCode . "</td>";
		echo "<td align='center'>" . $row->BookCategoryId . "</td>";
		echo "<td align='center'>" . $row->BookAuthor . "</td>";
		echo "<td align='center'>" . $row->BookVolume . "</td>";
		echo "<td align='center'>" . $row->BookEdition . "</td>";
		echo "<td align='center'>" . $row->BookDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

