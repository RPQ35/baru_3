<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class configuration extends Model
{


    protected $table = 'configurations';
    protected $fillable = [
        'option',
        'swicth',
    ];
}
