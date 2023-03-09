<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalAccount extends Model
{
    use HasFactory;

    protected $table = 'final_accounts';

    public function levelThree(){
        return $this->belongsTo(LevelThree::class,'level_three_id','id');
    }
    public function vouchers(){
        return $this->hasMany(VoucherDetail::class,'final_account_id','id');
    }
    public function get_account()
    {
        return $this->belongsTo(LevelThree::class,'level_three_id','id');
    }
}
