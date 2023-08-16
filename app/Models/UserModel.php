<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class UserModel extends Model
{
    use HasFactory;

    public function iregister($vname,$vemail,$vpass) {
        $ldate = date('Y-m-d H:i:s');
        
       if($this->cekcountuser($vemail)==0){
            $queryState = DB::select('insert into users (name,email,password,dateregister) value(?,?,?,?)', [$vname,$vemail,$vpass,$ldate]);
            $data="success";
       }else{
            $data="username already";
       }
        
       
        return $data;
    }

    public function cekcountuser($vemail) {
        $queryState = DB::select('select count(1) as kon from users where email=?', [$vemail]);
        foreach ($queryState as $dus) {
            $kon = $dus->kon;
        }
        return $kon;
    }

    public function updatesess($viduser,$vsess) {
        $ldate = date('Y-m-d H:i:s');
        $queryState = DB::update('update users set session=?,datelogin=? where iduser=?', [$vsess,$ldate ,$viduser]);
        return $queryState;
    }

    public function sess($viduser) {
        $ldate = date('Y-m-d H:i:s');
        $q=sha1($viduser.$ldate);
        return $q;
    }

    public function selectemailpass($vemail,$vpassword) {
        $data = DB::select('select * from users where email=? and password=? ', [$vemail,$vpassword]);
        return $data;
    }

    public function updatelogout($viduser,$vsess) {
        $ldate = date('Y-m-d H:i:s');
        $queryState = DB::update('update users set session=NULL,datelogout=? where iduser=? and session=?', [$ldate ,$viduser,$vsess]);
        $data="success";
        return $data;
    }
    
}
