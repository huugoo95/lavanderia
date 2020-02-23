<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\InvoiceRequest;
use App\Http\Traits\GetWeeksTrait;
use App\Invoice;
use App\InvoiceLog;
use App\InvoiceService;
use App\Service;
use Mail;
use PDF;

class InvoiceController extends Controller
{
    use GetWeeksTrait;
    protected function index()
    {
        $invoices = Invoice::with('services', 'logs')->get();
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
        $invoice = Invoice::find($id);
        $invoice->customer_id = $request->get('invoice_customer');
        $invoice->regular = $request->get('invoice_regular');
        InvoiceService::where('invoice_id', $id)->delete();
        foreach ($request->get('services') as $service) {
            $invoiceService = new InvoiceService([
                'service_id' => $service,
                'invoice_id' => $invoice->id,
            ]);
            $invoiceService->save();
        }
        $invoice->save();

        return redirect('/invoices')->with('success', 'Factura modificada correctamente');
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect('/invoices')->with('success', 'Factura borrada correctamente');
    }

    public function preview(Invoice $invoice)
    {
        $mondays = $this->getMondaysOfMonth();
        return view('invoices.preview', compact('invoice', 'mondays'));
    }

    public function send(Invoice $invoice)
    {
        $mondays = $this->getMondaysOfMonth();
        $pdf = \PDF::loadView('invoices.preview', compact('invoice', 'mondays'));
        $data = ['date' => date('Y-m-d H:i:s')];

        try {
            Mail::send('mails.InvoiceMonthly', $data, function ($message) use ($pdf, $data) {
                $message->to(env('OWNER_EMAIL'))
                    ->cc(env('OWNER_EMAIL_CC'))
                    ->subject('Factura mensual')
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }

        if (Mail::failures()) {
            $this->statusdesc = "Error sending mail";
            $this->statuscode = "0";
        } else {
            $this->statusdesc = "Message sent Succesfully";
            $this->statuscode = "1";
            InvoiceLog::create([
                'invoice_id' => $invoice->id,
            ]);
        }
        return response()->json(compact('this'));
    }
}
