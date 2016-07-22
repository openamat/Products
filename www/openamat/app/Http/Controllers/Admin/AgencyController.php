<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AgencyService;
use App\Http\Requests\AgencyRequest;

class AgencyController extends Controller
{
    public function __construct(AgencyService $agencyService)
    {
        $this->service = $agencyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agencies = $this->service->paginated();
        return view('admin.agencies.index')->with('agencies', $agencies);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $agencies = $this->service->search($request->search);
        return view('admin.agencies.index')->with('agencies', $agencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AgencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('admin.agencies.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.agencies.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the agencies.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = $this->service->find($id);
        return view('agencies.show')->with('agency', $agency);
    }

    /**
     * Show the form for editing the agencies.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = $this->service->find($id);
        return view('admin.agencies.edit')->with('agency', $agency);
    }

    /**
     * Update the agencies in storage.
     *
     * @param  \Illuminate\Http\AgencyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the agencies from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.agencies.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.agencies.index'))->with('message', 'Failed to delete');
    }
}
