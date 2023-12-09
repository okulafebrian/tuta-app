<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin.auth']);
    }

    public function index()
    {
        return inertia('Categories/Index', [
            'categories' => Category::paginate(12)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->lower()->slug('-')
        ]);

        return back()->with(['success' => 'Kategori baru berhasil ditambahkan.']);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return back()->with(['success' => 'Kategori berhasil diperbaharui.']);
    }

    public function destroy(Category $category)
    {
        $message = "Kategori '" . $category->name . "' berhasil dihapus.";

        $category->delete();

        return back()->with(['success' => $message]);;
    }
}
