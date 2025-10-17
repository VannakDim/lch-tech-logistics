<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::all();
        return response()->json($items);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
        ]);

        $item = Items::create($data);

        return response()->json($item, 201);
    }

    public function show(Items $item)
    {
        return response()->json($item);
    }

    public function edit(Items $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Items $item)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
        ]);

        $item->update($data);

        return response()->json($item);
    }

    public function destroy(Items $item)
    {
        $item->delete();
        return response()->json(null, 204);
    }
}
