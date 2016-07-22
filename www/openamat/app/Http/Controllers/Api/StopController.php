<?php

namespace App\Http\Controllers\Api;

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
        return response()->json($stops);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $stops = $this->service->search($request->search);
        return response()->json($stops);
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
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create stop'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stop = $this->service->find($id);
        return response()->json($stop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StopRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StopRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to update stop'], 500);
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
            return response()->json(['success' => 'stop was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete stop'], 500);
    }
}
