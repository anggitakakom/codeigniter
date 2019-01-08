<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controldata extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('datamodel');
	}

	public function index()
	{
		$data['semua']=$this->datamodel->data();
		$this->load->view('tampildata',$data);
	}

}

/* End of file controldata.php */
/* Location: ./application/controllers/controldata.php */