@extends ('admin.layout')

@section ('content')
    <h1 class="page-header">Users</h1>

    <div class="table-responsive">
        @include ('admin.users._list')
    </div>
@stop