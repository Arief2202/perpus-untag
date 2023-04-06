<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class ChangeSidebarController extends Controller
{
    
    public function changeDarkMode(Request $request)
    {
        $user = User::where('email', 'like', $request->email)->first();
        $user->darkMode = $request->darkMode;
        $user->save(); 
    }
    
    public function changeSideBarOpen(Request $request)
    {
        $user = User::where('email', 'like', $request->email)->first();
        $user->openSideBar = $request->sideBarState;
        $user->save();        
    }
}
