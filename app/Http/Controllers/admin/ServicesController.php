<?php

namespace App\Http\Controllers\admin;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Rules\HtmlSpecialChars;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('temporary_path')) {//->delleting the session and temporary file
            Storage::disk('public')->delete(session('temporary_path'));
            session(['temporary_path' => null]);
        }
        session(['temporary_path' => null]);//->delete session

        $servi = Services::all();
        return view('admin.services.index_services', compact('servi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('temporary_path')) {//->delleting the session and temporary file
            Storage::disk('public')->delete(session('temporary_path'));
            session(['temporary_path' => null]);
        }
        session(['temporary_path' => null]);//->delete the session
        return view('admin.services.new_services');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'services_name' => [
                'required',
                'unique:services,services_name',
                new HtmlSpecialChars
            ],

            'code' => [
                'required',
                'string',
                'min:1',
                new HtmlSpecialChars
            ],
            'input_label'   => 'nullable|string|max:255',
        ]);

        if (session('temporary_path')) {

            $logo_path = pathinfo(session('temporary_path'), PATHINFO_BASENAME);//->get the file name

            if (Storage::disk('public')->exists(session('temporary_path'))) {//->check data in sesion is exist
                Storage::disk('public')->move('templogos/' . $logo_path, 'logo/' . $logo_path);//->move the file to fix location
            }
        }

        Services::create([
            'services_name' => $request->input('services_name'),
            'code' => $request->input('code'),
            'input_label'=>$request->input_label,
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
        if (session('temporary_path')) {//->delleting the session and temporary file
            Storage::disk('public')->delete(session('temporary_path'));
            session(['temporary_path' => null]);
        }

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasFile('logo')) {

            $path = $request->file('logo')->store('templogos', 'public');//->save temporary file

            session(['temporary_path' => $path]);//->save to session for storing the data

            return response()->json([
                'url' => asset('storage/' . $path)//->retrun file route for displaying
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

        // ==== update the data ==========================
        $service = Services::findOrFail($request->id);
        $service->services_name = $request->services_name;
        $service->code = $request->code;

        // ==== update file logo ==========================
        if (session('temporary_path')) {//->check if file already upload and saved in session
            $logo_path = pathinfo(session('temporary_path'), PATHINFO_BASENAME);//->get file name

            if (Storage::disk('public')->exists(session('temporary_path'))) {//->check file from session exist
                Storage::disk('public')->move('templogos/' . $logo_path, 'logo/' . $logo_path);//move file to main folder
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
