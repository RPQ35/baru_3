<?php

namespace App\Livewire;

use App\Models\Lockets;
use App\Models\Queues;
use Carbon\Carbon;
use Livewire\Component;

class LocketActive extends Component
{
    public function render()
    {
        $ids = session('locket');
        $locket = Lockets::findOrFail(session('locket'));
        $serviceIds = $locket->services->pluck('id');



        $QueuesActive = Queues::whereIn('services_id', $serviceIds)
            ->where('is_called', 1)
            ->whereDate('updated_at', Carbon::today())
            ->whereHas('queues_lockets', function ($query) use ($ids) {
                $query->where('locket_id', $ids);
            })
            ->get();


        return view('livewire.locket-active', compact('QueuesActive'));
    }
}
