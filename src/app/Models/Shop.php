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

    public function reviews()
   {
      return $this->hasMany(Review::class);
   }

   public function getAverageRatingAttribute()
   {

    // 口コミがない場合は0を返す
    if ($this->reviews()->count() === 0) {
        return 0;
    }

    // 平均★数を計算
    return round($this->reviews()->avg('rating'), 1); // 小数第1位まで表示

   }

}