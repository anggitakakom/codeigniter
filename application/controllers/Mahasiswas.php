<?php
	require APPPATH . '/libraries/REST_Controller.php';
	/**
	 * 
	 */
	class Mahasiswas extends REST_Controller
	{
		
		function __construct()
		{
			parent:: __construct();
			$this->load->model('Mahasiswa', 'Mhs');
		}

		//function to post gambar where gambar type is file
		public function index_post(){

			$nama = $this->post('nama');
			$gambar = $_FILES['gambar']['name'];

			$data = [
				'nama' => $nama,
				'gambar'=> $gambar
			];

			//this code to config image size and upload type file

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = [
					'nama' => $nama,
					'gambar'=> $gambar
				]; 
			}



			$simpan = $this->Mhs->insert($data);
			$this->response($simpan);

			

			
		}

 		//get one data and show
		public function index_get($id=NULL){
			if ($is==NULL) {
				$data = $this->Mhs->get_all()->result();	
			}else{
				$data = $this->Mhs->get_one($id)->result();
			}
			$this->response($data);

		}

		//put one data and show image edit front end change to location image ./uploads
		public function editmhs_post($id=NULL){

			$path = './uploads/';
			$lama = $this->post('lama');
			$nama = $this->post('nama');
			$gambar = $_FILES['gambar']['name'];

			$data = [
				'nama' => $nama,
				'gambar'=> $gambar
			];

			// this code to config image size and upload type file

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = [
					'nama' => $nama,
					'gambar'=> $gambar
				]; 
			}
			//insert gambar to path to path 
			@unlink($path.$this->input->post('gambar'));
			//3 argumen function this value to id, data dan gambar lama 
			$simpan = $this->Mhs->edit($id, $data, $lama);
			$this->response($simpan);	
		}
		//ahir dari update


		//deleting gambar from database
		public function mhs_post($id=NULL){
			$gambar = $this->post('gambar');
			$data = $this->Mhs->delete($id, $gambar);
			$this->response($data);
		} 

	}
?>