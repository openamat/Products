@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="" class="pull-right raw-margin-top-24 raw-margin-left-24" method="post" action="/admin/shapes/search">
                {!! csrf_field() !!}
                <input class="form-control" name="search" placeholder="Search">
            </form>
            <a class="btn btn-default pull-right raw-margin-top-24" href="{{ url('admin/shapes/create') }}">Create New Shape</a>
            <h1>Shapes</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped raw-margin-top-24">

                <thead>
                <th>Shape</th>
                <th class="text-right">Action</th>
                </thead>
                <tbody>
                @if($shapes->isEmpty())
                    <div class="well text-center">No shapes found.</div>
                @else
                    @foreach($shapes as $shape)
                        <tr>
                            <td>{{ $shape->shape_id }}</td>
                            <td>
                                <form method="post" action="{!! url('admin/shapes/'.$shape->id) !!}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this shape?')"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                                <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/shapes/'.$shape->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop
