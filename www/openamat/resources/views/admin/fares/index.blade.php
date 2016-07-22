@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="" class="pull-right raw-margin-top-24 raw-margin-left-24" method="post" action="/admin/fares/search">
                {!! csrf_field() !!}
                <input class="form-control" name="search" placeholder="Search">
            </form>
            <a class="btn btn-default pull-right raw-margin-top-24" href="{{ url('admin/fares/create') }}">Create New Fare</a>
            <h1>Fare</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped raw-margin-top-24">

                <thead>
                <th>Fare</th>
                <th class="text-right">Action</th>
                </thead>
                <tbody>
                @if($fares->isEmpty())
                    <div class="well text-center">No fares found.</div>
                @else
                    @foreach($fares as $fare)
                        <tr>
                            <td>{{ $fare->fare_id }}</td>
                            <td>
                                <form method="post" action="{!! url('admin/fares/'.$fare->id) !!}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this fare?')"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                                <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/fares/'.$fare->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop
