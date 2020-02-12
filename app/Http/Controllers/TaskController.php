<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('todolist', compact('tasks'));
    }
    public function store(Request $request){
        $va = Validator::make($request->all(), [
            'content' => 'required|max:10',
        ]);
        if ($va->fails()) {
            return response()->json(['result'=>$va->errors()],416);
        }

        DB::beginTransaction();
        try {
            Task::create([
                'content' => $request->content,
                'done' => 0,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['result'=>$th],500);
        }
        DB::commit();

        return redirect('/');
    }
    public function update(Request $request,$id){
        $va = Validator::make($request->all(), [
            'content' => 'required|max:10',
        ]);
        if ($va->fails()) {
            return response()->json(['result'=>$va->errors()],416);
        }

        DB::beginTransaction();
        try {
            Task::find($id)->update([
                'content' => $request->content,
                'done' => false
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['result'=>$th],500);
        }
        DB::commit();
        return redirect('/');
    }
    public function destroy($id){
        
        DB::beginTransaction();
        try {
            Task::find($id)->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['result'=>$th],500);
        }
        DB::commit();
        return redirect('/');

    }

    public function done($id){
        
        DB::beginTransaction();
        try {
            Task::find($id)->update([
                'done' => 1
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['result'=>$th],500);
        }
        DB::commit();
        $tasks = Task::all();
        return redirect('/');
    }
    public function edit($id){
        $task = Task::find($id);
        return view('edit', compact('task'));
    }
}