@extends('adminlte::page')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://api-maps.yandex.ru/2.1/?apikey>&lang=sru_RU" type="text/javascript">
    </script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer>

    </script>
@endsection
@section('content')
    <section class="content">
        <div id="app">
            <form-employee-component/>
        </div>
    </section>
@endsection
