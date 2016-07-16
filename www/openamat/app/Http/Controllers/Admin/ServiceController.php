<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ServiceService;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function __construct(ServiceService $serviceService)
    {
        $this->service = $serviceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = $this->service->paginated();
        return view('services.index')->with('services', $services);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $services = $this->service->search($request->search);
        return view('services.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('services.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('services.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the services.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = $this->service->find($id);
        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the services.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = $this->service->find($id);
        return view('services.edit')->with('service', $service);
    }

    /**
     * Update the services in storage.
     *
     * @param  \Illuminate\Http\ServiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the services from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('services.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('services.index'))->with('message', 'Failed to delete');
    }
}
