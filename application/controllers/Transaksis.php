<?php

//becareful thiss apppath name fulll call name file 
// require APPPATH . '/libraries/REST_Controller'; -> false
require APPPATH . '/libraries/REST_Controller.php'; //->true code

/**
 * 
 */
class Transaksis extends REST_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Transaksi', 'Tran');
	}

	//post data to model and adatabase
	public function index_post(){
		$data = [
			'id_mahasiswa' => $this->post('id_mahasiswa'),
			'id_matakuliah' => $this->post('id_matakuliah')
		];
		$simpan = $this->Tran->insert($data);
		$hasil=[
			'status' => 200,
            'message' => 'Post Data',
            'errorMessage' => 'Null',
            'data' => $data,
		];
		$this->response($hasil);
	} 

	//kondision get_all or get_one
	public function index_get($id=NULL){
		if ($id==NULL) {
			$data = $this->Tran->get_all()->result();
		}else{
			$data = $this->Tran->get_one($id)->result();
		}
		$this->response($data, 200);
	}

	//url+TRX to get 3 join tabel 
	public function TRX_get($id=NULL){
		//this condision checkk == true and = false
		if ($id==NULL) {
			$data = $this->Tran->get_semua()->result();
		}else{
			$data = $this->Tran->get_satu($id)->result();
		}
		$this->response($data, 200);
	}

}
?>
