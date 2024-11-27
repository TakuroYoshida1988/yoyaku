<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'region_id', 'genre_id', 'description', 'image','manager_id'];

    // Regionモデルとのリレーション
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // Genreモデルとのリレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // リレーション: 店舗代表者を取得
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

}