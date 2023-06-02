<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Keanggotaan;
use App\Models\Peminjaman;

class ProfileController extends Controller
{


    /**
     * Display the user's profile form.
     */
    public function userReadAccountView(Request $request)
    {
        return view('dashboard.profile.userReadAccountView', [
            'title1' => 'Profile',
            'title2' => ''
        ]);        
    }

    
    public function adminReadAccountView(Request $request)
    {
        if(Auth::user()->keanggotaan_id != 1) $users = User::where('keanggotaan_id', '!=', 1)->where('keanggotaan_id', '!=', 2)->orderBy('keanggotaan_id', 'ASC')->get();
        else $users = User::orderBy('keanggotaan_id', 'ASC')->get();
        return view('dashboard.keanggotaan.daftar-akun.read', [
            'title1' => 'User Account',
            'title2' => '',
            'users' => $users,
        ]);
    }
    public function adminUpdateAccountView($id, Request $request)
    {   
        // dd(User::where('id', $id)->first());
        return view('dashboard.keanggotaan.daftar-akun.update', [
            'title1' => 'Update User Account',
            'title2' => '',
            'user' => User::where('id', $id)->first(),
            'keanggotaans' => Keanggotaan::get(),
            
        ]);
    }
    public function adminCreateAccountView(Request $request)
    {   
        // dd(User::where('id', $id)->first());
        return view('dashboard.keanggotaan.daftar-akun.create', [
            'title1' => 'Create User Account',
            'title2' => '',
            'keanggotaans' => Keanggotaan::get(),
            
        ]);
    }

    public function adminUpdateAccount(Request $request){
        if($request->password != $request->cpassword) return redirect()->back()->with('message', 'Password dan Confirm Password Tidak Sama'); 
        $user = User::where('id', $request->id)->first();
        if($user){
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->keanggotaan_id = $request->keanggotaan_id;
            if(isset($request->password)) $user->password = Hash::make($request->password);
            $user->save();
        }
        return redirect('/dashboard/keanggotaan/daftar-akun');
    }
    public function adminCreateAccount(Request $request){
        if($request->password != $request->cpassword) return redirect()->back()->with('message', 'Password dan Confirm Password tidak sama'); 
        $user = User::where('email', $request->email)->first();
        if($user) return redirect()->back()->with('message', 'Email telah digunakan');
        else {
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->keanggotaan_id = $request->keanggotaan_id;
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return redirect('/dashboard/keanggotaan/daftar-akun');
    }

    public function adminDeleteAccount(Request $request){
        $user = User::where('id', $request->id)->first();
        if($user){
            foreach(Peminjaman::where('user_id', $user->id)->get() as $pem){
                $pem->delete();
            }
            $user->delete();
        }
        return redirect('/dashboard/keanggotaan/daftar-akun');
    }















    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
