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
        $servi = Services::all();
        return view('admin.services.index_services', compact('servi'));
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
            'services_name' => ['required', 'unique:services,services_name', new HtmlSpecialChars],
            'code' => ['required', 'string', 'min:1', new HtmlSpecialChars],
            'logo' => 'nullable|image|mimes:jpeg,jpg,png',
            'input_label'   => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $logo_path = $request->file('logo')->store('logo', 'public');
        }

        Services::create([
            'services_name' => $request->input('services_name'),
            'code' => $request->input('code'),
            'logo_path' => $logo_path ?: '',
            'input_label'   => $request->input('input_label'),
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
    public function update(Request $request)
    {
        $request->validate([
            'services_name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $service = Services::findOrFail($request->id);
        $service->services_name = $request->services_name;
        $service->code = $request->code;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $service->logo_path = $path;
        }

        $service->save();

        return redirect()->route('services.index')
            ->with('success', 'Service berhasil diupdate');
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
