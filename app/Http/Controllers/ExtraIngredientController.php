<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtraIngredientController extends Controller
{
    public function index(Order $order)
    {
        $extraIngredients = $order->extraIngredients;
        return view('extra_ingredients.index', compact('order', 'extraIngredients'));
    }

    public function create(Order $order)
    {
        $extraIngredients = ExtraIngredient::all();
        return view('extra_ingredients.create', compact('order', 'extraIngredients'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'ingredient_id' => 'required|exists:extra_ingredients,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order->extraIngredients()->attach($validatedData['ingredient_id'], [
            'quantity' => $validatedData['quantity']
        ]);

        return redirect()->route('extra_ingredients.index', $order)->with('success', 'Extra ingredient added successfully.');
    }

    public function show(Order $order, ExtraIngredient $extraIngredient)
    {
        return view('extra_ingredients.show', compact('order', 'extraIngredient'));
    }

    public function edit(Order $order, ExtraIngredient $extraIngredient)
    {
        return view('extra_ingredients.edit', compact('order', 'extraIngredient'));
    }

    public function update(Request $request, Order $order, ExtraIngredient $extraIngredient)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $order->extraIngredients()->updateExistingPivot($extraIngredient->id, [
            'quantity' => $validatedData['quantity']
        ]);

        return redirect()->route('extra_ingredients.index', $order)->with('success', 'Extra ingredient updated successfully.');
    }

    public function destroy(Order $order, ExtraIngredient $extraIngredient)
    {
        $order->extraIngredients()->detach($extraIngredient->id);
        return redirect()->route('extra_ingredients.index', $order)->with('success', 'Extra ingredient removed successfully.');
    }
}
