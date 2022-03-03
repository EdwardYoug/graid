<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excursion extends Model
{
    use HasFactory;

    protected $table = 'excursion';
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
        return $this->belongsTo(City::class,'id','city');
    }
}
