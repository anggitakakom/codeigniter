 <?php
require APPPATH . '/libraries/JWT.php';


class ImplementJwt
{
    PRIVATE $key = "Anggit_Putra";
    //key untuk menambah generate token
    public function GenerateToken($data)
    {          
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
        //proses untuk meng enkrip data
    }
    


   //////This function decode the token//////////////////// 
    public function DecodeToken($token)
    {          
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
        //proses untuk mengurai data dengan decode
    }
}
?> 