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
        @foreach($admins as $index => $admin)
        <tr>
            @if(in_array('index', $colsIndexName))
            <td>{{++$index}}</td>
            @endif
            @if(in_array('name', $colsIndexName))
            <td>{{strip_tags($admin['name'])}}</td>
            @endif
            @if(in_array('role', $colsIndexName))
            <td>{{$admin['role']}}</td>
            @endif
            @if(in_array('email', $colsIndexName))
            <td>{{$admin['email']}}</td>
            @endif
            @if(in_array('mobile', $colsIndexName))
            <td>{{$admin['mobile']}}</td>
            @endif
            @if(in_array('gender', $colsIndexName))
            <td>{{$admin['gender']}}</td>
            @endif
            @if(in_array('country', $colsIndexName))
            <td>{{$admin['country']}}</td>
            @endif
        </tr>
        @endforeach
        <!-- and so on... -->
    </tbody>
</table>
@endsection
