<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
   
       return redirect()->back()->with(['message' => 'Password change successfully']);
    }
}
