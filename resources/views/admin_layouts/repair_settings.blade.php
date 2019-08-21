@extends('adminlte::page')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица записей на ремонт</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Пользователь</th>
                                <th>Ремонтируемый узел</th>
                                <th>Дата</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appoint as $appoints)
                                <tr>
                                    <td>{{$appoints->users_id}}</td>
                                    <td>{{$appoints->type_service}}</td>
                                    <td>{{$appoints->created_at}}</td>
                                <td>{{$appoints->users->id}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
