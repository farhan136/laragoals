@extends('layouts.app')

@section('css')
<style type="text/css">
    .danger{
        color: red !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Task</div>
                <div class="card-body">
                    <form method="POST" action="{{route('todo.store', $tasks->id)}}">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-md-4">
                                Task
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="content" class="form-control input-group-sm" {{ $is_admin != 1? 'readonly': ''}} autocomplete="off" value="{{$tasks->id != '' ? $tasks->content : '' }}">
                                @error('content')
                                    <span class="danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        @if($is_admin == 1)
                        <div class="row mb-5">
                            <div class="col-md-4">
                                Priority Level
                            </div>
                            <div class="col-md-8">
                                <select class="form-control input-group-sm" autocomplete="off" name="level">
                                    <option value="" selected>Choose Priority Level</option>
                                    <option value="normal" {{ $tasks->id != '' && $tasks->priority_level == 'normal'?'selected':'' }}>Normal</option>
                                    <option value="high" {{ $tasks->id != '' && $tasks->priority_level == 'high'?'selected':'' }}>High</option>
                                    <option value="urgent" {{ $tasks->id != '' && $tasks->priority_level == 'urgent'?'selected':'' }}>Urgent</option>
                                </select>
                                @error('type')
                                    <span class="danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                Deadline
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control input-group-sm" autocomplete="off" name="deadline" value="{{$tasks->id != '' ? $tasks->deadline->format('Y-m-d') : ''}}">
                                @error('deadline')
                                    <span class="danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                Assign To
                            </div>
                            <div class="col-md-8">
                                <select class="form-control input-group-sm" autocomplete="off" name="pic">
                                    <option value="" selected>Choose PIC</option>
                                    @foreach($users as $user)
                                        @if($user->id == $tasks->assigned_to)
                                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('pic')
                                    <span class="danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row mb-5">
                            <div class="col-md-4">
                                Status
                            </div>
                            <div class="col-md-8">
                                <select class="form-control input-group-sm" autocomplete="off" name="status">
                                    <option value="" selected>Choose Status</option>
                                    @if($is_admin == 1)
                                    <option value="cancelled" {{ $tasks->id != '' && $tasks->status == 'cancelled'?'selected':'' }} >Cancelled</option>
                                    @endif
                                    <option value="doing" {{ $tasks->id != '' && $tasks->status == 'doing'?'selected':'' }}  >Doing</option>
                                    <option value="done" {{ $tasks->id != '' && $tasks->status == 'done'?'selected':'' }}  >Done</option>
                                </select>
                                @error('status')
                                    <span class="danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-xs" style="color: white; margin-left: 240px; margin-right: 240px; background-color: #182747;" type="submit">Submit</button>    
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
    // showData()
  });


</script>
@endsection
