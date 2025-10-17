<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemsCategories;

class ItemsCategoriesController extends Controller
{
    public function index()
    {
        $categories = ItemsCategories::all();
        return view('items_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('items_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('categories', 'public');
        }

        ItemsCategories::create($data);

        return redirect()->route('items-categories.index')->with('success', 'Category created.');
    }

    public function show($id)
    {
        $category = ItemsCategories::findOrFail($id);
        return view('items_categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = ItemsCategories::findOrFail($id);
        return view('items_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ItemsCategories::findOrFail($id);

        $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            // remove old photo
            if ($category->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->photo);
            }
            $data['photo'] = $request->file('photo')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('items-categories.index')->with('success', 'Category updated.');
    }

    public function destroy($id)
    {
        $category = ItemsCategories::findOrFail($id);

        if ($category->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($category->photo);
        }

        $category->delete();

        return redirect()->route('items-categories.index')->with('success', 'Category deleted.');
    }
}
