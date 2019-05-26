<?php

class Setting extends Controller {
	
	var $pageinfo;
	var $url;
	var $data;

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
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Setting');
		$this->input->post();
		
	}
	
	function settingview()
	{
	 
		$table = 'settings';
		$this->pageinfo['event'] = 'settingview';
		$this->load->view('header', $this->pageinfo);
		$this->load->view('menu');
		$config['base_url'] = base_url() . 'setting/settingview';
		
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		$searchoption = ''; $searchstring = '';
		if($this->input->post('searchoption') != NULL && $this->input->post('searchstring') != NULL ){
			$searchoption = $this->input->post('searchoption');
			$searchstring = $this->input->post('searchstring');
		}
		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$sortby = 'SettingTypeId';
		$tableArray = array();
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['result'] = $this->Adminmodel->fetch_records($config['per_page'], $page, $table, $tableArray, $searchoption , $searchstring, $sortby, $where);
		/*$config['total_rows'] = $this->Adminmodel->record_list_count($table, $tableArray, $searchoption, $searchstring, $where);
		$this->pagination->initialize($config);
		$table = 'stafftype';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
					);
		$data['stafftype'] = $this->Adminmodel->show_rows($table, $where);
		$table = 'qualification';
		$where = array(
					array( 'condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId'))
		);
		$data['qualification'] = $this->Adminmodel->show_rows($table, $where);
		$data['links'] = $this->pagination->create_links();
		$data['pages'] = $page;*/
		$this->load->view('setting', $data);
		$this->load->view('footer');
	}

	function update()
	{
	    $table = 'settings';
		
		// set the admission id flag
		$data = array('flag' => $this->input->post('admissionidflag'));		
		$where = array(
			array( 'condition' => $table.'.SettingTypeId', 'value' => 1),
	    	array( 'condition' => $table.'.InstituteId',   'value' => $this->session->userdata('InstituteId'))
		);
		$status = $this->Adminmodel->update_multi_data($where, $data, $table);
	
		// set the roll no flag	
		$data = array('flag' => $this->input->post('rollidflag'));
		$where = array(
			array( 'condition' => $table.'.SettingTypeId', 'value' => 2),
	    	array( 'condition' => $table.'.InstituteId',   'value' => $this->session->userdata('InstituteId'))
		);
		$status = $this->Adminmodel->update_multi_data($where, $data, $table);
		
		echo $status;
	}
}

/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */