<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'stops.store']) !!}

    @form_maker_table("stops")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>