<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderPizzaController extends Controller
{
    public function index(Order $order)
    {
        $pizzas = $order->pizzas;
        return view('order_pizzas.index', compact('order', 'pizzas'));
    }

    public function create(Order $order)
    {
        $pizzas = Pizza::all();
        return view('order_pizzas.create', compact('order', 'pizzas'));
    }

    public function store(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order->pizzas()->attach($validatedData['pizza_id'], [
            'quantity' => $validatedData['quantity']
        ]);

        return redirect()->route('order_pizzas.index', $order)->with('success', 'Pizza added to order successfully.');
    }

    public function show(Order $order, Pizza $pizza)
    {
        return view('order_pizzas.show', compact('order', 'pizza'));
    }

    public function edit(Order $order, Pizza $pizza)
    {
        return view('order_pizzas.edit', compact('order', 'pizza'));
    }

    public function update(Request $request, Order $order, Pizza $pizza)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $order->pizzas()->updateExistingPivot($pizza->id, [
            'quantity' => $validatedData['quantity']
        ]);

        return redirect()->route('order_pizzas.index', $order)->with('success', 'Pizza quantity updated successfully.');
    }

    public function destroy(Order $order, Pizza $pizza)
    {
        $order->pizzas()->detach($pizza->id);
        return redirect()->route('order_pizzas.index', $order)->with('success', 'Pizza removed from order successfully.');
    }
}
