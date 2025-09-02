<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queues extends Model
{

    protected $table = 'queues';

    protected $fillable = [
        'vehicle_number',
        'queues_number',
        'call_status',
        'is_called',
        'dates',
        'status',
        'services_id', // foreign key
        'locket_id',   // foreign key
    ];

    public function que_service()
    {
        return $this->belongsTo(Services::class, 'services_id');
    }
    public function que_locket()
    {
        return $this->belongsToMany(Lockets::class, 'que_locket');
    }

}
