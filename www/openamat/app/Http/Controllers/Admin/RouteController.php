<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.routes.index')->with('routes', $routes);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $routes = $this->service->search($request->search);
        return view('admin.routes.index')->with('routes', $routes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.routes.create');
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
            return redirect(route('admin.routes.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.routes.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the routes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = $this->service->find($id);
        return view('admin.routes.show')->with('route', $route);
    }

    /**
     * Show the form for editing the routes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = $this->service->find($id);
        return view('admin.routes.edit')->with('route', $route);
    }

    /**
     * Update the routes in storage.
     *
     * @param  \Illuminate\Http\RouteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the routes from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.routes.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.routes.index'))->with('message', 'Failed to delete');
    }
}
