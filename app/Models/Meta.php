<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $table = 'meta';
    protected $fillable = [
        'id',
        'owner_type',
        'owner_id',
        'key',
        'value',
    ];

    public function owner()
    {
        return $this->morphTo();
    }
}
