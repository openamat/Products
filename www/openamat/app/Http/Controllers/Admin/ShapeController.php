<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.shapes.index')->with('shapes', $shapes);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $shapes = $this->service->search($request->search);
        return view('admin.shapes.index')->with('shapes', $shapes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shapes.create');
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
            return redirect(route('admin.shapes.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('admin.shapes.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the shapes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shape = $this->service->find($id);
        return view('admin.shapes.show')->with('shape', $shape);
    }

    /**
     * Show the form for editing the shapes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shape = $this->service->find($id);
        return view('admin.shapes.edit')->with('shape', $shape);
    }

    /**
     * Update the shapes in storage.
     *
     * @param  \Illuminate\Http\ShapeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShapeRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the shapes from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('admin.shapes.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('admin.shapes.index'))->with('message', 'Failed to delete');
    }
}
