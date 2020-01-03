<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::where('type', 'user')->get();
        $pendingCoach = User::where('type', 'pending')->get();
        return view('home')->with('posts', $user->posts)->with('plans', $user->plans)->with('users', $users)->with('pendingCoach', $pendingCoach);
    }
}
