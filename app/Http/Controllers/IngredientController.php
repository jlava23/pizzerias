<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        Ingredient::create($validatedData);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully.');
    }

    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $ingredient->update($validatedData);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully.');
    }
}
