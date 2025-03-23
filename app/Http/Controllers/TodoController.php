<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        
        $todos = Todo::where('user_id', auth()->user()->id)->get();
        dd($todos);

        return view('todo.index');
    }

    public function create()
    {
        return view('todo.create');
    }

    public function edit()
    {
        return view('todo.edit');
    }
}
