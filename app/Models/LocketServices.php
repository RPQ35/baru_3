<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocketServices extends Model
{

    protected $table = 'lockets_services';
    protected $fillable = [
        'lockets_id',
        'services_id',
    ];
}
