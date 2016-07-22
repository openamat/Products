<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($trip, ['route' => ['trips.update', $trip->id], 'method' => 'patch']) !!}

    @form_maker_object($trip, FormMaker::getTableColumns('trips'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
