<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Rules\HtmlSpecialChars;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();

        $page_count = User::count('name');
        // $page_count = strval($page_count ? ceil($page_count / 20) : 1);


        return view('admin.account.index_account', compact(
            'data',
            'page_count'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.account.new_account');
    }

    /**
     * Store a newly created resource in storage.
     **/
    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'min:3', new HtmlSpecialChars],
        'email' => ['required', 'email', 'unique:users,email', new HtmlSpecialChars],
        'password' => ['required',  new HtmlSpecialChars],
        'role' => ['required', 'exists:roles,name'],
    ]);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    $user->assignRole($request->input('role'));//->assing role

    return back()->with('success', 'Akun berhasil dibuat');
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
    $id=$request->id;//->get id

    $request->validate([
        'name' => ['required', 'min:3', new HtmlSpecialChars],
        'email' => ['required', 'email', 'unique:users,email,' . $id, new HtmlSpecialChars],
        'password' => ['nullable', new HtmlSpecialChars],
        'role' => ['required', 'exists:roles,name'],
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
        // ^ check if the password is not null and hash then updating data
    ]);

    // Update role
    $user->syncRoles([$request->input('role')]);

    return back()->with('success', 'Akun berhasil diupdate');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        intval($id);
        $input = User::findOrFail($id);
        $input->delete();

        return back();
    }
}
