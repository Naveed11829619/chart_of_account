<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintView extends Model
{
    use HasFactory;

    public function voucherDetails(){
        return $this->hasMany(VoucherDetail::class,'voucher_id','id');
    }
}
