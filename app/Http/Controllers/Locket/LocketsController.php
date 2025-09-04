<?php

namespace App\Http\Controllers\Locket;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
use App\Models\Queues;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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
                $calling->save();

                // 2. Find the Locket record.
                $locket = Lockets::findOrFail($locket_id);
                $locket->queus_lockets()->attach($que_id);
            }
            return response()->json(['res' => 'succes']);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
