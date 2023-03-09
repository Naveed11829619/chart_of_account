<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoucherDetail extends Model
{
    use SoftDeletes;

    protected $table = 'voucher_details';

    public function voucher(){
        return $this->belongsTo(Voucher::class,'voucher_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function finalAccount(){
        return $this->belongsTo(FinalAccount::class,'final_account_id','id');
    }

}
