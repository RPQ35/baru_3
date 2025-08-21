<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Running_text extends Model
{

    protected $table = 'running_texts';
    protected $fillable = [
        'texts',
        'status',
    ];
}
