<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'stops.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Stops</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('stops.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($stops->isEmpty())
            <div class="well text-center">No stops found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($stops as $stop)
                    <tr>
                        <td>
                            <a href="{!! route('stops.edit', [$stop->id]) !!}">{{ $stop->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('stops.edit', [$stop->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('stops.edit', [$stop->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this stop?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $stops; !!}
            </div>
        @endif
    </div>
</div>