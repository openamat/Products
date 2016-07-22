<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FareService;
use App\Http\Requests\FareRequest;

class FareController extends Controller
{
    public function __construct(FareService $fareService)
    {
        $this->service = $fareService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fares = $this->service->paginated();
        return view('admin.fares.index')->with('fares', $fares);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $fares = $this->service->search($request->search);
        return view('admin.fares.index')->with('fares', $fares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FareRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('admin.fares.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.fares.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the fares.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fare = $this->service->find($id);
        return view('admin.fares.show')->with('fare', $fare);
    }

    /**
     * Show the form for editing the fares.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fare = $this->service->find($id);
        return view('admin.fares.edit')->with('fare', $fare);
    }

    /**
     * Update the fares in storage.
     *
     * @param  \Illuminate\Http\FareRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FareRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the fares from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.fares.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.fares.index'))->with('message', 'Failed to delete');
    }
}
