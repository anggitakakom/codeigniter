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
		$this->load->model('Detail_transaksis','Det');
		//untuk terhubung kepada model detail_transaksi
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

	// ini untuk 1 mahasiswa mengambil banyak matakuliah
	public function krs_post(){
		$krs = [
			'id_mahasiswa' => $this->post('id_mahasiswa')
		];
		//susah untuk ditampilkans ebagai response karena data array ding menggunakan data dalam bentuk biasa dekode array

		//menampung semua data dalam array
		$simpan = $this->Tran->insert($krs);
		$id = $this->db->insert_id();
		// insert_id() = untuk mendapatkan id seletah insert terhadap tabel transaksi
		$post = json_decode(trim(file_get_contents('php://input')), true);
		//mengubah format dari data array agar bisa diambil 1 data berdasarkan value
		$pel = $post['pelajaran'];
		//mengambil nilai banyaknya data pelajaran yang diambil
		$data = array();
		foreach ($pel as $key) {
			$data[]=array(
				'id_transaksis' => $id,
				'id_pelajarans' => $key['id_pelajarans']
			);
		}
		$krs = $this->Det->insert($data);
		$this->response(array(
			'Message' => 'Sukses',
			'pelajaran'	=> $data
		), 200);
	}

	// untuk melihat hasil dari detail transaksi mahasiswa mengambil berapa mata pelajaran
	public function krs_get($id=NULL){

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
