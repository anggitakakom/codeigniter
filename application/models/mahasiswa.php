<?php
	/**
	 * 
	 */
	class Mahasiswa extends CI_Model
	{
		const MAHA = 'mahasiswas';

		function __construct()
		{
			parent:: __construct();
		}

		//insert data to database
		public function insert($value){
			$this->db->insert(self::MAHA, $value);
			return $this->db->affected_rows();
		}

		public function get_all(){
			return $this->db->select('*')
			->from(self:: MAHA)
			->get();
		}

		public function get_one($value){
			return $this->db->select('*')
			->from(self:: MAHA)
			->where('id', $value)
			->get();
			
		}

		public function edit($value){

		}

		//deleting gambar
		public function delete($value, $gm){
			$this->db->where('id', $value);
			//deleting gambar from folder by namefile and id
			unlink("uploads/".$gm);
			$this->db->delete(self::MAHA);
		}
	}
?>