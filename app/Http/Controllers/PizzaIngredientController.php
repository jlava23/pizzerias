<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PizzaIngredientController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::with('ingredients')->get();
        return view('pizza_ingredients.index', compact('pizzas'));
    }

    public function create()
    {
        $pizzas = Pizza::all();
        $ingredients = Ingredient::all();
        return view('pizza_ingredients.create', compact('pizzas', 'ingredients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'ingredient_id' => 'required|exists:ingredients,id',
        ]);

        $pizza = Pizza::findOrFail($validatedData['pizza_id']);
        $pizza->ingredients()->attach($validatedData['ingredient_id']);

        return redirect()->route('pizza_ingredients.index')->with('success', 'Ingredient added to pizza successfully.');
    }

    public function show(Pizza $pizza)
    {
        $pizza->load('ingredients');
        return view('pizza_ingredients.show', compact('pizza'));
    }

    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        $pizza->load('ingredients');
        return view('pizza_ingredients.edit', compact('pizza', 'ingredients'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $validatedData = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
        ]);

        $pizza->ingredients()->sync($validatedData['ingredient_id']);

        return redirect()->route('pizza_ingredients.index')->with('success', 'Pizza ingredients updated successfully.');
    }

    public function destroy(Pizza $pizza, Ingredient $ingredient)
    {
        $pizza->ingredients()->detach($ingredient->id);
        return redirect()->route('pizza_ingredients.index')->with('success', 'Ingredient removed from pizza successfully.');
    }
}
