<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Hanya tampilkan todo milik user yang login
    public function index()
    {
        $todos = Todo::with('category')
            ->where('user_id', auth()->id())
            ->get();

        return view('todo.index', compact('todos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('todo.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Todo::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'is_complete' => false,
            'user_id' => auth()->id(), // ✅ penting
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    public function edit(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403); // 🔒 hanya pemilik yang bisa akses
        }

        $categories = Category::all();
        return view('todo.edit', compact('todo', 'categories'));
    }

    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

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

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully.');
    }

    public function toggleComplete(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $todo->is_complete = !$todo->is_complete;
        $todo->save();

        return redirect()->route('todo.index')->with('success', 'Todo status updated successfully.');
    }
}
