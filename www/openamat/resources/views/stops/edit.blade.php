<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($stop, ['route' => ['stops.update', $stop->id], 'method' => 'patch']) !!}

    @form_maker_object($stop, FormMaker::getTableColumns('stops'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
