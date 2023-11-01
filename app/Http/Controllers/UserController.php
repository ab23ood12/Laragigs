<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formfields = $request->validate([
                'name'=>['required','min:3'],
                'email'=>['required','email',Rule::unique('users','email')],
                'password'=>['required','min:8','max:15','confirmed'],
        ]);
        $formfields['password'] = bcrypt($formfields['password']);

        $user = User::create($formfields);

        auth()->login($user);

        return redirect('/');
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

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formfields = $request->validate([
            'email'=>['required','email'],
            'password'=>'required'
    ]);

    if(auth()->attempt($formfields))
    {
        $request->session()->regenerate();

        return redirect('/');
    }
        return back()->withErrors(['email'=>'Invalid Credintials'])->onlyInput('email');
    }
}
