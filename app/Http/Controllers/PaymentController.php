<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PaymentModel;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->PaymentModel = new PaymentModel();
    }
    public function CreceivePayment(Request $request)
    {

        $data=[];
        try {
            $validator = validator::make($request->all(), [
                'payment_reference' => 'required',
                'total_payment' => 'required',
                'viduser' => 'required',
                'vsession' => 'required',
            ]);

            if ($validator->fails()) {
                $rc="89";
                $rcdesc=$validator->errors();
                $http=Response::HTTP_UNPROCESSABLE_ENTITY;
            }else{
                $viduser=$request->post('viduser');
                $vsession=$request->post('vsession');
                if($this->PaymentModel->ceksession($viduser,$vsession)>0){
                    $total_payment=$request->post('total_payment');
                    $payment_reference=$request->post('payment_reference');
                    $rcdesc = $this->PaymentModel->updatepayment($payment_reference,$total_payment);
                    if($rcdesc =='1'){
                        $rc="00";
                        $rcdesc='success';
                        $data=$this->PaymentModel->selectvpayment_reference($payment_reference);
                    }else{
                        $rc="88";
                        $rcdesc='unsuccessful';
                    }
                }else{
                    $rc="79";
                    $rcdesc="not authentication user";
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
}
