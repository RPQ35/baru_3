<?php

namespace App\Livewire;

use App\Models\Lockets;
use App\Models\Queues;
use Carbon\Carbon;
use Livewire\Component;

class LocketOncoming extends Component
{

    public function render()
    {

        $ids = session('locket');
        $locket = Lockets::findOrFail(session('locket'));
        $serviceIds = $locket->services->pluck('id');

        $QueuesComing = Queues::whereIn('services_id', $serviceIds)
        ->where('status', '!=', 'done')
        ->where('is_called',0)
        ->whereDate('updated_at',Carbon::today())
        ->get();

        return view('livewire.locket-oncoming',compact('QueuesComing'));
    }
}
