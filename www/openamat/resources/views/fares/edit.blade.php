<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($fare, ['route' => ['fares.update', $fare->id], 'method' => 'patch']) !!}

    @form_maker_object($fare, FormMaker::getTableColumns('fares'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
