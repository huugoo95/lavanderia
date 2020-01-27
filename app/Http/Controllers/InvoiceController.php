<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\Customer;
use App\Service;

class InvoiceController extends Controller
{
    protected function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', compact('invoices'));
    }
    /**
     * Return a register view
     *
     */
    protected function create()
    {
        $customers = Customer::all();        
        $services = Service::all();        
        return view('invoices/create', compact('customers'), compact('services'));
    }

    protected function store(InvoiceRequest $request)
    {
        $validated = $request->validated();
    
        $invoice = new Invoice([
            'customer_id' => $request->get('invoice_customer'),
            'service_id' => $request->get('invoice_service'),
            'occasional' => $request->get('invoice_occasional')
        ]);
        $invoice->save();
        return redirect('/invoices')->with('success', 'Factura añadida correctamente');
    }

    protected function edit($id)
    {
        $invoice = Invoice::find($id);        
        return view('invoices.edit', compact('invoice'));
        
    }

    public function update(InvoiceRequest $request, $id)
    {
        $validated = $request->validated();

        $invoice = Invoice::find($id);
        $invoice->name = $request->get('invoice_name');
        $invoice->description = $request->get('invoice_description');
        $invoice->price = $request->get('invoice_price');
        $invoice->save();

        return redirect('/invoices')->with('success', 'Factura modificada correctamente');
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect('/invoices')->with('success', 'Factura borrado correctamente');
    }
}
