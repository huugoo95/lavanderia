<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Service;

class ServiceController extends Controller
{
    protected function index()
    {
        $services = Service::all();

        return view('services.index', compact('services'));
    }
    /**
     * Return a register view
     *
     */
    protected function create()
    {
        return view('services/create');
    }

    protected function store(ServiceRequest $request)
    {
        $validated = $request->validated();
    
        $service = new Service([
            'name' => $request->get('service_name'),
            'description'=> $request->get('service_description'),
            'price'=> $request->get('service_price')
        ]);
        $service->save();
        return redirect('/services')->with('success', 'cliente añadido correctamente');
    }

    protected function edit($id)
    {
        $service = Service::find($id);        
        return view('services.edit', compact('service'));
        
    }

    public function update(ServiceRequest $request, $id)
    {
        $validated = $request->validated();

        $service = Service::find($id);
        $service->name = $request->get('service_name');
        $service->description = $request->get('service_description');
        $service->price = $request->get('service_price');
        $service->save();

        return redirect('/services')->with('success', 'servicio modificado correctamente');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect('/services')->with('success', 'servicio borrado correctamente');
    }
}
