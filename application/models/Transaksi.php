<?php
	/**
	 * 
	 */
	class Transaksi extends CI_Model
	{
		const Trx = 'transaksis';

		function __construct()
		{
			parent:: __construct();
		}

		public function insert($value){
			$this->db->insert(self::Trx, $value);
			return $this->db->affected_rows();
		}

		public function get_all(){
			return $this->db->select('*')
			->from(self:: Trx)
			->get();
		}

		public function get_one($value){
			return $this->db->select('*')
			->from(self::Trx)
			->where('id', $value)
			->get();

		}

		public function edit($value, $isi){
			$this->db->where('id', $value)
			->update(self::Trx, $isi);
		}

		public function delete($value){
			$this->db->where('id', $value)
			->delete(self::Trx);
		}
	}
?>