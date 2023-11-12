<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facades as Avatar;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar')) 
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return redirect::back();
    }

    public function show_profile()
    {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }

    public function edit_profile(request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'password'=> Hash::make($request->password),
        ]);

        return redirect::back();
    }
}
