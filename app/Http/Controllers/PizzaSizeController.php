<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PizzaSizeController extends Controller
{
    public function index()
    {
        $pizzaSizes = PizzaSize::all();
        return view('pizza_sizes.index', compact('pizzaSizes'));
    }

    public function create()
    {
        return view('pizza_sizes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'diameter' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        PizzaSize::create($validatedData);

        return redirect()->route('pizza_sizes.index')->with('success', 'Pizza size created successfully.');
    }

    public function show(PizzaSize $pizzaSize)
    {
        return view('pizza_sizes.show', compact('pizzaSize'));
    }

    public function edit(PizzaSize $pizzaSize)
    {
        return view('pizza_sizes.edit', compact('pizzaSize'));
    }

    public function update(Request $request, PizzaSize $pizzaSize)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'diameter' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $pizzaSize->update($validatedData);

        return redirect()->route('pizza_sizes.index')->with('success', 'Pizza size updated successfully.');
    }

    public function destroy(PizzaSize $pizzaSize)
    {
        $pizzaSize->delete();
        return redirect()->route('pizza_sizes.index')->with('success', 'Pizza size deleted successfully.');
    }
}