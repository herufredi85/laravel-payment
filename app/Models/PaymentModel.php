<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PaymentModel extends Model
{
    use HasFactory;

    public function updatepayment($vpayment_reference,$vtotal_payment) {
        $ldate = date('Y-m-d H:i:s');
        $vstatus=1;
        $data = DB::update('update payment set status=?,datepayment=? where payment_reference=? and totalpayment=?', [$vstatus,$ldate,$vpayment_reference,$vtotal_payment]);
        return $data;
    }

    public function ceksession($viduser,$vsession) {
        $data = DB::select('select count(1) as kon from users where iduser=? and session=? ', [$viduser,$vsession]);
        foreach ($data as $dus) {
            $kon = $dus->kon;
        }
        return $kon;
    }

    public function selectvpayment_reference($vpayment_reference) {

        $data = DB::select('select * from payment where payment_reference=?', [$vpayment_reference]);


        return $data;
    }

   
}
