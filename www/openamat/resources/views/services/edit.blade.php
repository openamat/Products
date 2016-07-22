<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($service, ['route' => ['services.update', $service->id], 'method' => 'patch']) !!}

    @form_maker_object($service, FormMaker::getTableColumns('services'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
