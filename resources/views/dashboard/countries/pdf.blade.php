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
        @foreach($countries as $index => $country)
        <tr>
            @if(in_array('index', $colsIndexName))
            <td>{{++$index}}</td>
            @endif
            @if(in_array('name', $colsIndexName))
            <td>{{strip_tags($country['name'])}}</td>
            @endif
            @if(in_array('name_code', $colsIndexName))
            <td>{{$country['name_code']}}</td>
            @endif
            @if(in_array('phone_code', $colsIndexName))
            <td>{{$country['phone_code']}}</td>
            @endif
            @if(in_array('status', $colsIndexName))
            <td>{{strip_tags($country['status'])}}</td>
            @endif
        </tr>
        @endforeach
        <!-- and so on... -->
    </tbody>
</table>
@endsection
