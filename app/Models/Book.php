<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['start_session', 'end_session', 'bill', 'payment', 'car_id', 'bay_id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function bay()
    {
        return $this->belongsTo(Bay::class);
    }
}
