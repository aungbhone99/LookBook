<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){


        // $id = $request->user()?->id;
        // $data= User::get($id);
        // $data= User::where('user_id',$user->id)->
        // orderBy('check_id', 'ASC')->latest()->get();
        // $data= User::where('$id', '4')->get();
        $user = Auth::user();
        return view('index',['usr'=> $user]);
        // print_r($user);
        // echo $id;

    }
    public function profile(Request $request){
        $user =Auth::user();
        return view('profile',['usr'=> $user]);
    }

}
