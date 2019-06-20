<!-- Страница после успешной авторизации -->
@extends('layouts.app')

@section('content')

    <div class="container">
    @if($cars->count() != null)
        <!--Название автомобиля-->
            <div class="row">
                <div class="col-md-6">
                    @foreach($cars as $car)
                        <h2>{{$car->brend}} {{$car->model}}</h2>
                        <img src="/uploads/cars_image/{{$car->image}}" class="img-fluid">
                    @endforeach
                </div>
                <div class="col-md-6">
                    <!--Основные характеристики-->

                </div>
            </div>
        @endif
        @if(count($cars)==0)
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
                    <h4 class="modal-title" id="myModalLabel">Добавление авто</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('show')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Марка:</label>
                            <select id="mark" name="mark" class="form-control">
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
                            <input type="text" class="form-control" id="gos_number" name="gos_number" placeholder="А000АА">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Добавить авто</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
