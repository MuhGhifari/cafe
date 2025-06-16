<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders(){
        return $this->hasMany('App\Models\Order', 'user_id');
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

    public function InvoiceList(){
        return $this->orders()->where('invoice', '!=', '');
    }

    public function favorites(){
        return $this->hasMany('App\Models\Favorite', 'user_id');
    }
}
