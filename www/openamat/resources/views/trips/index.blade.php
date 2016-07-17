<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'trips.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Trips</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('trips.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($trips->isEmpty())
            <div class="well text-center">No trips found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($trips as $trip)
                    <tr>
                        <td>
                            <a href="{!! route('trips.edit', [$trip->id]) !!}">{{ $trip->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('trips.edit', [$trip->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('trips.edit', [$trip->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this trip?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $trips; !!}
            </div>
        @endif
    </div>
</div>