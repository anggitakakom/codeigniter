<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
    
        $this->load->database();
        //mengaitkan database tabel yang dipakai users
        $this->userTbl = 'users';
    }
    //untuk melakukan pengecekan terhadap data dari tabel user
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userTbl);   
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }
        return $result;
    }
    
    /*
     * Insert user data
     */
    public function insert($data){
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        //untuk memasukkan data ke tabel user
        $insert = $this->db->insert($this->userTbl, $data);
        return $insert?$this->db->insert_id():false;
    }
    
    /*
     * Update user data
     */
    public function update($data, $id){
        if(!array_key_exists('modified', $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        $update = $this->db->update($this->userTbl, $data, array('id'=>$id));
        return $update?true:false;
    }
    
    /*
     * Delete user data
     */
    public function delete($id){
        $delete = $this->db->delete('users',array('id'=>$id));
        return $delete?true:false;
    }

}