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
	}
?>