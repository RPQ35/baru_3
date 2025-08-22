<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocketServices extends Model
{
    //
    protected $table = 'locket_services';
    protected $fillable = [
        'locket_id',
        'services_id',
    ];
}
