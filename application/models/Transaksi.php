<?php
	/**
	 * 
	 */
	class Transaksi extends CI_Model
	{
		const Trx = 'transaksis';
		const Mhs = 'mahasiswas';
		const Pel = 'pelajarans';		

		function __construct()
		{
			parent:: __construct();
		}

		public function insert($value){
			$this->db->insert(self::Trx, $value);
			return $this->db->affected_rows();
		}

		//get all database table transaksi and join with tabel mahasiswa
		public function get_all(){
			return $this->db->select('a.id, b.nama, a.date')
			->from(self:: Trx.' a')
			->join(self:: Mhs.' b','a.id_mahasiswa=b.id')
			//inisialisasion a to Trx(transaksions) and b to Mhs(mahasiswa)
			->get();
		}

		//get one data with join tabel
		public function get_one($value){
			return $this->db->select('a.id, b.nama, a.date')
			->from(self::Trx.' a')
			->join(self::Mhs.' b','a.id_mahasiswa=b.id')
			->where('a.id', $value)
			//dont't ambigu in join tabel because this tabel casesensitive
			->get();
		}

		//getl all tabel and join 3 tabel
		public function get_semua(){
			return $this->db->select('a.id, b.nama, c.matakuliah, a.date')
			->from(self::Trx.' a')
			->join(self::Mhs.' b','a.id_mahasiswa=b.id')
			->join(self::Pel.' c','a.id_matakuliah=c.id')
			->get();
		}

		//get one tabel and join 3 tabel
		public function get_satu($value){
			return $this->db->select('a.id, b.nama, c.matakuliah, a.date')
			->from(self::Trx.' a')
			->join(self::Mhs.' b','a.id_mahasiswa=b.id')
			->join(self::Pel.' c','a.id_matakuliah=c.id')
			->where('a.id', $value)
			->get();	
		}


	}
?>