<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderExtraIngredientController extends Controller
{
    public function index(Order $order, Pizza $pizza)
    {
        $extraIngredients = $pizza->extraIngredients;
        return view('order_extra_ingredients.index', compact('order', 'pizza', 'extraIngredients'));
    }

    public function create(Order $order, Pizza $pizza)
    {
        $extraIngredients = ExtraIngredient::all();
        return view('order_extra_ingredients.create', compact('order', 'pizza', 'extraIngredients'));
    }

    public function store(Request $request, Order $order, Pizza $pizza)
    {
        $validatedData = $request->validate([
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
        ]);

        $pizza->extraIngredients()->attach($validatedData['extra_ingredient_id']);

        return redirect()->route('order_extra_ingredients.index', [$order, $pizza])->with('success', 'Extra ingredient added to pizza successfully.');
    }

    public function show(Order $order, Pizza $pizza, ExtraIngredient $extraIngredient)
    {
        return view('order_extra_ingredients.show', compact('order', 'pizza', 'extraIngredient'));
    }

    public function edit(Order $order, Pizza $pizza, ExtraIngredient $extraIngredient)
    {
        return view('order_extra_ingredients.edit', compact('order', 'pizza', 'extraIngredient'));
    }

    public function update(Request $request, Order $order, Pizza $pizza, ExtraIngredient $extraIngredient)
    {
        // Aquí podrías manejar la actualización de la cantidad o características del ingrediente extra si es necesario
        return redirect()->route('order_extra_ingredients.index', [$order, $pizza])->with('success', 'Extra ingredient updated successfully.');
    }

    public function destroy(Order $order, Pizza $pizza, ExtraIngredient $extraIngredient)
    {
        $pizza->extraIngredients()->detach($extraIngredient->id);
        return redirect()->route('order_extra_ingredients.index', [$order, $pizza])->with('success', 'Extra ingredient removed from pizza successfully.');
    }
}
