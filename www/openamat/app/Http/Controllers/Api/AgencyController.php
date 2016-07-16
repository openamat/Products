<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($agencies);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $agencies = $this->service->search($request->search);
        return response()->json($agencies);
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
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create agency'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = $this->service->find($id);
        return response()->json($agency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AgencyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to update agency'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return response()->json(['success' => 'agency was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete agency'], 500);
    }
}
