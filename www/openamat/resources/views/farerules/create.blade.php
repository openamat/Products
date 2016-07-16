<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::open(['route' => 'farerules.store']) !!}

    @form_maker_table("farerules")

    {!! Form::submit('Save') !!}

    {!! Form::close() !!}

</div>