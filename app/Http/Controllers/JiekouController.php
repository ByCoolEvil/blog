<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class JiekouController extends Controller
{
    //
    public function index(){
        $_GET['user_name'];
        $_GET['id'];
        $rand='user_name'.rand(111111,999999).'liqiaomeng';
        $arr = [
            'error' =>0,
            'msg'=> $rand
        ];
        $json_Data=json_encode($arr);
        return $json_Data;
       }
}
