<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($farerules);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $farerules = $this->service->search($request->search);
        return response()->json($farerules);
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
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create farerule'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $farerule = $this->service->find($id);
        return response()->json($farerule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FareRuleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FareRuleRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to update farerule'], 500);
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
            return response()->json(['success' => 'farerule was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete farerule'], 500);
    }
}
