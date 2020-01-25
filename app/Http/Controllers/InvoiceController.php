<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;

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
        return view('invoices/create');
    }

    protected function store(InvoiceRequest $request)
    {
        $validated = $request->validated();
    
        $invoice = new Invoice([
            'name' => $request->get('invoice_name'),
            'description'=> $request->get('invoice_description'),
            'price'=> $request->get('invoice_price')
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
