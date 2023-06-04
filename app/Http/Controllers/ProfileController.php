<?php

namespace App\Http\Controllers;
use File;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

use App\Models\AdminActivity;
use App\Models\User;
use App\Models\Keanggotaan;
use App\Models\Peminjaman;

class ProfileController extends Controller
{


    /**
     * Display the user's profile form.
     */
    public function dataDiri(Request $request)
    {
        return view('dashboard.profile.read', [
            'user' => Auth::user()
        ]);        
    }
    public function updateProfileView(Request $request)
    {
        return view('dashboard.profile.update', [
            'user' => Auth::user()
        ]);
    }
    public function updatePasswordView(Request $request)
    {
        return view('dashboard.profile.update-password', [
            'user' => Auth::user()
        ]);
    }
    public function updatePassword(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if (!Hash::check($request->oldpassword, $user->password)) return redirect()->back()->with('message', 'Password Lama salah');
        if($request->newpassword != $request->cpassword) return redirect()->back()->with('message', 'Password Baru dan Confirm Password Tidak Sama');         
        $user->password = Hash::make($request->newpassword);
        $user->save();
        return redirect('/dashboard/user/account/data-diri');
    }

    
    public function adminReadAccountView(Request $request)
    {
        if(Auth::user()->keanggotaan_id != 1) $users = User::where('keanggotaan_id', '!=', 1)->where('keanggotaan_id', '!=', 2)->orderBy('keanggotaan_id', 'ASC')->get();
        else $users = User::orderBy('keanggotaan_id', 'ASC')->get();
        return view('dashboard.keanggotaan.daftar-akun.read', [
            'title1' => 'Daftar Anggota',
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
        return view('dashboard.keanggotaan.daftar-akun.create', [
            'title1' => 'Create User Account',
            'title2' => '',
            'keanggotaans' => Keanggotaan::get(),
            
        ]);
    }

    public function adminUpdateAccount(Request $request){
        $requestValidated = (object) $request->validate([
            'foto' => 'image|file',
        ]);
        if($request->password != $request->cpassword) return redirect()->back()->with('message', 'Password dan Confirm Password Tidak Sama'); 
        $user = User::where('email', $request->email)->where('id', '!=', $request->id)->first();
        if($user) return redirect()->back()->with('message', 'Email telah digunakan');
        $user = User::where('username', $request->username)->where('id', '!=', $request->id)->first();
        if($user) return redirect()->back()->with('message', 'Username telah digunakan');
        $user = User::where('id', $request->id)->first();
        if($user){
            $old = $user->toArray();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->alamat = $request->alamat;
            $user->telp = $request->telp;
            $user->keanggotaan_id = $request->keanggotaan_id;
            if(isset($request->password)) $user->password = Hash::make($request->password);

            if($request->file('foto')){
                $file = $request->file('foto');
    
                $name = $user->id;
                $extension = $file->getClientOriginalExtension();
                $newName = $name.'.'.$extension;
                $input = 'uploads/img/profile/'.$newName;
                if (File::exists(public_path('uploads/img/profile/profile_'.$user->id.'.jpg'))) File::delete(public_path('uploads/img/profile/profile_'.$user->id.'.jpg'));
                if (File::exists(public_path('uploads/img/profile/profile_'.$user->id.'.jpeg'))) File::delete(public_path('uploads/img/profile/profile_'.$user->id.'.jpeg'));
                if (File::exists(public_path('uploads/img/profile/profile_'.$user->id.'.png'))) File::delete(public_path('uploads/img/profile/profile_'.$user->id.'.png'));
                $request->foto->move(public_path('uploads/img/profile/'), $newName);
    
                $user->foto = $input;
            }

            $user->save();
        }
        
        AdminActivity::insert([
            'user_id' => Auth::user()->id,
            'aksi' =>  'Update',
            'halaman' =>  'Anggota',
            'table_id' =>  $user->id,
            'data_json' =>  json_encode($old),
            'new_data_json' =>  json_encode($user->toArray()),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return redirect('/dashboard/keanggotaan/daftar-akun');
    }
    public function adminCreateAccount(Request $request){
        $requestValidated = (object) $request->validate([
            'foto' => 'image|file',
            'username' => '',
            'name' => 'required',
            'email' => 'required',
            'keanggotaan_id' => 'required',
            'password' => 'required',
            'cpassword' => 'required',
        ]);
        if($request->password != $request->cpassword) return redirect()->back()->with('message', 'Password dan Confirm Password tidak sama'); 
        $user = User::where('email', $request->email)->first();
        if($user) return redirect()->back()->with('message', 'Email telah digunakan');
        $user = User::where('username', $request->username)->first();
        if($user) return redirect()->back()->with('message', 'Username telah digunakan');
       
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->telp = $request->telp;
        $user->keanggotaan_id = $request->keanggotaan_id;
        $user->password = Hash::make($request->password);
        $user->save();
        
        if($request->file('foto')){
            $file = $request->file('foto');

            $name = $user->id;
            $extension = $file->getClientOriginalExtension();
            $newName = $name.'.'.$extension;
            $input = 'uploads/img/profile/'.$newName;
            if (File::exists(public_path('uploads/img/profile/profile_'.$user->id.'.jpg'))) File::delete(public_path('uploads/img/profile/profile_'.$user->id.'.jpg'));
            if (File::exists(public_path('uploads/img/profile/profile_'.$user->id.'.jpeg'))) File::delete(public_path('uploads/img/profile/profile_'.$user->id.'.jpeg'));
            if (File::exists(public_path('uploads/img/profile/profile_'.$user->id.'.png'))) File::delete(public_path('uploads/img/profile/profile_'.$user->id.'.png'));
            $request->foto->move(public_path('uploads/img/profile/'), $newName);

            $user->foto = $input;            
            $user->save();
        }
        
        AdminActivity::insert([
            'user_id' => Auth::user()->id,
            'aksi' =>  'Create',
            'halaman' =>  'Anggota',
            'table_id' =>  $user->id,
            'data_json' =>  json_encode($user->toArray()),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return redirect('/dashboard/keanggotaan/daftar-akun');
    }

    public function adminDeleteAccount(Request $request){
        $user = User::where('id', $request->id)->first();
        if($user){
            foreach(Peminjaman::where('user_id', $user->id)->get() as $pem){
                $pem->delete();
            }
            if (File::exists(public_path($user->foto))) File::delete(public_path($user->foto));
            
            AdminActivity::insert([
                'user_id' => Auth::user()->id,
                'aksi' =>  'Delete',
                'halaman' =>  'Anggota',
                'table_id' =>  $user->id,
                'data_json' =>  json_encode($user->toArray()),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            $user->delete();
        }
        return redirect('/dashboard/keanggotaan/daftar-akun');
    }

    public function activity(Request $request){
        $data = null;
        if($request->activity_id) $data = AdminActivity::where('id', $request->activity_id)->first();
        return view('dashboard.activity.read',[
            'request' => $request,
            'data' => $data,
            'activities' => AdminActivity::orderBy('created_at', 'DESC')->get(),
        ]);
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
