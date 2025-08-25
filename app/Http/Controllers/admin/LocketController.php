<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lockets;
use App\Models\LocketServices;
use App\Models\Loket;
use App\Models\Services;
use App\Rules\HtmlSpecialChars;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class LocketController extends Controller
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
                'name'=>$locket->name,
                'service'=> $locket->services->toArray()
            ];
        }
        // dd($data);
        return view('admin.locket.index_locket', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services_list = Services::all();
        return view('admin.locket.new_locket', compact('services_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', new HtmlSpecialChars],
            // 'services' => 'required',
        ]);

        $newlocket = Lockets::create([
            'name' => $request->name,
        ]);
        foreach ($request->services as $item) {
            $newlocket->services()->attach($item);
        }
        return back();
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
