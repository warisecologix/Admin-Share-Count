<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_no',
        'phone_code',
        'phone_otp',
        'phone_no_verify',
        'email_verify',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getTotalSharesAttribute()
    {
        return Stock::where('user_id', $this->id)->get()->sum('no_shares_own');
    }

    public function getVerifySharesAttribute()
    {
        return Stock::where('user_id', $this->id)->where('admin_verify', 1)->get()->sum('no_shares_own');
    }

    public function getUnVerifySharesAttribute()
    {
        return Stock::where('user_id', $this->id)->where('admin_verify', 0)->get()->sum('no_shares_own');
    }
}
