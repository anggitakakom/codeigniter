<?php
	/**
	 * summary
	 */
	class Detail_transaksis extends CI_Model
	{
	    /**
	     * summary
	     */
	    const DET = 'detail_transaksi';
	    public function __construct()
	    {
			parent::__construct();	        
	    }

	    // ini untuk insert multi array
	    public function insert($value){
	    	$this->db->insert_batch(self::DET, $value);
	    	return $this->db->affected_rows();
	    }

	    //melihat jumlah masuswa yang mengambil matakuliah berdasarkan id mahasiswa
	    public function get_detail_one($id_transaksi){

	    }

	    

	}
?>