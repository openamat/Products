<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'services.store']) !!}

    @form_maker_table("services")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>