<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datamodel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function data(){
		$pegawai = array(
			'Nama' => 'anggita',
			'Bidang' => 'TI', 

		);
		return $pegawai;
	}	

}

/* End of file datamodel.php */
/* Location: ./application/models/datamodel.php */