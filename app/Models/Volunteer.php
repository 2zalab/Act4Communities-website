<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'skills',
        'domains',
        'availability',
        'message'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'skills' => 'array', // Si vous souhaitez stocker les compétences sous forme de tableau
    ];

    // Vous pouvez ajouter des relations, des accessors, des mutators, etc., ici si nécessaire.
}
