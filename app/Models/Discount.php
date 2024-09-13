<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //hubungkan ke order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function bannerDiscounts()
    {
        return $this->hasMany(BannerDiscount::class);
    }

    public function scopeUpdateStatuses($query)
    {
        $query->each(function ($discount) {
            if ($discount->start_date <= now() && $discount->expiration_date >= now()) {
                $discount->status = 'active';
            } else {
                $discount->status = 'inactive';
            }
            $discount->save();
        });
    }
}
