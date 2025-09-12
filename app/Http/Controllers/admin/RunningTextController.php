<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Running_text;
use App\Rules\HtmlSpecialChars;
use Illuminate\Http\Request;

class RunningTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Running_text::all();
        return view('admin.running_text.index_text', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.running_text.new-text');
    }


    public function status(Request $request)
    {
        $query = Running_text::findOrFail($request->id);
        $query->update(['status' => $request->status]);

        return response()->json();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'text' => ['required', 'string', new HtmlSpecialChars()]
        ]);

        $a = Running_text::create([
            'texts' => $request->text,
            'status' => '0',
        ]);

        if ($a) {
            return back()->with('succes', true);
        }
        return back()->with('succes', 0);
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
    public function update(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'id' => 'required',
        ]);
        $hasData = Running_text::findOrFail($request->id);

        if ($hasData) {
            $update = Running_text::findOrFail($request->id);
            $update->texts = $request->text;
            $update->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
