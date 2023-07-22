<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ToDo;

class ToDoController extends Controller
{
    function index() {
        $user_id = auth()->user()->id;

        $todos = ToDo::where([
            'user_id' => $user_id,
        ])->get();

        return response()->json($todos);
    }

    function create(Request $request) {
        $user_id = auth()->user()->id;
        $todo = new ToDo;
        $todo->body = $request->body;
        $todo->user_id = $user_id;
        $todo->save();
        return response()->json(['message' => 'ok', 'todo' => $todo]);
    }

    function update(Request $request) {
        $user_id = auth()->user()->id;
        $todo = ToDo::where([
            'id' => $request->id,
            'user_id' => $user_id,
        ])->first();
        if(isset($request->body)){
            $todo->body = $request->body;
        };
        if(isset($request->isPrioritary)){
            $todo->isPrioritary = $request->isPrioritary;
        };
        $todo->save();
        return response()->json(['message' => 'ok', 'todo' => $todo]);
    }

    function delete(Request $request) {
        $todo = ToDo::where([
            'id' => $request->id,
            'user_id' => $user_id,
        ]);

        $todo->delete();
        return response()->json(['message' => 'ok']);
    }
}
