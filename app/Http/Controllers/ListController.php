<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // Display the list items
    public function index()
    {
        $items = TodoList::all(); 
        return view('dashboard', compact('items'));
    }

    // Store a new item
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'des' => 'required|string|max:1000',
        ]);

        TodoList::create([
            'type' => $request->type,
            'des' => $request->des,
        ]);

        return redirect()->route('dashboard')->with('success', 'Item added successfully.');
    }

    // Update an existing item
    public function update(Request $request, TodoList $item)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'des' => 'required|string|max:1000',
        ]);

        $item->update([
            'type' => $request->type,
            'des' => $request->des,
        ]);

        return redirect()->route('dashboard')->with('success', 'Item updated successfully.');
    }

    // Delete an item
    public function destroy(TodoList $item)
    {
        $item->delete();
        return redirect()->route('dashboard')->with('success', 'Item deleted successfully.');
    }
}
