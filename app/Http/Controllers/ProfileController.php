<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        return view('profile');
    }

    public function editProfile(Request $request){
        $user =  User::find($request->id);
        $user->name = $request->name;
        $user->name = $request->surname;
        $user->name = $request->email;
        $user->name = $request->password;
        $user->name = $request->telephone;
        $user->name = $request->nif;
        $user->save();
        return back()->with('Profile edit correctly');
    }


}
