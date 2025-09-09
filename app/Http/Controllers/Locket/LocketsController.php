<?php

namespace App\Http\Controllers\Locket;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
use App\Models\Queues;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use function Laravel\Prompts\progress;

class LocketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lockets = Lockets::with('services')->get();
        $data = [];
        foreach ($lockets as $locket) {
            $data[] = [
                'id' => $locket->id,
                'name' => $locket->name,
                'service' => $locket->services->toArray()
            ];
        }

        // dd($data);
        return view('locket.select_locket', compact('data'));
    }

    /**
     * proses
     */
    public function show(Request $request)
    {
        // dd($request);

        if (isset($request->select)) {
            $tes = $request->select;
            session(['locket' => $tes]);
            return redirect('/lockets/app');
        } else {
            session(['locket' => false]);
            return redirect('/lockets/select');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        try {
            $locket = Lockets::findOrFail(session('locket'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('logout');
        }
        return view('locket.main_locket');
    }

    /**
     * Update the specified resource in storage.
     */
    public function oncoming(Request $request)
    {
        $UpdateLibraray = [
            'new' => 'proggres',
            'proggres' => 'stage',
            'stage' => 'end',
            'end' => 'end',
        ];

        //id declare value
        $que_id = $request->val;
        $locket_id = session('locket');
        $serviceIds = Lockets::findOrFail($locket_id)->services->pluck('id');

        if (isset($request->BtnValue)) {
            if ($request->BtnValue == 'call') {
                /**
                 * un active the un-used
                 */
                $queuesInActive = Queues::whereIn('services_id', $serviceIds)
                    ->where('is_called', 1)
                    ->whereDate('updated_at', Carbon::today())
                    ->whereHas('queues_lockets', function ($query) use ($locket_id) {
                        $query->where('locket_id', $locket_id);
                    })
                    ->first();

                if ($queuesInActive) {
                    // Update the single model instance
                    $queuesInActive->update(['is_called' => 0]);

                    // Detach the locket_id from the single model instance
                    $queuesInActive->queues_lockets()->sync($locket_id);
                }



                // 1. Find and update the Queues record.
                $calling = Queues::findOrFail($que_id);
                $calling->is_called = true;
                $calling->status = $UpdateLibraray[$calling->status];
                $calling->save();

                // 2. Find the Locket record.
                $locket = Lockets::findOrFail($locket_id);
                $locket->queus_lockets()->attach($que_id);
            }
            return response()->json(['res' => 'succes']);
        }
        return response()->json(['error' => 'failed'], 400);
    }

    public function active(Request $request)
    {
        $UpdateLibraray = [
            'new' => 'proggres',
            'proggres' => 'stage',
            'stage' => 'end',
            'end' => 'end',
        ];

        $que_id = $request->val;
        $locket_id = session('locket');

        if (!isset($request->button)) {
            return redirect()->route('locket.app');
        }

        $queuesInActive = Queues::findOrFail($que_id);

        // Check for the existence of services before proceeding
        $locket = Lockets::findOrFail($locket_id);
        $serviceIds = $locket->services->pluck('id');

        switch ($request->button) {
            case 'recall':
                // Directly set is_called to 1, no need for redundant update calls.
                $queuesInActive->update(['is_called' => 0]);
                $queuesInActive->update(['is_called' => 1]);
                break;

            case 'next':
                // Deactivate the current queue and unsync it from the locket
                $queuesInActive->update(['is_called' => 0]);
                $queuesInActive->queues_lockets()->sync([]);

                // Find the next available queue
                $queuesActived = Queues::whereIn('services_id', $serviceIds)
                    ->where('id', '!=', $que_id)
                    ->whereDate('created_at', now()->today())
                    ->orderBy('updated_at', 'asc')
                    ->where('is_called', 0)
                    ->where('status', '!=', 'end')
                    ->first();

                if ($queuesActived) {
                    // Update the status and activate the found queue
                    $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                    $queuesActived->is_called = 1; // It's being called now
                    $queuesActived->save();

                    // Sync the newly active queue to the current locket
                    $queuesActived->queues_lockets()->sync($locket_id);
                } else {
                    // If no next queue is found, mark the current one as "end"
                    $queuesInActive->update(['status' => 'end', 'is_called' => 0]);
                }
                break;

            case 'skip':
                $skip = [
                    'new' => 'new',
                    'proggres' => 'new',
                    'stage' => 'proggres',
                    'end' => 'stage',
                ];

                // Deactivate the current queue and update its status
                $queuesInActive->is_called = 0;
                $queuesInActive->status = $skip[$queuesInActive->status];
                $queuesInActive->save();

                // Unsync the skipped queue from the locket
                $queuesInActive->queues_lockets()->sync([]);

                // Find the next available queue (logic is same as 'next' button)
                $queuesActived = Queues::whereIn('services_id', $serviceIds)
                    ->where('id', '!=', $que_id)
                    ->where('is_called', 0)
                    ->whereDate('created_at', now()->today())
                    ->orderBy('updated_at', 'asc')
                    ->where('status', '!=', 'end')
                    ->first();

                if ($queuesActived) {
                    // Activate the found queue and update its status
                    $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                    $queuesActived->is_called = 1;
                    $queuesActived->save();

                    // Sync the newly active queue to the locket
                    $queuesActived->queues_lockets()->sync($locket_id);
                } else {
                    // If no next queue is found, re-activate the current queue
                    $queuesInActive->update(['is_called' => 1]);
                    // Sync it back to the locket as it remains the active one
                    $queuesInActive->queues_lockets()->sync($locket_id);
                }
                break;
        }

        return redirect()->route('locket.app');
    }

    public function status(Request $request)
    {
        $UpdateLibraray = [
            'new' => 'proggres',
            'proggres' => 'stage',
            'stage' => 'end',
            'end' => 'end',
        ];

        $ids = session('locket');
        $locket = Lockets::findOrFail(session('locket'));
        $serviceIds = $locket->services->pluck('id');

        if ((isset($request->button)) && (isset($request->val))) {
            $difer = isset($request->difer) ? 1 : 0;
            $ReqStatus = $request->button;
            $que_id = $request->val;




            $query = Queues::whereIn('services_id', $serviceIds)
                ->where('is_called', $difer)
                ->whereDate('created_at', now()->today())
                ->orderBy('updated_at', 'asc')
                ->where('status', '!=', 'end');

            if ($difer) {
                $query->whereHas('queues_lockets', function ($query) use ($ids) {
                    $query->where('locket_id', $ids);
                });
            }
            $OtherQue = $query->first(); // Correct assignment here

            if ($OtherQue) {
                $OtherQue->status = !$difer ? $UpdateLibraray[$OtherQue->status] :  $OtherQue->status;
                $OtherQue->is_called = $OtherQue->status == 'end' ? 0 : !$difer;
                $OtherQue->save();
                $OtherQue->queues_lockets()->sync($ids);
            }

            $update = Queues::findOrFail($que_id);
            $update->status = $ReqStatus;
            $update->is_called = $ReqStatus == "end" ? 0 : $difer;
            $update->save();
            $update->queues_lockets()->sync($ids);
        }

        return redirect()->route('locket.app');
    }
}
