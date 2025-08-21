<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Running_text;
use Illuminate\Http\Request;

class RunningTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $running_text = Running_text::all()->first();
        if (!$running_text) {
            $running_text = ' ';
        } else {
            $running_text = $running_text->texts;
        }
        return view('admin.video.index_video');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);
        $hasData = Running_text::whereNotNull('texts')
            ->where('texts', '!=', '')
            ->exists();

        if ($hasData) {
            $update = Running_text::findOrFail(1);
            $update->texts = $request->text;
            $update->save();
        } else {
            Running_text::create([
                'texts' => $request->text,
                'status' => '0',
            ]);
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
