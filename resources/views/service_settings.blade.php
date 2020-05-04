@extends('adminlte::page')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://api-maps.yandex.ru/2.1/?apikey>&lang=sru_RU" type="text/javascript">
    </script>

    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer>

    </script>
@endsection
@section('content')
    <div id="app">
        <div class="container">
            <admin-table-component/>
        </div>
    </div>
@endsection