<div class="">
    {{ Session::get('message') }}
</div>

<div class="container">

    {!! Form::model($farerule, ['route' => ['farerules.update', $farerule->id], 'method' => 'patch']) !!}

    @form_maker_object($farerule, FormMaker::getTableColumns('farerules'))

    {!! Form::submit('Update') !!}

    {!! Form::close() !!}
</div>
