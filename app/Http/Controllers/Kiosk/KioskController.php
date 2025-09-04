<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Queues;
use Carbon\Carbon;

class KioskController extends Controller
{
    public function index()
    {
        $servi = Services::all();
        return view('kiosk.index_kiosk', compact('servi'));
    }

    public function takeNumber(Request $request)
    {
        // Validasi
        $request->validate([
            'vehicle_number' => 'required|string',
            'services_id'    => 'required|exists:services,id',
            'locket_id'      => 'nullable|exists:lockets,id',
            'level_id'       => 'nullable|exists:levels,id',
        ]);

        // Ambil service terkait
        $service = Services::findOrFail($request->services_id);
        $prefix  = $service->code ?? 'Q'; // default prefix Q kalau kosong

        // Cari antrian terakhir untuk service ini (per hari)
        $lastQueue = Queues::where('services_id', $request->services_id)
            ->whereDate('dates', Carbon::today())
            ->orderBy('queues_number', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastQueue) {
            $lastNumber = intval(substr($lastQueue->queues_number, strlen($prefix)));
        }

        // Generate nomor baru (misal A001, A002, dst)
        $newNumber   = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $queueNumber = $prefix . $newNumber;

        // Simpan ke database
        $queue = Queues::create([
            'queues_number' => $queueNumber,
            'vehicle_number' => strip_tags($request->vehicle_number),
            'status'        => 'new',
            'call_status'   => 0,
            'is_called'     => 0,
            'dates'         => Carbon::today(),
            'services_id'   => $request->services_id,
            'locket_id'     => $request->locket_id ?? null,
            'level_id'      => $request->level_id ?? null,
        ]);


        // Redirect balik ke kiosk dengan pesan sukses
        return back()
            ->with('success', 'Nomor antrian Anda: ' . $queue->queues_number);
    }
}
