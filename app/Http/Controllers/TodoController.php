<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::with('category')->get();
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('todo.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Todo::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'is_complete' => false, // default status is 'ongoing'
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $categories = Category::all();
        return view('todo.edit', compact('todo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $todo->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully.');
    }

    /**
     * Toggle the completion status of the todo.
     */
    public function toggleComplete(Todo $todo)
    {
        $todo->is_complete = !$todo->is_complete;
        $todo->save();

        return redirect()->route('todo.index')->with('success', 'Todo status updated successfully.');
    }
}
