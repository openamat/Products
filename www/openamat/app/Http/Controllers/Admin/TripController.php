<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TripService;
use App\Http\Requests\TripRequest;

class TripController extends Controller
{
    public function __construct(TripService $tripService)
    {
        $this->service = $tripService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trips = $this->service->paginated();
        return view('admin.trips.index')->with('trips', $trips);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $trips = $this->service->search($request->search);
        return view('admin.trips.index')->with('trips', $trips);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TripRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('admin.trips.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.trips.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the trips.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = $this->service->find($id);
        return view('admin.trips.show')->with('trip', $trip);
    }

    /**
     * Show the form for editing the trips.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trip = $this->service->find($id);
        return view('admin.trips.edit')->with('trip', $trip);
    }

    /**
     * Update the trips in storage.
     *
     * @param  \Illuminate\Http\TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the trips from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.trips.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.trips.index'))->with('message', 'Failed to delete');
    }
}
