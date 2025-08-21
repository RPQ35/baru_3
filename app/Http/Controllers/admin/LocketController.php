<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
use App\Models\LocketServices;
use App\Models\Loket;
use Illuminate\Http\Request;

class LocketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use the correct relationship name 'services'
        $lockets = Lockets::with('services')->get();

        $data = [];
        foreach ($lockets as $locket) {
            $data[] = [
                $locket->name => $locket->services->toArray()
            ];
        }
        return view('admin.locket.index_locket');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locket.new_locket');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $newlocket=Lockets::create([
            'name'=>$request->name,
        ]);
        $newlocket->services()->attach($request->services);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
