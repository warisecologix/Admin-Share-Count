<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStockLogs extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function stock(){
        return $this->belongsTo(Stock::class);
    }
}
