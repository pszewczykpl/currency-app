@extends('layouts.app')

@section('content')
    <table>
        <head>
            <tr>
                <th>Waluta</th>
                <th>Kurs</th>
            </tr>
        </head>
        <body>
            @foreach ($currencies as $currency)
                <tr>
                    <td>{{ $currency->name }}</td>
                    <td>{{ $currency->exchange_rate }}</td>
                </tr>
            @endforeach
        </body>
    </table>
@endsection
