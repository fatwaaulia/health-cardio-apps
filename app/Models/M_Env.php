<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Env extends Model
{
    public function webName() {
        return 'Health Cardio Apps';
    }

   public function encode($id = null)
    {
        $v = (double)$id*7421952535.24;
        $encode = base64_encode($v);
        return str_replace('=','',$encode);
    }
    public function decode($id = null)
    {
        $v = base64_decode($id);
        $decode = (double)$v/7421952535.24;
        return str_replace('=','',$decode);
    }

    public function random($type, $length = null)
    {   
        if($type == 'alphanum') {
            for ($i=0; $i < 10; $i++) { 
                $char[] = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
        } elseif ($type == 'alpha') {
            for ($i=0; $i < 10; $i++) { 
                $char[] = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }
        } elseif ($type == 'numeric') {
            for ($i=0; $i < 10; $i++) { 
                $char[] = '1234567890';
            }
        } else {
            $char[] = '';
        }
        $str_char = preg_replace('/[^A-Za-z0-9\-]/', '', json_encode($char));
        $random = substr(str_shuffle($str_char), 0, $length);
        return $random;
    }

    public function slug($id)
    {
        $slug = strtolower(preg_replace('~[^\pL\d]+~u', '-', $id));
        return $slug;
    }

}
