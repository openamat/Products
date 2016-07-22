<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StopService;
use App\Http\Requests\StopRequest;

class StopController extends Controller
{
    public function __construct(StopService $stopService)
    {
        $this->service = $stopService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stops = $this->service->paginated();
        return view('admin.stops.index')->with('stops', $stops);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $stops = $this->service->search($request->search);
        return view('admin.stops.index')->with('stops', $stops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StopRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('admin.stops.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.stops.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the stops.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stop = $this->service->find($id);
        return view('admin.stops.show')->with('stop', $stop);
    }

    /**
     * Show the form for editing the stops.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stop = $this->service->find($id);
        return view('admin.stops.edit')->with('stop', $stop);
    }

    /**
     * Update the stops in storage.
     *
     * @param  \Illuminate\Http\StopRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StopRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the stops from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.stops.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.stops.index'))->with('message', 'Failed to delete');
    }
}
