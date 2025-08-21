<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Rules\HtmlSpecialChars;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Services::all();
        return view('admin.services.index_services', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.new_services');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'services_name' => ['required|unique:services,services_name|', new HtmlSpecialChars],
            'code' => ['required|min:1|string', new HtmlSpecialChars],
            'logo' => 'image|mimes:jpeg,jpg,png',
        ]);

        $logo_path = $request->file('logo')->store('logo', 'public');

        Services::create([
            'services_name' => $request->input('services_name'),
            'code' => $request->input('code'),
            'logo_path' => $logo_path,
        ]);
        return back();

    }

    /**
     * for temporary logo ( show the file when upload before actualy insert to db)
     * use js
     */
    public function temp_logo(Request $request)
    {
        if ($request->hasFile('file')) {
            // dd($request);
            $path = $request->file('file')->store('temp-logos', 'public');


            session()->put('temporary_path', 'storage' . $path);
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
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
        $input = Services::findOrFail($id);
        $input->delete();
        return back();
    }
}
