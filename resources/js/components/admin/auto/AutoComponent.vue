//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Автомобили</h2>
                <form class="form-inline" method="GET" action="/admin/appointment/export">

                    <select v-model="vmBrand" @change.capture="onSelectBrand($event)"
                            class="form-control">
                        <option value="" disabled selected>Выбрать...</option>
                        <option v-for="type in brands" :value="type.id"
                                :key="type.id">{{type.title}}
                        </option>
                    </select>

                    <select v-model="vmModel" @change.capture="onSelectModel($event)"
                            class="form-control">
                        <option value="" disabled selected>Выбрать...</option>
                        <option v-for="type in models" :value="type.id"
                                :key="type.id">{{type.title}}
                        </option>
                    </select>

                    <input type="text" v-model="vmModel" class="form-control" placeholder="Введите наименование "/>
                    <button id="show-modal" type="button" class="btn btn-success" v-on:click="storeModel()">
                        Добавить
                    </button>
                </form>

                <div class="card">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Бренд</th>
                                <th>Модель</th>
                                <th>Мощность</th>
                                <th>Объем двигателя</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in cars">
                            <tr>
                                <td>{{col.model.brand.title}}</td>
                                <td>{{col.model.title}}</td>
                                <td>{{col.power}}</td>
                                <td>{{col.engine_value}}</td>
                                <td>
                                    <div type="button" class="btn btn-danger" v-on:click="deleteUser(col.id)">
                                        <i class="fas fa-times " aria-hidden="true"></i></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div v-if="showModal">
                <div class="modal fade-in" style="display: block;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" @click="showModal=false">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Новая пользователь</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="createName">Введите имя:</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" v-model="createName"
                                                   id="createName"
                                                   placeholder="Иванов Иван Иванович"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="createName">Введите номер
                                            телефона:</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" v-model="createPhone"
                                                   id="createPhone"
                                                   placeholder="+79505728020"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="createEmail">Введите
                                            эл.почту:</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" v-model="createEmail"
                                                   id="createEmail"
                                                   placeholder="ivanov.ii@gmail.com"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="createPassword">Введите
                                            пароль:</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" v-model="createPassword"
                                                   id="createPassword"
                                                   placeholder="*****"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="createMarkCar">Марка и модель
                                            авто:</label>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" v-model="createMarkCar"
                                                   id="createMarkCar"
                                                   placeholder="Nissan"/>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" v-model="createModelCar"
                                                   id="createModelCar"
                                                   placeholder="Patrol"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3" for="createGosNumberCar">Введите гос.
                                            номер:</label>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" v-model="createGosNumberCar"
                                                   id="createGosNumberCar"
                                                   placeholder="X001A142"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-offset-6 col-xs-9">
                                            <button type="button" @click="store" class="btn btn-success">Создать
                                                пользователя
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModalImport">
            <div class="modal fade-in" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="showModalImport=false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Импорт пользователей из Excel</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form" method="POST" enctype="multipart/form-data"
                                  action="/admin/cars/import">
                                <input type="file" id="excelUploadcars" name="excelUploadcars">
                                <br>
                                <button type="submit" class="btn btn-primary">Импорт из файла</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        data: function () {
            return {
                cars: [],
                brands: [],
                vmModel: '',
                vmBrand: '',
                modelSelected: '',
                brandSelected: '',

                showModal: false,
                //UserData
                createName: '',
                createEmail: '',
                createPassword: '',
                createPhone: '',
                createMarkCar: '',
                createModelCar: '',
                createGosNumberCar: '',

                showModalImport: false,
            }
        },
        mounted() {
            this.update();
            this.getBrands();
        },
        methods: {
            newModal: function () {
                $('#addNew').modal('show');
            },

            getBrands: function () {
                axios.get('/car/brands').then((response) => {
                    this.brands = response.data;
                    console.log(response.data);
                });
            },

            getModels: function (brand_id) {
                var formData = new FormData();
                formData.append('brand_id', brand_id);
                axios.post('/car/models', formData)
                    .then(response => {
                        this.models = response.data;
                    });
            },


            update: function () {
                axios.get('/cars').then((response) => {
                    this.cars = response.data;
                    console.log(response.data);
                });
            },
            deleteUser: function (id) {
                axios.delete('/api/cars/' + id).then((response) => {
                    this.cars = response.data;
                    this.update();
                    console.log(response.data);
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            },
            //---------------------------Callbacks----------------------------------------------------------------------
            onSelectModel(e) {
                this.modelSelected = e.target.value;
            },

            onSelectBrand(e) {
                this.brandSelected = e.target.value;
            },
        }
    }
</script>
