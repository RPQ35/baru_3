<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Rules\HtmlSpecialChars;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Account = User::paginate(20);

        $page_count = User::count('name');
        $page_count = $page_count ? ceil($page_count / 20) : 1;


        return view('admin.account.index_account', compact([
            'Account' => $Account,
            'page_count' => $page_count,
        ]));
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
            'name' => ['required|min:3', new HtmlSpecialChars],
            'email' => ['required|email|unique:User', new HtmlSpecialChars],
            'password' => ['required|min:6', new HtmlSpecialChars],
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::Create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->assignRole($request->input('role'));

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
        intval($id);
        $input = User::findOrFail($id);
        $input->delete();

        return back();
    }
}
