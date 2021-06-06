<html @if(config('app.locale') == 'ar') direction="rtl" dir="rtl" style="direction: rtl" @endif>
    <head>
        <style>
            .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }
            .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            }
            .styled-table th{
            color: #ffffff;
            }
            .styled-table th,
            .styled-table td {
            padding: 12px 15px;
            text-align: center;
            }
            .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
            }
            .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
            }
            .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
            }
            .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <h1>{{$title}}</h1>
            @yield('content')
        </div>
    </body>
</html>
