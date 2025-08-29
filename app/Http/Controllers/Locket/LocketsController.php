<?php

namespace App\Http\Controllers\Locket;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
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
        return view('locket.select_locket',compact('data'));
    }

    /**
     * main page
     */
      public function show(string $id)
    {
        return view('locket.main_locket');
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
