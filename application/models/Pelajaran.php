<?php
	/**
	 * 
	 */
	class Pelajaran extends CI_Model
	{
		const PELL = 'pelajarans';

		function __construct() {
			// call the parent constructor
			parent::__construct();
		}

		public function get_all() {
			return $this->db->select('*')
				->from(self::PELL)
				->get();
		}

		public function get_one($value){
			return $this->db->select('*')
			->from(self::PELL)
			->where('id', $value)
			->get();
		}

		public function insert($value){
			 $this->db->insert(self::PELL, $value);
			 return $this->db->affected_rows();
		}

		public function delete($value){
			$this->db->where('id', $value)
			->delete(self::PELL);
		}

		public function update($value, $isi){
			$this->db->where('id', $value)
			->update(self::PELL, $isi);
		}

	}
?>