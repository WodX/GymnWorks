<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Gymnast;

class UserGymnastsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index()
    {
        $users = User::where('role', 'gymnast')->get();
        $gymnasts = Gymnast::where('user_id', auth()->user()->id)->get();

        $gymnastIds = $gymnasts->pluck('gymnasts_id')->toArray();

        $usersNotAdded = $users->filter(function($user) use($gymnastIds) {
        	if(in_array($user->id, $gymnastIds)) {
        		return false;
        	}

        	return true;
        });

        return view('pages.gymnasts', compact('users', 'gymnasts', 'usersNotAdded'));
    }

    public function store(User $user)
	{
		$gymnast = new Gymnast();
		$gymnast->user_id = auth()->user()->id;
		$gymnast->gymnasts_id = $user->id;
		$gymnast->save();
		
		return back();
	}

   public function destroy($id)
    {
        $gymnast = Gymnast::find($id);       
        $gymnast->delete();
        return back()->with('success', 'Gymnast Removed');
    }
}
