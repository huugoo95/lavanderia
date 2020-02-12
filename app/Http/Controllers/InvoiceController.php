<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\InvoiceService;
use App\Service;
use Mail;
use PDF;

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

    public function preview(Invoice $invoice)
    {
        return view('invoices.preview', compact('invoice'));
    }

    public function send(Invoice $invoice)
    {
        $pdf = \PDF::loadView('invoices.preview', compact('invoice'));
        $invoice = Invoice::find(13);

        $data = [];
        //$pdf->save(storage_path() . 'invoice.pdf');
        //\Mail::to("huugoo95@gmail.com")->send(new );
        Mail::send('mail', $data, function ($message) use ($data, $pdf) {
            $message->to('huugoo95@gmail.com', 'hugo')
                ->subject('asunto')
                ->attachData($pdf->output(), "invoice.pdf");
            });

        /*try {
            Mail::send('mails.mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"])
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
        }*/
        return response()->json(compact('this'));
    }
}
