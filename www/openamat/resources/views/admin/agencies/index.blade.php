@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="" class="pull-right raw-margin-top-24 raw-margin-left-24" method="post" action="/admin/agencies/search">
                {!! csrf_field() !!}
                <input class="form-control" name="search" placeholder="Search">
            </form>
            <a class="btn btn-default pull-right raw-margin-top-24" href="{{ url('admin/agencies/create') }}">Create New Agency</a>
            <h1>Agencies</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped raw-margin-top-24">

                <thead>
                <th>Agency</th>
                <th class="text-right">Action</th>
                </thead>
                <tbody>
                @if($agencies->isEmpty())
                    <div class="well text-center">No agencies found.</div>
                @else
                    @foreach($agencies as $agency)
                        <tr>
                            <td>{{ $agency->name }}</td>
                            <td>
                                <form method="post" action="{!! url('admin/agencies/'.$agency->id) !!}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this agency?')"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                                <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/agencies/'.$agency->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>

            </table>
        </div>
    </div>

@stop
