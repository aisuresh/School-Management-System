<?php

class Categories extends Controller {

	function Categories()
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
	}
	
	function categoryview()
	{
	  $url = base_url();
	  
	  $data1 = array(
            'title' => 'SCHOOL',
			'url' => $url
      );
			

	$data['query'] = $this->categoriesmodel->categories_view();
	
		
	  $this->parser->parse('header', $data1);
      $this->load->view('menu');
	  $this->load->view('categoryview', $data);
      $this->load->view('footer');
	}
	
	function categoryaddnew()
	{
	  $url = base_url();
	  $data = array(
            'title' => 'SCHOOL',
			'url' => $url
            );
	  $this->parser->parse('header', $data);
      $this->load->view('menu');
      $this->load->view('categoryaddnew', $data);
      $this->load->view('footer');
	}
	
	function save()
	{
		$categoryname =$_POST['categoryname'];
	  	$categorydes =$_POST['categorydes'];
	  	$flag = $this->categoriesmodel->categories_save($categoryname, $categorydes);
		echo $flag;
	}
	
	function categoryedit($categoryid)
	{
		$url = base_url();
	  
	  $data1 = array(
            'title' => 'SCHOOL',
			'url' => $url
      );
			
	$data = $this->categoriesmodel->categories_edit($categoryid);
	
	  	
	  $this->parser->parse('header', $data1);
      $this->load->view('menu');
	  $this->load->view('categoryedit', $data);
      $this->load->view('footer');
	}
	
	function update()
	{
		$categoryid =$_POST['categoryid'];
		$categoryname =$_POST['categoryname'];
	  	$categorydes =$_POST['categorydes'];
	  	$flag = $this->categoriesmodel->categories_update($categoryid, $categoryname, $categorydes);
		echo $flag;
	}

}

	
/* End of file my_control.php */
/* Location: ./system/application/controllers/my_control/my_control.php */