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
        @foreach($areas as $index => $area)
        <tr>
            @if(in_array('index', $colsIndexName))
            <td>{{++$index}}</td>
            @endif
            @if(in_array('name', $colsIndexName))
            <td>{{strip_tags($area['name'])}}</td>
            @endif
            @if(in_array('city', $colsIndexName))
            <td>{{$area['city']}}</td>
            @endif
            @if(in_array('status', $colsIndexName))
            <td>{{strip_tags($area['status'])}}</td>
            @endif
        </tr>
        @endforeach
        <!-- and so on... -->
    </tbody>
</table>
@endsection
