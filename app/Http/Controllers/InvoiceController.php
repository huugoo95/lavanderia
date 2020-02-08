<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\InvoiceService;
use App\Service;

class InvoiceController extends Controller
{
    protected function index()
    {
        $invoices = Invoice::with('services')->get();
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
        return view('invoices/create')->with(compact('customers', 'services'));
    }

    protected function store(InvoiceRequest $request)
    {
        $validated = $request->validated();

        $invoice = new Invoice([
            'customer_id' => $request->get('invoice_customer'),
            'regular' => $request->get('invoice_regular'),
        ]);
        $invoice->save();

        foreach ($request->get('services') as $service) {
            $invoiceService = new InvoiceService([
                'service_id' => $service,
                'invoice_id' => $invoice->id,
            ]);
            $invoiceService->save();
        }
        return redirect('/invoices')->with('success', 'Factura añadida correctamente');
    }

    protected function edit($id)
    {
        $invoice = Invoice::find($id);

        $customers = Customer::all();
        $services = Service::all();
        return view('invoices.edit')->with(compact('invoice', 'customers', 'services'));
    }

    public function update(InvoiceRequest $request, $id)
    {
        $validated = $request->validated();

        $invoice = Invoice::find($id);
        $invoice->customer_id = $request->get('invoice_customer');
        $invoice->service_id = $request->get('invoice_service');
        $invoice->regular = $request->get('invoice_regular');
        $invoice->save();

        return redirect('/invoices')->with('success', 'Factura modificada correctamente');
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect('/invoices')->with('success', 'Factura borrada correctamente');
    }

    public function sendInvoice($id)
    {
        $invoice = Invoice::find($id);
        /*
    $mytime = Carbon\Carbon::now();
    return $mytime;
    echo $mytime->toDateTimeString();
    $week = $date->format("W");

    $invoiceLog = new InvoiceLog([
    'invoice_id' => $id,
    'week_number' => $request->get('invoice_service'),
    'year' => $request->get('invoice_regular')
    ]);
     */
    }
}
