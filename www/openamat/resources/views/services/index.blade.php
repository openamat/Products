<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'services.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Services</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('services.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($services->isEmpty())
            <div class="well text-center">No services found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>
                            <a href="{!! route('services.edit', [$service->id]) !!}">{{ $service->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('services.edit', [$service->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('services.edit', [$service->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this service?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $services; !!}
            </div>
        @endif
    </div>
</div>