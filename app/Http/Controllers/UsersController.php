<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);
        $currentUser = Auth::user(); 

        if($user->id == $currentUser->id || $currentUser->role == "admin")
        {
            $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            ]);


            if($request->hasFile('image')){
            //Get filename with extension
            $fileNameWithExt = $request->file('image')->GetClientOriginalName();;
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->GetClientOriginalExtension();
            //file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('image')->storeAs('public/_profileimg', $fileNameToStore);
        }



            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            if($request->hasFile('image'))
            {
                if ($user->image != 'profile.png') Storage::delete('public/_profileimg/'.$user->image); 
                $user->image = $fileNameToStore;
            }
            if($request->role)
                $user->role = $request->role;
            $user->save();

            return redirect("/home");
            
        }

        return abort(403);

    }
    public function usertype(Request $request, $id)
    {
        $user = User::findorfail($id);
        $currentUser = Auth::user(); 


        if($currentUser->role == "admin")
        {
            if($request->type == 'accepted'){
                $user->role = 'coach';
                $user->type = 'user';
                $user->save();
            }
            else if($request->type == 'denided'){
                $user->role = 'gymnast';
                $user->type = 'user';
                $user->save();
            }
            
            return redirect("/home");
            
        }

        return abort(403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(auth()->user()->role == "admin" || auth()->user()->id == $id){
            $user->delete();
            return back();
        }
        if ($post->cover_image != 'profile.png') Storage::delete('public/_profileimg/'.$user->image);

        return redirect("/home");

        
    }
}
