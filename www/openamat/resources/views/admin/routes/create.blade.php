@extends('dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Route Admin: Create</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">


            <form method="POST" action="/admin/routes">
                {!! csrf_field() !!}

                @form_maker_table("routes")

                <div class="col-md-12 raw-margin-top-24">
                    <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>

@stop