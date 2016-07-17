<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'trips.store']) !!}

    @form_maker_table("trips")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>