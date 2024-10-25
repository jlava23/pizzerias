<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PizzaRawMaterialController extends Controller
{
    public function index()
    {
        $pizzaRawMaterials = PizzaRawMaterial::all();
        return view('pizza_raw_materials.index', compact('pizzaRawMaterials'));
    }

    public function create()
    {
        return view('pizza_raw_materials.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        PizzaRawMaterial::create($validatedData);

        return redirect()->route('pizza_raw_materials.index')->with('success', 'Pizza raw material added successfully.');
    }

    public function show(PizzaRawMaterial $pizzaRawMaterial)
    {
        return view('pizza_raw_materials.show', compact('pizzaRawMaterial'));
    }

    public function edit(PizzaRawMaterial $pizzaRawMaterial)
    {
        return view('pizza_raw_materials.edit', compact('pizzaRawMaterial'));
    }

    public function update(Request $request, PizzaRawMaterial $pizzaRawMaterial)
    {
        $validatedData = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $pizzaRawMaterial->update($validatedData);

        return redirect()->route('pizza_raw_materials.index')->with('success', 'Pizza raw material updated successfully.');
    }

    public function destroy(PizzaRawMaterial $pizzaRawMaterial)
    {
        $pizzaRawMaterial->delete();
        return redirect()->route('pizza_raw_materials.index')->with('success', 'Pizza raw material deleted successfully.');
    }
}
