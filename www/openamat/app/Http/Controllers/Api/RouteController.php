<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RouteService;
use App\Http\Requests\RouteRequest;

class RouteController extends Controller
{
    public function __construct(RouteService $routeService)
    {
        $this->service = $routeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routes = $this->service->paginated();
        return response()->json($routes);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $routes = $this->service->search($request->search);
        return response()->json($routes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RouteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to create route'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = $this->service->find($id);
        return response()->json($route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RouteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['error' => 'Unable to update route'], 500);
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
            return response()->json(['success' => 'route was deleted'], 200);
        }

        return response()->json(['error' => 'Unable to delete route'], 500);
    }
}
