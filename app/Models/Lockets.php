<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lockets extends Model
{
    protected $table = 'lockets';
    protected $fillable = [
        'name',
    ];

    // app/Models/Locket.php
    public function services()
    {
        return $this->belongsToMany(Services::class);
    }
    // In Locket.php
    public function locketservices()
    {
        return $this->hasMany(LocketServices::class, 'locket_id');
    }
    public function queus_lockets()
    {
        return $this->belongsToMany(Queues::class, 'queues_locket', 'locket_id', 'queues_id');
    }
}
