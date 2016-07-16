<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'fares.store']) !!}

    @form_maker_table("fares")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>