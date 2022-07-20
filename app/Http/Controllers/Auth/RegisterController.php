<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct() {
        // Only allow guests
        $this->middleware(['guest']);
    }

    //
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        // validate using larvel controller default validation 
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed', // This rule will search for the same field but with suffix _confirmed
        ]);
        // store the user in DB
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // sign in by attempting with the email and password from the request
        auth()->attempt($request->only('email', 'password'));

        // redirect
        return redirect()->route('dashboard');
    }
}
