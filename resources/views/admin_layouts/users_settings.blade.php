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
                                <th>Имя</th>
                                <th>Эл. почта</th>
                                <th>Зарегистрирован</th>
                                <th>Последнее изменение</th>
                                <!--TODO: Отображать не ID, а название-->
                                <th>Автомобиль</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>{{$user->cars_id}}</td>
                                    <!--TODO:Добавить кнопки изменить и др.-->
                                    <!--TODO:Вместо кнопок ссылки-иконки-->
                                    <td><button>Удалить</button></td>
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