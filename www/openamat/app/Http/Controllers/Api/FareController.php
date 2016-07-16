<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($fares);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $fares = $this->service->search($request->search);
        return response()->json($fares);
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
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create fare'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fare = $this->service->find($id);
        return response()->json($fare);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FareRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FareRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to update fare'], 500);
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
            return response()->json(['success' => 'fare was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete fare'], 500);
    }
}
