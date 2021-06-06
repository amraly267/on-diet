@extends(config('dashboard.resource_folder').'partials.pdf_layout')
@section('content')

<table class="styled-table">
    <thead>
        <tr>
            @foreach($visibleColsNames as $columnName)
                <th>{{$columnName}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $index => $role)
        <tr>
            @if(in_array('index', $colsIndexName))
            <td>{{++$index}}</td>
            @endif
            @if(in_array('name', $colsIndexName))
            <td>{{strip_tags($role['name'])}}</td>
            @endif
            @if(in_array('permissions', $colsIndexName))
            <td>{{strip_tags($role['permissions'])}}</td>
            @endif
        </tr>
        @endforeach
        <!-- and so on... -->
    </tbody>
</table>
@endsection
