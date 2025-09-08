<?php

namespace App\Livewire;

use App\Models\Lockets;
use App\Models\Queues;
use Carbon\Carbon;
use Livewire\Component;

class LocketOutCome extends Component
{
    public function render()
    {
        $ids = session('locket');
        $locket = Lockets::findOrFail($ids);
        $serviceIds = $locket->services->pluck('id');

        $QueuesDone = Queues::whereIn('services_id', $serviceIds)
            ->where('status', ['end', 'cancled'])
            ->where('is_called', 0)
            ->with([
                'queues_lockets' => function ($query) use ($ids) {
                    $query->where('locket_id', $ids);
                }
            ])
            // ->where('status', 'done')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        return view('livewire.locket-out-come', compact('QueuesDone',));
    }
}
