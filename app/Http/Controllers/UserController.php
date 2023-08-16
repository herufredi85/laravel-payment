<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    public function Ciregister(Request $request)
    {
      
        $data=[];
        try {
            $validator = validator::make($request->all(), [
                'vname' => 'required',
                'vemail' => 'required|email',
                'vpass' => 'required'
            ]);
            if ($validator->fails()) {
                $rc="89";
                $rcdesc=$validator->errors();
                $http=Response::HTTP_UNPROCESSABLE_ENTITY;
            }else{
                $vname=$request->post('vname');
                $vemail=$request->post('vemail');
                $vpass=md5($request->post('vpass'));
                $rcdesc = $this->UserModel->iregister($vname,$vemail,$vpass);
                if($data =='success'){
                    $rc="00";
                }else{
                    $rc="88";
                }

                $http=Response::HTTP_OK;

            }
          
            $response = [
                "rc" => $rc,
                "rcdesc" => $rcdesc,
                "data" => $data
            ];
            return response()->json($response, $http);
        } catch (QueryException $e) {
            $error = [
                "rc" => "99",
                "rcdesc" => $e->getMessage(),
                "data" => $data
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function Clogin(Request $request)
    {
      
        $data=[];
        try {
            $validator = validator::make($request->all(), [           
                'vemail' => 'required|email',
                'vpass' => 'required'
            ]);
            if ($validator->fails()) {
                $rc="89";
                $rcdesc=$validator->errors();
                $http=Response::HTTP_UNPROCESSABLE_ENTITY;
            }else{
                $vemail=$request->post('vemail');
                $vpass=md5($request->post('vpass'));
                $data = $this->UserModel->selectemailpass($vemail,$vpass);

                if(count($data)>0){
                    $rc="00";
                    foreach ($data as $dus) {
                        $viduser = $dus->iduser;
                        $vsess=$this->UserModel->sess($viduser);
                    }
                    $this->UserModel->updatesess($viduser,$vsess) ;
                    $data = $this->UserModel->selectemailpass($vemail,$vpass);
                    $rcdesc='success';
                }else{
                    $rc="88";
                    $rcdesc='wrong user or password';
                }

                $http=Response::HTTP_OK;

            }
          
            $response = [
                "rc" => $rc,
                "rcdesc" => $rcdesc,
                "data" => $data
            ];
            return response()->json($response, $http);
        } catch (QueryException $e) {
            $error = [
                "rc" => "99",
                "rcdesc" => $e->getMessage(),
                "data" => $data
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function Clogout(Request $request)
    {
      
        $data=[];
        try {
            $validator = validator::make($request->all(), [           
                'viduser' => 'required',
                'vsess' => 'required'
            ]);
            if ($validator->fails()) {
                $rc="89";
                $rcdesc=$validator->errors();
                $http=Response::HTTP_UNPROCESSABLE_ENTITY;
            }else{
                $viduser=$request->post('viduser');
                $vsess=$request->post('vsess');
                $data = $this->UserModel->updatelogout($viduser,$vsess);
                if($data=='success'){
                    $rc="00";
                }else{
                    $rc="99";
                }
                $rcdesc=$data;
                $http=Response::HTTP_OK;

            }
          
            $response = [
                "rc" => $rc,
                "rcdesc" => $rcdesc,
                "data" => $data
            ];
            return response()->json($response, $http);
        } catch (QueryException $e) {
            $error = [
                "rc" => "99",
                "rcdesc" => $e->getMessage(),
                "data" => $data
            ];
            return response()->json($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
