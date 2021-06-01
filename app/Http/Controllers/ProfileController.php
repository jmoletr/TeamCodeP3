<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
        $user = Auth::user();
        $user =  User::find($request->id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->telephone = $request->telephone;
        $user->nif = $request->nif;
        $user->save();
        return back()->with('Profile edit correctly');
    }


}
