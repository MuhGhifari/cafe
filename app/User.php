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

    protected $table = 'users';
    
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role' ,
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

    public function orders(){
        return $this->hasMany('App\Order', 'user_id');
    }

    public function waitingOrder(){
        return $this->orders()->where('status', '=', 'menunggu');
    }

    public function reservedOrders(){
        return $this->orders()->where('status', '=', 'diproses')->orderBy('updated_at', 'DESC');
    }

    public function finishedOrder(){
        return $this->orders()->where('status', '=', 'selesai');
    }

    public function favorites(){
        return $this->hasMany('App\Favorite', 'user_id');
    }
}
