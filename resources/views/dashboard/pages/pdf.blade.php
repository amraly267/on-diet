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
        @foreach($pages as $index => $page)
        <tr>
            @if(in_array('index', $colsIndexName))
            <td>{{++$index}}</td>
            @endif
            @if(in_array('title', $colsIndexName))
            <td>{{$page['title']}}</td>
            @endif
            @if(in_array('is_web', $colsIndexName))
            <td>{{strip_tags($page['is_web'])}}</td>
            @endif
            @if(in_array('is_mobile', $colsIndexName))
            <td>{{strip_tags($page['is_mobile'])}}</td>
            @endif
            @if(in_array('status', $colsIndexName))
            <td>{{strip_tags($page['status'])}}</td>
            @endif
        </tr>
        @endforeach
        <!-- and so on... -->
    </tbody>
</table>
@endsection
