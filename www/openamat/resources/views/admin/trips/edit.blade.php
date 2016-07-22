@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Trip Admin: Edit</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/admin/trips/{{ $trip->id }}">
                <input name="_method" type="hidden" value="PATCH">
                {!! csrf_field() !!}

                @form_maker_object($trip, FormMaker::getTableColumns('trips'))

                <div class="col-md-12 raw-margin-top-24">
                    <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

@stop