<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // Hanya tampilkan todo milik user yang login dengan sorting dan pagination
    public function index()
    {
        $todos = Todo::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('is_complete', 'asc')      // ✅ UBAH: is_done → is_complete
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $todoCompleted = Todo::where('user_id', Auth::id())
            ->where('is_complete', true)         // ✅ UBAH: is_done → is_complete
            ->count();

        return view('todo.index', compact('todos', 'todoCompleted'));
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
            'is_complete' => false,              // ✅ UBAH: is_done → is_complete
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    public function edit(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
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

        $todo->is_complete = !$todo->is_complete;  // ✅ UBAH: is_done → is_complete
        $todo->save();

        return redirect()->route('todo.index')->with('success', 'Todo status updated successfully.');
    }

    // Method tambahan jika ada
    public function complete(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $todo->is_complete = true;               // ✅ UBAH: is_done → is_complete
        $todo->save();

        return redirect()->route('todo.index')->with('success', 'Todo marked as completed.');
    }

    public function uncomplete(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $todo->is_complete = false;              // ✅ UBAH: is_done → is_complete
        $todo->save();

        return redirect()->route('todo.index')->with('success', 'Todo marked as incomplete.');
    }

    public function destroyCompleted()
    {
        Todo::where('user_id', auth()->id())
            ->where('is_complete', true)         // ✅ UBAH: is_done → is_complete
            ->delete();

        return redirect()->route('todo.index')->with('success', 'All completed todos deleted.');
    }
}