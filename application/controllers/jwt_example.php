<?php
    require APPPATH . '/libraries/REST_Controller.php';
    require APPPATH . '/libraries/ImplementJwt.php';
    //link yang menuju implementJWT untuk melakukan decode dan encode terhadap data
class jwt_example extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->JWt = new ImplementJwt();
        //mengambil impementJWt diubah menjadi JWt
    }
    public function token_get()
    {
            $tokenData['uniqueId'] = '467';
            $tokenData['role'] = 'anggit';
            $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
            $jwtToken = $this->JWt->GenerateToken($tokenData);
            //GenerateToken yang menuju ke ImplementJwt
            echo json_encode(array('Token'=>$jwtToken));
            //tokenData merupaka data yang akan diencode menggunakan jwt 
         }

    public function index_get()
    {
    // echo 'aggit token';
    $received_Token = $this->input->request_headers('');
            //request header bawaan untuk mengambil dari headers
        try
            {
            $jwtData = $this->JWt->DecodeToken($received_Token['Token']);
            //token harus sesuai dengan nama uang di headers
            echo json_encode($jwtData);
            //dilakukan encode untuk menampilkan
            }

            catch (Exception $e)
            {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
            }
    }
}