<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class queues_locket extends Model
{
    protected $table = "queues_locket";

    protected $fillable = [
        'queues_id',
        'locket_id',
    ];
}
