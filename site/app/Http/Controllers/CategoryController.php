<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Ambil semua kategori yang dimiliki oleh pengguna yang sedang login
        $categories = Category::where('user_id', Auth::id())->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Buat kategori baru untuk pengguna yang sedang login
        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        // Pastikan hanya pemilik kategori yang bisa mengakses halaman ini
        $this->authorizeCategoryOwner($category);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Pastikan hanya pemilik kategori yang bisa mengupdate
        $this->authorizeCategoryOwner($category);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update nama kategori
        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Pastikan hanya pemilik kategori yang bisa menghapus
        $this->authorizeCategoryOwner($category);

        // Hapus kategori
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * Check if the authenticated user owns the category.
     */
    private function authorizeCategoryOwner(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
