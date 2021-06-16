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

    public function getCustomizeDateAttribute($date)
    {
        $timestamp = strtotime($this->created_at);
        $day = date('F d, Y', $timestamp);
        return $day;
    }
}
