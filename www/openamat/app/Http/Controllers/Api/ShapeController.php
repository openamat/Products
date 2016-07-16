<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ShapeService;
use App\Http\Requests\ShapeRequest;

class ShapeController extends Controller
{
    public function __construct(ShapeService $shapeService)
    {
        $this->service = $shapeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shapes = $this->service->paginated();
        return response()->json($shapes);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $shapes = $this->service->search($request->search);
        return response()->json($shapes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ShapeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShapeRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create shape'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shape = $this->service->find($id);
        return response()->json($shape);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ShapeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShapeRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to update shape'], 500);
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
            return response()->json(['success' => 'shape was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete shape'], 500);
    }
}
