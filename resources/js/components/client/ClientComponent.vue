<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form class="form-horizontal">

                    <div class="form-group col-md-10">
                        <label class="control-label">Выберите марку автомобиля:</label>
                        <div>
                            <select v-model="vmBrand" @change.capture="onSelectBrand($event)"
                                    class="form-control">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in brands" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-10">
                        <label class="control-label col-md-offset-2 ">Выберите модель:</label>
                        <select v-model="vmModel" @change.capture="onSelectModel($event)"
                                class="form-control col-md-offset-2 ">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in models" :value="type.id"
                                    :key="type.id">{{type.title}}
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-10">
                        <label class="control-label">Выберите модификацию:</label>
                        <select v-model="vmCar" @change.capture="onSelectCar($event)"
                                class="form-control">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in cars" :value="type.id"
                                    :key="type.id">{{type.power}} л/c | {{type.engine_value}} л
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectBrand">Тип детали:</label>
                        <div>
                            <select v-model="vmTypeDetail" @change.capture="onSelectTypeDetail($event)"
                                    class="form-control" id="exampleSelectBrand">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in typeDetails" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectDetail">Выберите деталь:</label>
                        <div>
                            <select v-model="vmDetail" @change.capture="onSelectDetailCar($event)" class="form-control"
                                    id="exampleSelectDetail">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="item in detailsCars" :value="item.id"
                                        :key="item.id">{{item.detail.title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group  col-md-3">
                        <label class="control-label" for="count">Количество:</label>
                        <div>
                            <input type="text" id="count" class="form-control" v-model="vmCount"
                                   placeholder="1"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" @click="storeOrder()" class="btn btn-success col-md-3 col-xs-12 ">
                                Создать бронирование
                            </button>
                        </div>
                    </div>
                </form>

                <hr/>
                <h2>Мои бронирования</h2>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Статус</th>
                                <th>Деталь</th>
                                <th>Количество</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in reservations">
                            <tr>
                                <td>{{col.id}}</td>
                                <td v-if="col.status==='create'">В рассмотрении</td>
                                <td v-if="col.status==='accept'">Подтвеждена</td>
                                <td>{{col.goods.detail.title}}</td>
                                <td>{{col.count}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
                reservations: [],
                brands: [],
                models: [],
                cars: [],
                detailsCars: [],
                typeDetails: [],
                carSelected: '',
                modelSelected: '',
                vmCar: '',
                vmTypeDetail: '',
                detailCarSelected: '',
                showModal: false,
                //UserData
                createName: '',
                createEmail: '',
                createPassword: '',
                createPhone: '',
                createMarkCar: '',
                createModelCar: '',
                createGosNumberCar: '',
                vmDetail: '',
                vmModel: '',
                vmBrand: '',
                vmSupplier: '',
                vmCount: '',
                details: [],
                suppliers: [],
                detailSelected: '',
                supplierSelected: '',

                showModalImport: false,
            }
        },
        mounted() {
            this.update();
            this.getBrands();
            this.getTypeDetails();

        },
        methods: {
            newModal: function () {
                $('#addNew').modal('show');
            },
            update: function () {
                var formData = new FormData();
                formData.append('isAuth', true);
                axios.post('/user/reservations', formData).then((response) => {
                    this.reservations = response.data;
                    console.log(response.data);
                });
            },

            getBrands: function () {
                axios.get('/car/brands').then((response) => {
                    this.brands = response.data;
                    console.log(response.data);
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

            getCarByModels: function (model_id) {
                var formData = new FormData();
                formData.append('model_id', model_id);
                axios.post('/car/getCarsByModels', formData)
                    .then(response => {
                        this.cars = response.data;
                        console.log(response.data);
                    });
            },

            getTypeDetails: function () {
                axios.get('/type/details').then((response) => {
                    this.typeDetails = response.data;
                    console.log(response.data);
                });
            },

            getDetailCarByType: function (type_detail_id, car_id) {
                var formData = new FormData();
                formData.append('type_detail_id', type_detail_id);
                formData.append('car_id', car_id);

                axios.post('/assortment/type/details', formData)
                    .then(response => {
                        this.detailsCars = response.data;
                        console.log(response.data);
                    });
            },

            storeOrder: function () {
                var formData = new FormData();
                formData.append('status', 'create');
                formData.append('isAuth', true);
                formData.append('detail_car_id', this.detailCarSelected);
                formData.append('count', this.vmCount);
                axios.post('/reservations', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },
            acceptReservation: function (id) {
                axios.put('/reservations/' + id, {
                    status: 'accept'
                }).then((response) => {
                    this.update();
                });
            },
            deleteReservation: function (id) {
                axios.delete('/reservations/' + id).then((response) => {
                    this.update();
                });
            },
            onSelectBrand(e) {
                this.brandSelected = e.target.value;
                this.getModelsByBrand(this.brandSelected)
            },
            onSelectModel(e) {
                this.modelSelected = e.target.value;
                this.getCarByModels(this.modelSelected)
            },
            onSelectCar(e) {
                this.carSelected = e.target.value;
            },
            onSelectTypeDetail(e) {
                this.typeDetailSelected = e.target.value;
                this.getDetailCarByType(this.typeDetailSelected, this.carSelected)
            },
            onSelectDetail(e) {
                this.detailSelected = e.target.value;
            },
            onSelectDetailCar(e) {
                this.detailCarSelected = e.target.value;
            },
        }
    }

</script>

