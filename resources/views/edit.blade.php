@extends('layouts.app')
@section('content')

  <form action="/task/{{ $task->id }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="PUT">    
    <input type="text" name="content" value="{{ $task->content }}">
    <button type="submit">Edit</button>
  </form>
@endsection

