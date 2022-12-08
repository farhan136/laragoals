<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use Mail;
Use App\Mail\GeneralMail;

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

    public function store(Request $request, Task $task)
    {
        $validated = $request->validate([
            'content'=>"required_if:".$task.",==,''|string",
            'status'=>'required',
            'deadline' => "required_if:".$task.",==,''",
            'level' => "required_if:".$task.",==,''",
            'pic'=>"required_if:".$task.",==,''",
        ]);
        // return $task;


        if(!empty($task)){
            $task->status = $request->status;
            $task->updated_by = Auth::user()->id;
            $task->save();
            $message = 'You already update the task';
        }else{
            $task = new Task;
            $task->content = $request->content;
            $task->status = $request->status;
            $task->deadline = $request->deadline;
            $task->assigned_to = $request->pic;
            $task->created_by = Auth::user()->id;
            $task->priority_level = $request->level;
            $task->save();

            //get email pic
            $email_pic = User::select('email')->get();
            $email_pic = $email_pic[0]->email;

            //kirim email setelah membuat task
            Mail::to($email_pic)->send(new GeneralMail($task));
            $message = 'You already make new task';
        }
        // return $task;
        

        $request->session()->flash('success',$message);
        return redirect(route('todo.index'));
    }

    public function delete(Request $request, Task $task)
    {
        $task->delete();
        $request->session()->flash('success', 'You already delete the task');
        return redirect(route('todo.index'));
    }
}