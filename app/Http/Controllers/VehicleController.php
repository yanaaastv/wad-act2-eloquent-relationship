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
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric',
        ]);

        Vehicle::create([
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'user_id' => Auth::id(), // Use Auth::id() instead of auth()->id()
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
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric',
        ]);

        $vehicle->update($request->all());

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
