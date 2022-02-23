<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Build;
use App\Models\Room;

class FrontendController extends Controller
{
    public function login()
    {
        return view("frontend.auth.login");
    }
    public function authenticate(Request $request)
    {
        $data= $request->all();
        if(Auth::attempt(['userid' => $data['userid'], 'password' => $data['password'],'type' => 1])){
            Session::put('user', $data);
            return redirect()->route('frontend.build.index');
        }
        return back()->withErrors([
            'error' => 'ログインに失敗しました。',
        ]);
    }
    
    public function logout(Request $request)
    {
        Session::forget('user');
        Auth::logout();    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();    
        return redirect()->route('frontend.auth.index');
    }
    
    public function buildList()
    {
        $builds = Build::all();  
        $count = count($builds);
        return view("frontend.build.index", compact('builds', 'count'));
    }
    public function buildDetail($build_id, $room_id = null)
    {
        $build = Build::where("id", $build_id)->first();
        $room = array();
        if($room_id == null)
            $room = $build->rooms->first();
        else
            $room = Room::where("id", $room_id)->first();  
        return view('frontend.build.detail', compact('build','room'));
    }
}
