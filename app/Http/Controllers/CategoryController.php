<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;
use Cloudinary\Cloudinary;


class CategoryController extends Controller
{
    //
    public function index()
    {
        // 🔥 withCount يجيب عدد المنتجات لكل category
        $categories = \App\Models\Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.create_category');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|unique:categories,name',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'

        ]);

        // Upload image
        if ($request->hasFile('image')) {

            $result = (new Cloudinary(config('cloudinary.cloud_url')))
                ->uploadApi()
                ->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'outfit/categories'
                    ]
                );

            $validated['image'] = $result['secure_url'];
        }

        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully');
    }
    public function destroy(Category $category)
    {
        // خلي المنتجات بدون category
        $category->products()->update([
            'category_id' => null
        ]);
        if ($category->image && !str_starts_with($category->image, 'http')) {
            Storage::disk('public')->delete($category->image);
        }


        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'  => 'required|unique:categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $category = Category::findOrFail($id);

        // upload new image
        if ($request->hasFile('image')) {

            $result = (new Cloudinary(config('cloudinary.cloud_url')))
                ->uploadApi()
                ->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'outfit/categories'
                    ]
                );

            $validated['image'] = $result['secure_url'];
        }

        // update category
        $category->update([
            'name'  => $validated['name'],
            'image' => $validated['image'] ?? $category->image,
        ]);

        return redirect()
            ->route('admin.categories')
            ->with('success', 'Category updated successfully');
    }
    public function adminIndex()
    {
        $categories = Category::withCount('products')->get();

        return view('admin.categories', compact('categories'));
    }
}
