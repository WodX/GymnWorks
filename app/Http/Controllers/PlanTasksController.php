<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Plan;

class PlanTasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function store(Plan $plan)
	{
		$attributes = request()->validate(['description' => 'required']);

		$plan->addTask($attributes);

		return back();
	}

    public function update(Task $task)
    {
    	$task->update([

    		'completed' => request()->has('completed')

    	]);

    	return back();
    }

    public function destroy($id)
    {
        
        $task = Task::find($id);       
        $task->delete();
        return back()->with('success', 'Plan Removed');
    }
}
