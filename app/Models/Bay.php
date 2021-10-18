<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bay extends Model
{
    use HasFactory;
    protected $fillable = ['bay_code', 'status'];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
