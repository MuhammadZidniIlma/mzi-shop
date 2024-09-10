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
}