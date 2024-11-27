<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'reservation_date',
        'number_of_people',
        'course_name', // course_nameだけを許可
    ];

    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // 予約が来店済みかどうかを判定するメソッド
    public function isVisited()
    {
        $reservationTime = Carbon::parse($this->reservation_date);
        return Carbon::now()->greaterThan($reservationTime->addHour());
    }
}