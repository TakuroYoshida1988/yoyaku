<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Fillable attributes for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_shop_manager',
        'email_verified_at'
   
    ];

    /**
     * Attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_shop_manager' => 'boolean',
    ];

    // リレーション: ユーザーは複数のお気に入りを持つ
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // リレーション: ユーザーが管理している複数の店舗
    public function managedShops()
    {
        return $this->hasMany(Shop::class, 'manager_id');
    }

    // is_admin アクセサ
    public function getIsAdminAttribute($value)
    {
        return (bool) $value;
    }

    // is_store_manager アクセサ
    public function getIsStoreManagerAttribute($value)
    {
        return (bool) $value;
    }
}