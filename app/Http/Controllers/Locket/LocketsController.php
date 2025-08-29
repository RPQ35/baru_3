<?php

namespace App\Http\Controllers\Locket;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
use App\Models\Queues;
use Illuminate\Auth\Events\Validated;
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
        $ids = session('locket');
        $locket = Lockets::findOrFail(session('locket'));
        $serviceIds = $locket->services->pluck('id');

        $QueuesDone = Queues::whereIn('services_id', $serviceIds)
            ->where('status', 'done')
            ->get();

        $QueuesComing = Queues::whereIn('services_id', $serviceIds)
            ->where('status', '!=', 'done')
            ->get();

        $QueuesActive = Queues::whereIn('services_id', $serviceIds)
            ->where('is_called', '1')
            ->with([
                'que_locket' => function ($query) use ($ids) {
                    $query->where('locket_id', $ids);
                }
            ])
            ->get();


        return view('locket.main_locket', compact(
            'QueuesDone',
            'QueuesComing',
            'QueuesActive',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
