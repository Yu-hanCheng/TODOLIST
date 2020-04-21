@extends('layouts.app')

@section('content')
<div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- New Task Form -->
                    <form action="task" method="POST" class="form-horizontal" style="display: inline-block;">
                        @csrf
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="content" id="task-name" class="form-control" value="">
                                <input type="hidden" name="done" id="task-done" class="form-control" value="0">
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Current Tasks -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                @if($task->done === 1)
                                    <td class="col-sm-6">
                                        <del>{{ $task->content }}</del>
                                    </td>
                                    <td class="col-sm-6">
                                        <button type="submit" class="btn btn-success" disabled ><i class="fa fa-btn fa-thumbs-o-up"></i>completed</button>
                                @else
                                    <td class="col-sm-6 task-content" name="task_content" value="{{$task->content}}" >{{ $task->content }}</td>
                                    <td class="col-sm-6">
                                    <form action="task/done/{{ $task->id }}" method="POST" class="form-horizontal" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="_method" value="put">
                                        <button type="submit" class="btn btn-success" ><i class="fa fa-btn fa-thumbs-o-up"></i>completed</button>
                                    </form>
                                @endif
                                <!-- Task Buttons -->
                                        <form action="task/{{ $task->id }}" method="GET" class="form-horizontal" style="display: inline-block;">
                                            @csrf
                                            <a><input type="submit"  class="btn btn-primary" name="id" value="Edit"></a>
                                        </form>
                                        
                                        <form action="task/{{ $task->id }}" method="POST" class="form-horizontal" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <a><input type="submit"  class="btn btn-danger" name="id" value="Delete"></a>
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection