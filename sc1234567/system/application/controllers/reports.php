<?php
class Reports extends Controller 
{

	var $pageinfo;
	var $data;
	var url;
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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Library Register');
		$this->input->post();
		$this->data['years'] = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
	}
	
	function reports($url)
	{
		
		/*$this->pageinfo['event'] = 'List view';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'classfees/listview';
		$config['total_rows'] = $this->Adminmodel->record_count($table);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		
		
		$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
		$table = 'classfees';
		$sortby = 'ClassFeeId';
		$tableArray = array(
			array('TableName' => 'course', 'CompairField' => $table.'.ClassId = course.ClassId' )
		);
		$where = array(
			 array('condition' => $table.'.Year', 'value' => $year)
		);
		
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;
		$this->load->view('classfees/list', $data);
		$this->load->view('footer');
	}*/
		if($url === 'schoolfees'){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('reports/schoolfees');
			$this->load->view('footer');
		}
	}
	
	

}

/* End of file marks.php */
/* Location: ./system/application/controllers/marks.php */

