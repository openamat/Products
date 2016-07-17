@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="" class="pull-right raw-margin-top-24 raw-margin-left-24" method="post" action="/admin/trips/search">
                {!! csrf_field() !!}
                <input class="form-control" name="search" placeholder="Search">
            </form>
            <a class="btn btn-default pull-right raw-margin-top-24" href="{{ url('admin/trips/create') }}">Create New Trip</a>
            <h1>Trips</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped raw-margin-top-24">

                <thead>
                <th>Route</th>
                <th>Service</th>
                <th>Trip</th>
                <th>Headsign</th>
                <th>Direction</th>
                <th>Block</th>
                <th>Shape</th>
                <th class="text-right">Action</th>
                </thead>
                <tbody>
                @if($trips->isEmpty())
                    <div class="well text-center">No trips found.</div>
                @else
                    @foreach($trips as $trip)
                        <tr>
                            <td>{{ $trip->route_id }}</td>
                            <td>{{ $trip->service_id }}</td>
                            <td>{{ $trip->trip_id }}</td>
                            <td>{{ $trip->trip_headsign }}</td>
                            <td>{{ $trip->direction_id }}</td>
                            <td>{{ $trip->block_id }}</td>
                            <td>{{ $trip->shape_id }}</td>
                            <td>
                                <form method="post" action="{!! url('admin/trips/'.$trip->id) !!}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this trip?')"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                                <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/trips/'.$trip->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop
