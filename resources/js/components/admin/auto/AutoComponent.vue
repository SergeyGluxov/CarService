//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Форма добавления нового автомобиля</h2>

                <form class="form-horizontal">
                    <div class="form-group col-md-6">
                        <label class="control-label" for="exampleSelectBrand">Выберите марку:</label>
                        <div>
                            <select v-model="vmBrand" @change.capture="onSelectBrand($event)" class="form-control" id="exampleSelectBrand">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in brands" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-7">
                        <label class="control-label" for="exampleSelectModel">Выберите модель:</label>
                        <div>
                            <select v-model="vmModel" @change.capture="onSelectModel($event)" class="form-control" id="exampleSelectModel" >
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in models" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="control-label col-md-offset-3" for="inputYear">Введите год:</label>
                        <div class="col-md-offset-3">
                            <input type="text" class="form-control" id="inputYear" v-model="inputYear"
                                   placeholder="1999"/>
                        </div>
                    </div>

                    <div class="form-group  col-md-4">
                        <label class="control-label" for="engineValue">Объем двигателя:</label>
                        <div class="">
                            <input type="text"  id="engineValue" class="form-control" v-model="inputEngineValue"
                            placeholder="2.0"/>
                        </div>
                    </div>

                    <div class="form-group  col-md-4">
                        <label class="control-label col-md-offset-3" for="power">Мощность(л.c):</label>
                        <div class="col-md-offset-3">
                            <input type="text" id="power" class="form-control" v-model="inputPower"
                                   placeholder="155"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-9">
                            <button type="button" @click="storeCar()" class="btn btn-success">
                                Добавить автомобиль
                            </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <h2>Список автомобилей</h2>

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
                                <th>Год</th>
                                <th>Объем двигателя</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in cars">
                            <tr>
                                <td>{{col.model.brand.title}}</td>
                                <td>{{col.model.title}}</td>
                                <td>{{col.power}}</td>
                                <td>{{col.year}}</td>
                                <td>{{col.engine_value}}</td>
                                <td>
                                    <div type="button" class="btn btn-danger" v-on:click="deleteCar(col.id)">
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
                models: [],
                vmModel: '',
                vmBrand: '',
                inputPower: '',
                inputEngineValue: '',
                inputYear: '',
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

            getModelsByBrand: function (brand_id) {
                var formData = new FormData();
                formData.append('brand_id', brand_id);
                axios.post('/car/models/getModelsByBrand', formData)
                    .then(response => {
                        this.models = response.data;
                    });
            },

            storeCar: function () {
                var formData = new FormData();
                formData.append('model', this.modelSelected);
                formData.append('engine_value', this.inputEngineValue);
                formData.append('power', this.inputPower);
                formData.append('year', this.inputYear);

                axios.post('/cars', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                        this.vmBrand = ""
                        this.vmModel = ""
                        this.inputEngineValue = ""
                        this.inputPower = ""
                        this.inputYear = ""
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },

            update: function () {
                axios.get('/cars').then((response) => {
                    this.cars = response.data;
                    console.log(response.data);
                });
            },
            deleteCar: function (id) {
                axios.delete('/cars/' + id).then((response) => {
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
                this.getModelsByBrand(this.brandSelected)
            },
        }
    }
</script>
