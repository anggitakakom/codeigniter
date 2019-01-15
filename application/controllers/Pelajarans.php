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

		//simple get all data
		// public function index_get(){
		// 	$data = $this->pela->get_all()->result();
		// 	$this->response($data, 200); 
		// }

		//simple put data
		// public function index_put($id=NULL){
		// 	$data = $this->pela->get_one($id)->result();
		// 	$this->response($data, 200);
		// }

		//get all data and one data with kondision
		public function index_get($id=NULL){
			if ($id==NULL) {
				$data = $this->pela->get_all()->result();
				$hasil = [
	                'status' => 200,
	                'message' => 'Request Data',
	                'errorMessage' => 'Null',
	                'data' => $data,
	            ];

			$this->response($hasil);
			}else{
				$data = $this->pela->get_one($id)->result();
				if ($data == NULL) {
					$hasil = [
		                'status' => 200,
		                'message' => 'Request Data',
		                'errorMessage' => 'Null',
		                'data' => 'ID tidak ditemukan',
		            ];

					$this->response($hasil);
				}else{
					$hasil = [
			            'status' => 200,
			            'message' => 'Request Data',
			            'errorMessage' => 'Null',
			            'data' => $data,
			        ];

					$this->response($hasil);
				}
			}

		}

		public function index_post(){
			//post dengan json
			$data = [
				'matakuliah' => $this->post('matakuliah'),
				'sks' => $this->post('sks')
			];

			//post dengan array
			// $data = array(
			// 	'matakuliah' => $this->post('matakuliah'),
			// 	'sks' => $this->post('sks') 
			// );

			$simpan = $this->pela->insert($data);
			$hasil = [
	            'status' => 200,
	            'message' => 'Post Data',
	            'errorMessage' => 'Null',
	            'data' => $data,
	        ];

			$this->response($hasil);

		}

		//function delete data with id
		public function index_delete($id=NULL){
			$data = $this->pela->delete($id);
			$hasil = [
	            'status' => 200,
	            'message' => 'Delete Data Succes',
	            'errorMessage' => 'Null',
	            'data ID' => $id,

	        ];
			$this->response($hasil, 200);
		}

		//function change data with id
		public function index_put($id=NULL){

			$data =[
				'matakuliah' => $this->put('matakuliah'),
				'sks' => $this->put('sks')
			];

			$simpan = $this->pela->update($id, $data);
			$hasil = [
	            'status' => 200,
	            'message' => 'Update Data Succes',
	            'errorMessage' => 'Null',
	            'data' => $data,

	        ];
			$this->response($hasil, 200);
		}



	}
?>