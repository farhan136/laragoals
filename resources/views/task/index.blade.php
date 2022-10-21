@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">To Do List </div>
                @if($is_admin == 1)
                <br>
                <a class="btn btn-xs" href="{{route('todo.create')}}" style="color: white; margin-left: 240px; margin-right: 240px; background-color: #182747;">Add New</a>
                <br>
                @endif
                
                <div class="card-body">
                    @include('components.alert')
                <table id="todo_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%; text-align: center;">No</th>
                            <th style="width:40%; text-align: center;">Task</th>
                            <th style="text-align: center;">Priority Level</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Assigned To</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr>
                            <td style="text-align: center;">{{$loop->iteration}}</td>
                            <td style="text-align: center;">{{$task->content}}</td>
                            <td style="text-align: center;">{{$task->priority_level}}</td>
                            <td style="text-align: center;">{{$task->status}}</td>
                            <td style="text-align: center;">{{$task->user->name}}</td>
                            <td style="text-align: center;">
                                <a class="btn btn-xs" href="{{route('todo.edit', $task->id)}}" style="color: white; background-color: #F57328;">Edit</a> 
                                @if($is_admin == 1)
                                    <a class="btn btn-xs" href="{{route('todo.delete', $task->id)}}" style="color: white; background-color: #CC3636; ">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td style="text-align: center;" colspan="6">There is no data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
