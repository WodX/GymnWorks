<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Plan;
use App\Post;
use App\Gymnast;
use Auth;

class PagesController extends Controller
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

        $user = Auth::user();
        $posts = Post::orderBy('created_at', 'desc')->limit(3)->get();
        return view('pages.index')->with('plans', $user->attachedPlans()->limit(5)->get())->with('posts', $posts);
    }

    public function role(){
        return view('auth.role');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($request->role == 'gymnast'){
            $user->role = $request->role;
            $user->save();
            return redirect('/');
        }else if($request->role == 'coach'){
            $user->role = "gymnast";
            $user->type = "pending";
            $user->save();
            return redirect('/');
        }
        
    }

}
