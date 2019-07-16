@extends('adminlte::page')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица пользователей</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Имя пользователя</th>
                                <th>Описание</th>
                                <th>Время записи</th>
                                <th>Результат работы</th>
                                <!--TODO: Отображать не ID, а название-->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appoint as $appoints)
                                <tr>
                                    <td>{{$appoints->name}}</td>
                                    <td>{{$appoints->description}}</td>
                                    <td>{{$appoints->created_at}}</td>
                                    {{--<td>{{$appoints->users->id}}</td>--}}
                                    <!--TODO:Добавить кнопки изменить и др.-->
                                    <!--TODO:Вместо кнопок ссылки-иконки-->
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