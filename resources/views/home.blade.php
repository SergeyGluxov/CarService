<!-- Страница после успешной авторизации -->
@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <div class="container" style="background-color: #2A313C; color: white">
    @if($cars!=null)
        <!--Название автомобиля-->
            <div class="row">
                <div class="col-md-6">

                    <span style="font-size: 24pt">{{$cars->brand}} {{$cars->model}}</span>
                    <img src="/uploads/cars_image/{{$cars->image}}" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <i id="icon_edit" class="fas fa-edit fa-2x" data-toggle="modal" data-target="#basicModal"
                       style="float: right; margin-top: 5px"></i>
                    <div style="margin-top: 50px;">
                        <passport-component></passport-component>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 30px">
                    <h2 style="margin-left: 10px">Основные характеристики состояний автомобиля</h2>
                    <div class="accordion" id="accordionExample">
                        <div class="card border_card">
                            <div class="card-header header_card" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo" style="font-size: 14pt">
                                        Общее состояние автомобиля:
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                 data-parent="#accordionExample">
                                <div class="card-body body_card">
                                    <h4>Состояние кузова:</h4>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 80%;"
                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%
                                        </div>
                                    </div>
                                    <h4>Состояние двигателя:</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                        </div>
                                    </div>
                                    <h4>Состояние подвески:</h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border_card">
                            <div class="card-header header_card" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                        Разворачиваемая панель #3
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                 data-parent="#accordionExample">
                                <div class="card-body body_card">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                    aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($cars==null)
            <h1>Нет авто</h1>
            <button type="submit" class="btn btn-primary btn" data-toggle="modal" data-target="#basicModal">
                {{ __('Добавить авто') }}
            </button>
        @endif
    </div>
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Редактор автомобиля</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('addCar')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Марка:</label>
                            <select id="brand" name="brand" class="form-control">
                                @foreach($allcars as $car)
                                    <option>{{$car->brand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Модель:</label>
                            <select id="model" name="model" class="form-control">
                                @foreach($allcars as $car)
                                    <option>{{$car->model}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Гос. номер:</label>
                            <input type="text" class="form-control" id="gos_number" name="gos_number"
                                   placeholder="А000АА">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
