<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
        'status',
        'nominated_person',
        'date_of_creation',
    ];

    protected $casts = [
        'date_of_creation' => 'datetime',
    ];
}
