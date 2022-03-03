<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';
    protected $fillable = [
        'id',
        'city',
        'title',
    ];

    public function meta()
    {
        return $this->morphMany(Meta::class, 'owner');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id', 'city');
    }
}
