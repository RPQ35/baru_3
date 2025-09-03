<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Rules\HtmlSpecialChars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('temporary_path')) {
            Storage::disk('public')->delete(session('temporary_path'));
            session(['temporary_path' => null]);
        }
        session(['temporary_path' => null]);
        $servi = Services::all();
        return view('admin.services.index_services', compact('servi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('temporary_path')) {
            Storage::disk('public')->delete(session('temporary_path'));
            session(['temporary_path' => null]);
        }
        session(['temporary_path' => null]);
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
        ]);

        if (session('temporary_path')) {
            $logo_path = pathinfo(session('temporary_path'), PATHINFO_BASENAME);
            if (Storage::disk('public')->exists(session('temporary_path'))) {
                Storage::disk('public')->move('templogos/' . $logo_path, 'logo/' . $logo_path);
            }
        }

        Services::create([
            'services_name' => $request->input('services_name'),
            'code' => $request->input('code'),
            'logo_path' => 'logo/'.$logo_path ?: '',
        ]);
        return back();
    }

    /**
     * for temporary logo ( show the file when upload before actualy insert to db)
     * use js
     */
    public function temp_logo(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);
        if ($request->hasFile('logo')) {
            // dd($request);
            $path = $request->file('logo')->store('templogos', 'public');


            session(['temporary_path' => $path]);
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
        ]);

        $service = Services::findOrFail($request->id);
        $service->services_name = $request->services_name;
        $service->code = $request->code;

        if (session('temporary_path')) {
            $logo_path = pathinfo(session('temporary_path'), PATHINFO_BASENAME);
            if (Storage::disk('public')->exists(session('temporary_path'))) {
                Storage::disk('public')->move('templogos/' . $logo_path, 'logo/' . $logo_path);
            }
            $service->logo_path = 'logo/'.$logo_path;
        }

        $service->save();

        return back()->with('success', 'Service berhasil diupdate');
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
