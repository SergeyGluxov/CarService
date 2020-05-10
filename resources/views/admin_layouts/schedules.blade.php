@extends('adminlte::page')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://api-maps.yandex.ru/2.1/?apikey>&lang=sru_RU" type="text/javascript">
    </script>
    <script src="{{ asset('js/app.js') }}"  type="text/javascript" defer>
    </script>
    <script src="AdminLTE%202%20%20%20Modals_files/jquery.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="AdminLTE%202%20%20%20Modals_files/bootstrap.js"></script>
    <!-- FastClick -->
    <script src="AdminLTE%202%20%20%20Modals_files/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="AdminLTE%202%20%20%20Modals_files/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="AdminLTE%202%20%20%20Modals_files/demo.js"></script>
@endsection
@section('content')
    <section class="content">
        <div id="app">
            <schedules-table-component/>
        </div>
    </section>
@endsection
