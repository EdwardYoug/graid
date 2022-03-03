<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'id',
        'title',
    ];
    use HasFactory;

    public function blog()
    {
        return $this->hasMany(Blog::class, 'city', 'id');
    }

    public function excursion()
    {
        return $this->hasMany(Excursion::class, 'city', 'id');
    }
}
