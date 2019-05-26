<?php

class Admin extends Controller {
  
   var $pageinfo;
	var $url;
	function Admin()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->helper('url');
		//if ($this->session->userdata('rollid') == '' || $this->session->userdata('database') == '') exit(redirect('login/index'));
		if ($this->session->userdata('rollid') == '' ) exit(redirect('login/index'));
		$this->load->helper('html');
	    $this->load->library('parser');	
		$this->load->model('Adminmodel');
		$this->load->database();
		$this->url = base_url();
		$this->pageinfo = array('title' => 'SCHOOL', 'url' => $this->url, 'pagetitle' => 'Admin' );	
		
	}
	
	function adminview()
	{
	     
		 //$this->load->helper('url');
	  	//$data = array(
			//'title' => 'SCHOOL'
	  //	);
		//$this->load->view('header', $this->pageinfo);
		 //$this->load->view('menu', $menu);
		
		// $this->url = base_url();
		 $this->data['spentamount'] = 0;
		 //$rollid = $this->session->userdata('rollid');
		 //$menu['rollmenu'] = $this->Adminmodel->menu_show($rollid);
		 $this->pageinfo['event'] = 'Admin View';
		$this->load->view('header',$this->pageinfo);
	  	$this->load->view('menu');
	  	$this->load->view('admin');
	  	$this->load->view('footer');
	}
	
}

/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */
