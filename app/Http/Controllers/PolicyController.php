<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Policy;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::all();
        return view('policies.index', compact('policies'));
    }

    public function create()
    {
        return view('policies.create');
    }

    public function store(Request $request)
    {
        // 1. Validation (Kasama ang lahat ng $fillable fields)
        $request->validate([
            'policy_number' => 'required|unique:policies,policy_number',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'status'        => 'required',
        ]);

        // 2. Pag-save sa database gamit ang kumpletong data
        Policy::create([
            'policy_number' => $request->policy_number,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'status'        => $request->status,
        ]);

        return redirect()->route('policies.index')->with('success', 'Policy created successfully!');
    }

    public function show(Policy $policy)
    {
        return view('policies.show', compact('policy'));
    }

    public function edit(Policy $policy)
    {
        return view('policies.edit', compact('policy'));
    }

    public function update(Request $request, Policy $policy)
    {
        // Validation para sa update (kailangan isama ang ID para hindi mag-error ang unique check)
        $request->validate([
            'policy_number' => 'required|unique:policies,policy_number,' . $policy->id,
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'status'        => 'required',
        ]);

        // I-update ang lahat ng fields
        $policy->update([
            'policy_number' => $request->policy_number,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'status'        => $request->status,
        ]);

        return redirect()->route('policies.index')->with('success', 'Policy updated successfully!');
    }

    public function destroy(Policy $policy)
    {
        $policy->delete();
        return redirect()->route('policies.index')->with('success', 'Policy deleted successfully!');
    }
}
