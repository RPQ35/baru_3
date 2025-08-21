<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    protected $table = 'services';

    protected $fillable = [
        'services_name',
        'code',
        'logo_path',
    ];
    // app/Models/Service.php
    public function lockets()
    {
        return $this->belongsToMany(Lockets ::class);
    }
}
