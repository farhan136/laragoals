<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $is_admin = Auth::user()->is_admin;

        if($is_admin != 1){
           $task = Task::where('assigned_to', '=', Auth::user()->id)->get(); 
        }else{
           $task = Task::all();
        }
        
        $data = array(
            'tasks'=>$task,
            'is_admin'=>$is_admin
        );
        return view('task.index', $data);
    }

    public function form(Task $task)
    {
        $user = User::select('id', 'name')->get();
        $is_admin = Auth::user()->is_admin;
        $data = array(
            'tasks'=>$task,
            'users'=>$user,
            'is_admin'=>$is_admin
        );
        return view('task.form', $data);
    }

    public function store(Request $request, Task $task_update)
    {
        $validated = $request->validate([
            'content'=>"required_if:".$task_update.",==,''|string",
            'status'=>'required',
            'deadline' => "required_if:".$task_update.",==,''",
            'level' => "required_if:".$task_update.",==,''",
            'pic'=>"required_if:".$task_update.",==,''",
        ]);
        // return $task_update;

        if(empty($task_update)){
            $task_update->status = $request->status;
            $task_update->updated_by = Auth::user()->id;
            $task_update->save();
        }else{
            $task = new Task;
            $task->content = $request->content;
            $task->status = $request->status;
            $task->deadline = $request->deadline;
            $task->assigned_to = $request->pic;
            $task->created_by = Auth::user()->id;
            $task->priority_level = $request->level;
            $task->save();
        }
        // return $task;
        

        $request->session()->flash('success', empty($task_update)? 'You already make new task': 'You already update the task');
        return redirect(route('todo.index'));
    }

    public function delete(Request $request, Task $task)
    {
        $task->delete();
        $request->session()->flash('success', 'You already delete the task');
        return redirect(route('todo.index'));
    }
}