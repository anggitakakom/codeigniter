<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//pwnggunaan AuthLogin Codeigniter yang ditambahkan dan diedit
// - Cotroler Authenticate
// - model user
 
// - config/rest
//     * $config['rest_enable_keys'] = FALSE; DIUBAH $config['rest_enable_keys'] = TRUE;
//     * $config['rest_auth'] = FALSE; DIUBAh  $config['rest_auth'] = 'basic';
//     * $config['auth_source'] = 'ldap'; DIUBAH $config['auth_source'] = '';

// -config/Routes penambahan kode program
// $route['api/authentication/login'] = 'api/authentication/login';
// $route['api/authentication/registration'] = 'api/authentication/registration';
// $route['api/authentication/user/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/authentication/user/id/$1/format/$3$4';


// untuk melakukan ujicoba via postman dengan menggunakan
// - Autorozation
//     * basic auth
//         *username dan password = admin/1234
//         * sesuai yang terletak dalam config/rest = $config['rest_valid_logins'] = ['admin' => '1234'];
//     *Header 
//         * sesuai yang terletak dalam config/rest = $config['rest_key_name'] = 'X-API-KEY';
//         * untuk X-API-KEY sesuai dengan database anggit / keys = key
//     * untuk lainya sesuai dengan biasanya


// mengambil rest controler untuk menggunaka api 
require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        //untuk mengambil model user agar bisa saling berhubungan
        $this->load->model('user');
    }
    
    public function login_post() {
        //memasukkan email dan password untuk login
        $email = $this->post('email');
        $password = $this->post('password');
        
        //validasi data email dan password apakah berisi dan tidaknya
        if(!empty($email) && !empty($password)){
            
            
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => md5($password),
                'status' => 1
            );
            //password dikonverter ke md 5
            $user = $this->user->getRows($con);
            //ini yang selalu dipakai untuk pengecekan data user dapakah ad ayang sama
            
            if($user){
                //ketika login berhasil akan dilakukan respon disini
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                //jika tidak berhasil login
                $this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //memasukkan email dan password
            $this->response("Provide email and password.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function registration_post() {
        $first_name = strip_tags($this->post('first_name'));
        $last_name = strip_tags($this->post('last_name'));
        $email = strip_tags($this->post('email'));
        $password = $this->post('password');
        $phone = strip_tags($this->post('phone'));
        //melakukan registrasi data untuk tanggal secara otomatis didalam databse
        
        // Validasi registrasi
        if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)){
            
            //pengecekan email apakah ada yang sama
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'email' => $email,
            );
            $userCount = $this->user->getRows($con);
            
            if($userCount > 0){
                //jika email saya akan direspon
                $this->response("The given email already exists.", REST_Controller::HTTP_BAD_REQUEST);
            }else{
                //jika tidak ada yang sama maka data akan di simpan
                $userData = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => md5($password),
                    'phone' => $phone
                );
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->response([
                        'status' => TRUE,
                        'message' => 'The user has been added successfully.',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }else{
            $this->response("Provide complete user info to add.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function user_get($id = 0) {
        //untuk mengambil 1 data pengguna untuk menampilkan datanya
        $con = $id?array('id' => $id):'';
        $users = $this->user->getRows($con);
        
        if(!empty($users)){
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function user_put() {
        $id = $this->put('id');
        $first_name = strip_tags($this->put('first_name'));
        $last_name = strip_tags($this->put('last_name'));
        $email = strip_tags($this->put('email'));
        $password = $this->put('password');
        $phone = strip_tags($this->put('phone'));
        
        if(!empty($id) && (!empty($first_name) || !empty($last_name) || !empty($email) || !empty($password) || !empty($phone))){
            $userData = array();
            if(!empty($first_name)){
                $userData['first_name'] = $first_name;
            }
            if(!empty($last_name)){
                $userData['last_name'] = $last_name;
            }
            if(!empty($email)){
                $userData['email'] = $email;
            }
            if(!empty($password)){
                $userData['password'] = md5($password);
            }
            if(!empty($phone)){
                $userData['phone'] = $phone;
            }
            $update = $this->user->update($userData, $id);
            //pengecekan update data apakah ada yang kosong atau tidak karena untuk
            //pengembalian data harus terisi semua
            if($update){
                $this->response([
                    'status' => TRUE,
                    'message' => 'The user info has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response("Provide at least one user info to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}