<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lockets extends Model
{
    protected $table = 'lockets';
    protected $fillable = [
        'nama',
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
    public function queues()
    {
        return $this->belongsToMany(Queues::class, 'que_locket');
    }
}

