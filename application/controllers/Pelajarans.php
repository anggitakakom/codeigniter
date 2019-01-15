<?php
	require APPPATH . '/libraries/REST_Controller.php';

	/**
	 * 
	 */
	class Pelajarans extends REST_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('Pelajaran', 'pela');

		}

		public function index_get(){
			$data = $this->pela->get_all()->result();
			$this->response($data, 200); 
		}

		public function index_put($id){
			$data = $this->pela->get_one($id)->result();
			$this->response($data, 200);
		}

	}
?>