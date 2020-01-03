<?php

namespace App\Http\Controllers;

use Auth;
use App\Plan;
use App\User;
use App\Gymnast;
use App\PlanUser;
use Illuminate\Http\Request;

class PlansController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->can('create', Plan::class)) {
            $title = 'Created Plans';
            $plans = Plan::whereUserId($user->id)->orderBy('created_at', 'desc')->get();
        } else {
            $title = 'My Plans';
            $plans = $user->attachedPlans;
        }

        return view('plans.index', compact('title', 'plans'));
    }

    public function duplicate($id)
    {
        $plan = Plan::find($id);

        $newPlan = $plan->replicate();
        $newPlan->save();

        return redirect()->route('plans.edit', ['plan' => $newPlan->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $myGymnasts = Gymnast::whereUserId($user->id)->get()->pluck('gymnasts_id')->toArray();
        $users = User::whereRole('gymnast')->whereIn('id', $myGymnasts)->orderBy('name')->get();

        if($user->cant('create', Plan::class)) {
            return abort(404);
        }
        
        return view('plans.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $users = $request->input('users');

        //Create Plan

        $plan = new Plan();
        $plan->title = $request->input('title');
        $plan->body = $request->input('body');
        $plan->user_id = auth()->user()->id;
        $plan->save();

        foreach($users as $user) {
            $plan->attachedUsers()->attach([
               'user_id' => $user,
               'plan_id' => $plan->id, 
            ]);
        }

        return redirect('/plans')->with('success', 'Plan Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        return view('plans.show')->with("plan",$plan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $user = Auth::user();

        $myGymnasts = Gymnast::whereUserId($user->id)->get()->pluck('gymnasts_id')->toArray();
        $users = User::whereRole('gymnast')->whereIn('id', $myGymnasts)->orderBy('name')->get();
        $attachedUsers = PlanUser::where('plan_id', $plan->id)->get()->pluck('user_id')->toArray();

        if($user->cant('update', $plan)) {
            return abort(404);
        }

        return view('plans.edit', compact('plan', 'users', 'attachedUsers'));
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
        $plan = Plan::findOrFail($id);
        $user = Auth::user();

        if($user->cant('update', $plan)) {
            return abort(403);
        }

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $plan->title = $request->input('title');
        $plan->body = $request->input('body');
        $plan->save();

        $users = $request->input('users');
        $plan->attachedUsers()->detach();
        
        if(is_array($users)) {
            foreach($users as $user) {
                $plan->attachedUsers()->attach([
                   'user_id' => $user,
                   'plan_id' => $plan->id, 
                ]);
            }
        }

        return redirect('/plans')->with('success', 'Plan Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::find($id);
        //Check for current user
        if(auth()->user()->id !== $plan->user_id){
            return redirect("/plan");
        }
        
        $plan->delete();
        return redirect('/plans')->with('success', 'Plan Removed');
    }
}
