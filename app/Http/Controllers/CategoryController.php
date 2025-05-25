<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load todos to avoid N+1 problem
        $categories = Category::with('todos')
            ->where('user_id', Auth::id())
            ->get();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Optional: return abort if not used
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::id() === $category->user_id) {
            return view('category.edit', compact('category'));
        }

        return redirect()->route('category.index')
            ->with('danger', 'You are not authorized to edit this category!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (Auth::id() !== $category->user_id) {
            return redirect()->route('category.index')
                ->with('danger', 'You are not authorized to update this category!');
        }

        $request->validate([
            'title' => 'required|max:255',
        ]);

        $category->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Todo category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Auth::id() === $category->user_id) {
            $category->delete();

            return redirect()->route('category.index')
                ->with('success', 'Category deleted successfully!');
        }

        return redirect()->route('category.index')
            ->with('danger', 'You are not authorized to delete this category!');
    }
}
