<div class="container">

    <div class="">
        {{ Session::get('message') }}
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::open(['route' => 'farerules.search']) !!}
            <input class="form-control form-inline pull-right" name="search" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="pull-left">FareRules</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('farerules.create') !!}">Add New</a>
    </div>

    <div class="row">
        @if($farerules->isEmpty())
            <div class="well text-center">No fareRules found.</div>
        @else
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th width="50px">Action</th>
                </thead>
                <tbody>
                @foreach($farerules as $farerule)
                    <tr>
                        <td>
                            <a href="{!! route('farerules.edit', [$farerule->id]) !!}">{{ $farerule->name }}</a>
                        </td>
                        <td>
                            <a href="{!! route('farerules.edit', [$farerule->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="post" action="{!! route('farerules.edit', [$farerule->id]) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this farerule?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                {!! $farerules; !!}
            </div>
        @endif
    </div>
</div>