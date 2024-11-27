<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Shopモデルとのリレーション
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}