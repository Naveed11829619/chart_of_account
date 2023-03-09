<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelThree extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'level_threes';

    public function subAccount(){
        return $this->belongsTo(SubAccount::class,'sub_account_id','id');
    }
    public function finalAccount(){
        return $this->hasMany(FinalAccount::class,'level_three_id','id');
    }
    public function get_sub_accounts()
    {
        return $this->hasMany(FinalAccount::class, 'level_three_id','id');
    }
}

