<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'fares.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">Fares</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('fares.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($fares->isEmpty())
            <div class="well text-center">No fares found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($fares as $fare)
                    <tr>
                        <td>
                            <a href="{!! route('fares.edit', [$fare->id]) !!}">{{ $fare->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('fares.edit', [$fare->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('fares.edit', [$fare->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this fare?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $fares; !!}
            </div>
        @endif
    </div>
</div>