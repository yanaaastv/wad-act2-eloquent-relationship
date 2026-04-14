<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth; //
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Customer::create([
            'name' => $request->name,
            'user_id' => Auth::id() //
        ]);

        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        if ($customer->user_id !== Auth::id()) {
            abort(403);
        }

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        //if ($customer->user_id !== Auth::id()) {
       //     abort(403);
       // }

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $customer->update([
            'name' => $request->name
        ]);

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->user_id !== Auth::id()) {
            abort(403);
        }

        $customer->delete();

        return back();
    }
}
