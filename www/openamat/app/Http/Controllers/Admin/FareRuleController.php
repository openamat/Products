<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FareRuleService;
use App\Http\Requests\FareRuleRequest;

class FareRuleController extends Controller
{
    public function __construct(FareRuleService $fareruleService)
    {
        $this->service = $fareruleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $farerules = $this->service->paginated();
        return view('admin.farerules.index')->with('farerules', $farerules);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $farerules = $this->service->search($request->search);
        return view('admin.farerules.index')->with('farerules', $farerules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.farerules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FareRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FareRuleRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('admin.farerules.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.farerules.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the farerules.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $farerule = $this->service->find($id);
        return view('admin.farerules.show')->with('farerule', $farerule);
    }

    /**
     * Show the form for editing the farerules.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farerule = $this->service->find($id);
        return view('admin.farerules.edit')->with('farerule', $farerule);
    }

    /**
     * Update the farerules in storage.
     *
     * @param  \Illuminate\Http\FareRuleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FareRuleRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the farerules from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.farerules.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.farerules.index'))->with('message', 'Failed to delete');
    }
}
