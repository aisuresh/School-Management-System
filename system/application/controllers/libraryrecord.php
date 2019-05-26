<?php
class Libraryrecord extends Controller 
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
		$this->load->library('form_validation');
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Library Record');
		$this->input->post();
		$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);

	}
	
	function listview()
	{
		$table = 'libraryrecord';
		$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'libraryrecord/listview/'.$this->pyear;
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}

		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'LibraryRecordId';
		$tableArray = array();
		$this->session->set_userdata('yearlr', $this->pyear);
		$tableArray = array(
			array('TableName' => 'book', 'CompairField' => $table.'.BookCode=book.BookCode')
		);
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.ReceivedDate', 'value' => NULL ),
			array('condition' => $table.'.Year', 'value' => $this->pyear),
			array('condition' => 'book.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, 
		$sortby, $where);

		$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);

		$table = 'book';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['book'] = $this->Adminmodel->show_rows($table, $where);	
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('libraryrecord/list', $data);
		$this->load->view('footer');
	}
	
	function sort_data()
	{
		$table = 'libraryrecord';
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Record', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'libraryrecord/listview/'.$this->pyear;
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sort = 'libraryrecord.'.$this->input->post('sortkey');
		$order = $this->input->post('order');
		$tableArray = array();
		
		//$this->session->set_userdata('yearlr', $this->pyear);
		/*$tableArray = array(
			array('TableName' => 'book', 'CompairField' => $table.'.BookCode=book.BookCode')
		);*/
		//$tableArray=array();
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.ReceivedDate', 'value' => NULL ),
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
		$data['result'] = $this->Adminmodel->sort_records($config['per_page'], $page, $table, $tableArray,  $sort, $order, $where);
		$table = 'book';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['book'] = $this->Adminmodel->show_rows($table, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('libraryrecord/list', $data);
	}
	
	function search_data(){
		if($this->input->post('Year') == NULL){
			$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
			foreach($yearno as $yno){
				if($yno->AcademicYear != NULL){
					$year = $yno->AcademicYear;
				}
			}
		}else{
			$year = $this->input->post('Year');
			$this->session->set_userdata('yearlr', $year);
		}
		
		$data = array( 'project' => 'BREAKBULK', 'pagetitle' => 'Library Record', 'url' => $this->url, 'event' => 'List view' );
		$config['base_url'] = base_url() . 'libraryrecord/listview';
		$table = 'libraryrecord';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption ='';
		$searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		$sortby = 'LibraryRecordId';
		/*$tableArray = array(
			array('TableName' => 'book', 'CompairField' => $table.'.BookCode=book.BookCode')
		);*/
        $tableArray=array();
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
			array('condition' => $table.'.ReceivedDate', 'value' => NULL ),
			array('condition' => $table.'.Year', 'value' => $year)
		);
		//$where=array();
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, 
		$sortby, $where);
		$table = 'book';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['book'] = $this->Adminmodel->show_rows($table, $where);	
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('libraryrecord/list', $data);
	}
	
	function addnew()
	{
		$this->pageinfo['event'] ='AddNew';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$table = 'Book';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['book'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'libraryreg';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['libraryno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('libraryrecord/addnew', $data);
		$this->load->view('footer');
	}
	
	 function view()
	{
		$table = 'libraryrecord';
		$this->pageinfo['event'] = 'View';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$id = $this->uri->segment(3);
		$where = array(
			array('condition' => $table.'.LibraryRecordId', 'value' => $id),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['result'] = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where);
		$table = 'Book';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['book'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'libraryreg';
		$where = array(
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['libraryno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('libraryrecord/view', $data);
		$this->load->view('footer');
	}
	
	function issue()
	{
		$this->pageinfo['event'] ='Issue';
		$table = 'libraryreg';
		$where = array(
		array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['libraryno'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'bookcategory';
		$where = array(
		array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		
		);
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'book';
		$where = array(
		array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['book'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('libraryrecord/issue', $data);
		$this->load->view('footer');
	}
	
	function selectbook(){
		
		$table = 'bookcategory';
		$fielda = 'BookCategoryId';
		$row = $this->input->post('BookCategoryId');
		$where = array(
		 	array('condition' => $table.'.'.$fielda, 'value' => $row),
			//array('condition' => $table.'.Year', 'value' => $year),
			array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$tjoin = array(
		 	array('TableName' => 'book', 'Condition' => $table.'.BookCategoryId = book.BookCategoryId')
		);
		$selectbook = $this->Adminmodel->fetch_row_where( $where, $table, $tjoin);
		
		$str2 = '';
		$str1 = "<option value = 'x'>- - Select book - -</option>";
		if(count($selectbook) > 0){
			foreach($selectbook as $row){
				$str2 =$str2. "<option value = '".$row->BookCode."' >".$row->BookName."</option>";
			}
			$str = $str1.$str2;
			echo $str;
		}else{
			echo $str1;
		}	
		
	}
	
	
	function returns()
	{
		$this->pageinfo['event'] ='Return';
		$table = 'libraryreg';
		$where = array(
		array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
		);
		$data['libraryno'] = $this->Adminmodel->show_rows($table, $where);
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('libraryrecord/return', $data);
		$this->load->view('footer');
	}
	
	function bookcategory(){
		$bookcategory = $this->input->post('bookcategory');
		$table = 'book';
		$where = array(
			array('condition' => $table.'.BookCategoryId', 'value' => $bookcategory ),
			array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
			
		);
		$data['bookcategory'] = $this->Adminmodel->show_rows($table, $where);
		$str1 = '<option>- - Select Book - -</option>';
		foreach($data['bookcategory'] as $bc){
			echo '<option value = "'.$bc->BookCategoryId.'">'.$bc->BookName.'</option>';
		}
		//echo $str1 . $str2;
	}
	
	function save()
	{	
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				 $year = $yno->AcademicYear; 
			}
		}
		$table = 'libraryrecord';
		$ReturnDate = date("Y-m-d", strtotime($this->input->post('ReturnDate')));
		$data = array(
		   'InstituteId' =>  $this->session->userdata('InstituteId'),
		   'LibraryNo' => $this->input->post('LibraryNo'),
		   'BookCode' => $this->input->post('BookCode'),
		   'IssuedDate' => date('Y-m-d H:i:s'),
		   'ReturnDate' => $ReturnDate ,
		   'Year' =>  $year,
		   'LibraryDes' => $this->input->post('LibraryDes')
        );
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('LibraryNo', 'Library No', 'required');
		$this->form_validation->set_rules('BookCode', 'Book Code', 'required');
		//$this->form_validation->set_rules('IssuedDate', 'Issued Date', 'required');
		$this->form_validation->set_rules('ReturnDate', 'Return Date', 'required');
		//$this->form_validation->set_rules('Year', 'Year', 'required');
		
		if ($this->form_validation->run() == true)
		{
			$status = $this->Adminmodel->save_data($data, $table);
			echo $status;
		}else{
			$this->listview();
		}
		
		
	}
	
	function issuelist(){
		$table = 'libraryrecord';
		$lno = $this->input->post('LibraryNo');
		$where = array(
			array('condition' => $table.'.LibraryNo', 'value' => $lno ),
			array('condition' => $table.'.ReceivedDate', 'value' => NULL ),
			array('condition' => 'book.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$tjoin = array(
			array('TableName' => 'book' , 'Condition' => $table.'.BookCode=book.BookCode' ),
		);
		$data['return'] = $this->Adminmodel->fetch_row_where($where, $table, $tjoin);
		$this->load->view('libraryrecord/returnlist', $data);
	}
	
  
	
	function edit()
	{
		$table = 'libraryrecord';
		$this->pageinfo['event'] = 'Edit';
		$id = $this->uri->segment(3);
		$field = 'LibraryRecordId';
		$data['result'] = $this->Adminmodel->edit_data($field, $id, $table);
		$table = 'Book';
		$data['bookcode'] = $this->Adminmodel->show_rows($table, $where=array());
		$table = 'libraryreg';
		$data['libraryno'] = $this->Adminmodel->show_rows($table, $where=array());
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$this->load->view('libraryrecord/edit', $data);
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
		$table = 'libraryrecord';
		$field = 'LibraryRecordId';
		$IssuedDate = date("Y-m-d", strtotime($this->input->post('IssuedDate')));
		$ReturnDate = date("Y-m-d", strtotime($this->input->post('ReturnDate')));
		$lr = $this->input->post('LibraryRecordId');
		$id =$this->input->post('LibraryRecordId');
		$data = array(
				    'LibraryNo' => $this->input->post('LibraryNo'),
				    'BookCode' => $this->input->post('BookCode'),
					'IssuedDate' => $IssuedDate,
					'ReturnDate' => $ReturnDate ,
					'Year' => $year ,
					 'LibraryDes' => $this->input->post('LibraryDes'),
				    
				 );
		
	
		$this->form_validation->set_rules('LibraryNo', 'Library No', 'required');
		$this->form_validation->set_rules('BookCode', 'Book Code', 'required');
		$this->form_validation->set_rules('IssuedDate', 'Issued Date', 'required');
		$this->form_validation->set_rules('ReturnDate', 'Return Date', 'required');
		//$this->form_validation->set_rules('Year', 'Year', 'required');
		
		if ($this->form_validation->run() == true)
		{
			//for($i = 0; $i < count($lrarray); $i++){
				//$id = $lrarray[$i];
				//$id =$this->input->post('LibraryRecordId');
				
				$status = $this->Adminmodel->update_data($field, $id, $data, $table);
				echo $status;
				
			/*if($status){
				echo true;
			}else{
				echo 'error';
			}*/
		}else{
			$this->listview();
		}
		
		
	}
	
	 function book_return(){
	  $table = 'libraryrecord';
	  $field = 'LibraryRecordId';
	  $ids = explode(',',$this->input->post('LibraryRecordId'));
	  $data = array(
	   'ReceivedDate'=> date('Y-m-d')
	   
	  );
	  foreach($ids as $id){
	   $status = $this->Adminmodel->update_data($field, $id, $data, $table);
	  }
	  if($status){
	   echo '1';
	  }else{
	   echo 'error';
	  } 
	 }
	
	function export()
	{
		
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename = LibraryRecords.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
		
		if($this->input->post('Year') == NULL){
			$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
			foreach($yearno as $yno){
				if($yno->AcademicYear != NULL){
					$year = $yno->AcademicYear;
				}
			}
		}else{
			$year = $this->input->post('Year');
			$this->session->set_userdata('yearlr', $year);
		}
		$table = 'libraryrecord';
		/*$where = array(
			array('condition' => $table.'.ReceivedDate', 'value' => NULL ),
			array('condition' => $table.'.Year',  'value' => $year)
		);*/
		
		//$result = $this->Adminmodel->fetch_row($table, $tableArray = array(), $where );
		$result=$this->Adminmodel->export_records($table);
		echo "<table class ='master_view_tbl' cellspacing='0' cellpadding='0'>";
		echo "<tr style='font-size:12px; font-weight:bold; color:#3e4341; border-right:1px solid #a4a9a8; background-color:#b3c1bb;           height:30px; text-align:center;'>";
		echo "<th> SNO </th>";
		echo "<th align='center' >Library No</th>";
		echo "<th align='center' >Book Code</th>";
		echo "<th align='center' >Issued Date</th>";
		echo "<th align='center' >Return Date</th>";
		echo "<th align='center' >Description</th>";
		echo "</tr>";
		$i= 1;
		echo $result;
		foreach($result as $row):
		if($i % 2){
			$master_tr_bgcolor = 'background-color:#f8fcfc; border-right:1px solid #a4a9a8; padding-left:5px;';
		}else{
			$master_tr_bgcolor = 'background-color:#e4ebec; border-right:1px solid #a4a9a8; padding-left:5px;';
		}
		
		echo "<tr style='" . $master_tr_bgcolor . "'>";
		echo "<td style='padding:5px; text-align:center; ' >" . $i++ . "</td>";  
		echo "<td align='center'>" . $row->LibraryNo . "</td>";
		echo "<td align='center'>" . $row->BookCode . "</td>";
		echo "<td align='center'>" . $row->IssuedDate . "</td>";
		echo "<td align='center'>" . $row->ReturnDate . "</td>";
		echo "<td align='center'>" . $row->LibraryDes . "</td>";
		echo "</tr>";		
			endforeach;
		echo "</table>";
		
	}

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

