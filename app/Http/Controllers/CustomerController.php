<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Customer;

class CustomerController extends Controller
{
    protected function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }
    /**
     * Return a register view
     *
     */
    protected function create()
    {
        return view('customers/create');
    }

    protected function store(CustomerRequest $request)
    {
        $validated = $request->validated();
    
        $customer = new Customer([
            'name' => $request->get('customer_name'),
            'cif'=> $request->get('customer_cif'),
            'email'=> $request->get('customer_email'),
            'address'=> $request->get('customer_address'),
            'phone_number'=> $request->get('customer_phone')
        ]);
        $customer->save();
        return redirect('/customers')->with('success', 'cliente añadido correctamente');
    }

    protected function edit($id)
    {
        $customer = Customer::find($id);        
        return view('customers.edit', compact('customer'));
        
    }

    public function update(CustomerRequest $request, $id)
    {
        $validated = $request->validated();

        $customer = Customer::find($id);
        $customer->cif = $request->get('customer_cif');
        $customer->name = $request->get('customer_name');
        $customer->email = $request->get('customer_email');
        $customer->address = $request->get('customer_address');
        $customer->phone_number = $request->get('customer_phone');
        $customer->save();

        return redirect('/customers')->with('success', 'cliente modificado correctamente');
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return redirect('/customers')->with('success', 'customer has been deleted Successfully');
    }
}
