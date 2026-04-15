<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure this is here
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Use Auth::user() for better IDE compatibility
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            $vehicles = Vehicle::all();
        } else {
            $vehicles = Vehicle::where('user_id', Auth::id())->get();
        }

        return view('vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        return view('vehicles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'customer_id'  => 'required|exists:customers,id',
        'plate_number' => 'required|string|unique:vehicles',
        'brand'        => 'required|string',
        'model'        => 'required|string',
        'year'         => 'required|integer',
        'color'        => 'required|string',
    ]);

        Vehicle::create([
            'customer_id' => $request->customer_id,
            'plate_number' => $request->plate_number,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created!');
    }

    public function edit(Vehicle $vehicle): View
    {
        // Access Rule check
        if (Auth::id() !== $vehicle->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        if (Auth::id() !== $vehicle->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric',
        ]);

        $vehicle->update($request->only(['brand', 'model', 'year']));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated!');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        if (Auth::id() !== $vehicle->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted!');
    }
}
