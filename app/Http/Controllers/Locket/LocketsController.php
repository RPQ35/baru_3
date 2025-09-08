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

        //id declare value
        $que_id = $request->val;
        $locket_id = session('locket');
        $serviceIds = Lockets::findOrFail($locket_id)->services->pluck('id');

        if (isset($request->button)) {
            if ($request->button == 'recall') {
                $ReCall = Queues::findOrFail($que_id);
                $ReCall->update(['is_called' => 0]);
                $ReCall->update(['is_called' => 1]);

            } elseif ($request->button == 'next') { //button option
                /**
                 * un active the un-used
                 */

                $queuesInActive = Queues::findOrFail($que_id);

                if ($queuesInActive) {
                    // Update the single model instance
                    $queuesInActive->is_called = 0;
                    $queuesInActive->save();
                    // Detach the locket_id from the single model instance
                    $queuesInActive->queues_lockets()->sync($locket_id);
                }

                //search next que
                $queuesActived = Queues::whereIn('services_id', $serviceIds)
                    ->where('id', '!=', $que_id)
                    ->where('is_called', 0)
                    ->where('status', '!=', 'end')
                    ->first();

                if ($queuesActived) { //update found row
                    $queuesActived->status == 'end'?$queuesActived->is_called=0:$queuesActived->is_called=1;
                    $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                    $queuesActived->save();

                } else {
                    if ($queuesInActive) { //if the active is the last , straight end que
                        $queuesInActive->update(['status' => 'end', 'is_called' => 0]);
                    }
                }
            } elseif ($request->button == 'skip') { //button option
                $update = Queues::findOrFail($que_id);
                if ($update) {
                    $skip = [
                        'new' => 'new',
                        'proggres' => 'new',
                        'stage' => 'proggres',
                        'end' => 'stage',
                    ];
                    $update->is_called = 0;
                    $update->status = $skip[$update->status];
                    $update->save();
                }
                $queuesActived = Queues::whereIn('services_id', $serviceIds)
                    ->where('id', '!=', $que_id)
                    ->where('is_called', 0)
                    ->where('status', '!=', 'end')
                    ->first();

                if ($queuesActived) { //update found row
                    $queuesActived->is_called = 1;
                    $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                    $queuesActived->save();
                } else {
                    if ($update) {
                        $update->update(['is_called' => 1]);
                    }
                }
            }
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

        //id declare value
        $que_id = $request->val;
        $locket_id = session('locket');
        $serviceIds = Lockets::findOrFail($locket_id)->services->pluck('id');
        $difer = false;

        if (isset($request->difer)) {
            $difer = true;
            $queuesInActive = Queues::whereIn('services_id', $serviceIds)
                ->where('is_called', 1)
                ->whereDate('updated_at', Carbon::today())
                ->where('status', '!=', 'end')
                ->whereHas('queues_lockets', function ($query) use ($locket_id) {
                    $query->where('locket_id', $locket_id);
                })
                ->first();

            if ($queuesInActive) {
                // Update the single model instance
                $queuesInActive->is_called = 0;
                $queuesInActive->save();
                // Detach the locket_id from the single model instance
                $queuesInActive->queues_lockets()->sync($locket_id);
            }
        }

        if ($request->button == 'proggres') { //button option
            $update = Queues::findOrFail($que_id);

            if ($update) {
                $update->status = 'proggres';
                $update->is_called = 0;
                $update->save();
            }

            $queuesActived = Queues::whereIn('services_id', $serviceIds)
                ->where('id', '!=', $que_id)
                ->where('is_called', 0)
                ->where('status', '!=', 'end')
                ->first();

            if ($queuesActived && !$difer) { //update found row
                $queuesActived->is_called = 1;
                $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                $queuesActived->save();
            } else {
                if ($update) {
                    $update->update(['is_called' => 1]);
                }
            }
        }

        if ($request->button == 'stage') { //button option
            $update = Queues::findOrFail($que_id);

            if ($update) {
                $update->status = 'stage';
                $update->is_called = 0;
                $update->save();
            }

            $queuesActived = Queues::whereIn('services_id', $serviceIds)
                ->where('id', '!=', $que_id)
                ->where('is_called', 0)
                ->where('status', '!=', 'end')
                ->first();

            if ($queuesActived && !$difer) { //update found row
                $queuesActived->is_called = 1;
                $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                $queuesActived->save();
            } else {
                if ($update) {
                    $update->update(['is_called' => 1]);
                }
            }
        }

        if ($request->button == 'end') { //button option
            $update = Queues::findOrFail($que_id);
            if ($update) {
                $update->status = 'end';
                $update->is_called = 0;
                $update->save();
            }

            $queuesActived = Queues::whereIn('services_id', $serviceIds)
                ->where('id', '!=', $que_id)
                ->where('is_called', 0)
                ->where('status', '!=', 'end')
                ->first();

            if ($queuesActived && !$difer) { //update found row
                $queuesActived->is_called = 1;
                $queuesActived->status = $UpdateLibraray[$queuesActived->status];
                $queuesActived->save();
            } else {
                if ($update) {
                    $update->update(['is_called' => 1]);
                }
            }
        }

        return redirect()->route('locket.app');
    }
}
