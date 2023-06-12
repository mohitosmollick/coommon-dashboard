
<?php


use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Session;

class Auth{

    static function id(){
        return Session::get('id');
    }
    static function username(){
        $id=Session::get('id');
        $result= \App\Models\User::where('id',$id)->first();
        return $result->fname.' '.$result->lname;
    }
    static function user(){
        $id=Session::get('id');
        return \App\Models\User::where('id',$id)->first();
    }
    static function check(){
        return Session::get('user',true);
    }
    static function logout(){
        Session::put('Authorization','');
        return \session()->flush();
    }

    static function JWT($data){

        $key = '12345678';
        $payload = [
//       'iss' => $_SERVER['HOST_NAME'],
//       'aud' => $_SERVER['HOST_NAME'],
            'iat' => 1356999524,
            'nbf' => 1357000000,
            'exp' => '1h',

            'email'=>$data->email,
            'id'=>$data->id
        ];

        //Generate Token
        $jwt_token = JWT::encode($payload, $key, 'HS256');
        return $jwt_token;
    }

}
