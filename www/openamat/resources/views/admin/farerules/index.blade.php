@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="" class="pull-right raw-margin-top-24 raw-margin-left-24" method="post" action="/admin/farerules/search">
                {!! csrf_field() !!}
                <input class="form-control" name="search" placeholder="Search">
            </form>
            <a class="btn btn-default pull-right raw-margin-top-24" href="{{ url('admin/farerules/create') }}">Create New Fare Rules</a>
            <h1>Fare Rules</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped raw-margin-top-24">

                <thead>
                <th>Fare Rules</th>
                <th>Route Id</th>
                <th>Origin Id</th>
                <th>Destination Id</th>
                <th class="text-right">Action</th>
                </thead>
                <tbody>
                @if($farerules->isEmpty())
                    <div class="well text-center">No fare rules found.</div>
                @else
                    @foreach($farerules as $farerule)
                        <tr>
                            <td>{{ $farerule->fare_id }}</td>
                            <td>{{ $farerule->route_id }}</td>
                            <td>{{ $farerule->origin_id }}</td>
                            <td>{{ $farerule->destination_id }}</td>
                            <td>
                                <form method="post" action="{!! url('admin/farerules/'.$farerule->id) !!}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this fare rule?')"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                                <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/farerules/'.$farerule->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop
