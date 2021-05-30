//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Форма добавления нового товара</h2>


                <form class="form-horizontal" method="GET" action="/admin/assortment/export">
                    <div class="form-group col-md-3">

                        <button type="submit" class="btn btn-primary form-control" @click="exportExcel">
                            <i class="fa fa-download" aria-hidden="true"></i> Экспортировать | Excel
                        </button>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-3">
                        <button id="show-modal-import" type="button" class="btn btn-primary form-control"
                                @click="showModalImport = true">
                            <i class="fa fa-upload" aria-hidden="true"></i> Импортировать | Excel
                        </button>
                    </div>

                </form>


                <form class="form-horizontal">

                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectBrand">Выберите деталь:</label>
                        <div>
                            <select v-model="vmDetail" @change.capture="onSelectDetail($event)" class="form-control"
                                    id="exampleSelectBrand">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in details" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group  col-md-3">
                        <label class="control-label">Выберите бренд:</label>
                        <select v-model="vmBrand" @change.capture="onSelectBrand($event)"
                                class="form-control">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in brands" :value="type.id"
                                    :key="type.id">{{type.title}}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <label class="control-label col-md-offset-2 ">Выберите модель:</label>
                        <select v-model="vmModel" @change.capture="onSelectModel($event)"
                                class="form-control col-md-offset-2 ">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in models" :value="type.id"
                                    :key="type.id">{{type.title}}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Выберите модификацию:</label>
                        <select v-model="vmCar" @change.capture="onSelectCar($event)"
                                class="form-control">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in car" :value="type.id"
                                    :key="type.id">{{type.power}} л/c | {{type.engine_value}} л
                            </option>
                        </select>
                    </div>


                    <div class="form-group  col-md-7">
                        <label class="control-label" for="cost">Стоимость:</label>
                        <div>
                            <input type="text" id="cost" class="form-control" v-model="inputCost"
                                   placeholder="1000"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-9">
                            <button type="button" @click="storeDetail()" class="btn btn-success">
                                Добавить
                            </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <h2>Перечень товаров</h2>
                <label class="control-label">Поиск по названию:</label>
                <input type="text" class="form-control" v-model="search" placeholder="Введите текст..."/>
                <br>
                <div class="card">

                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Наименование детали</th>
                                <th>Автомодель</th>
                                <th>Стоимость</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in filteredList">
                            <tr>
                                <td>{{col.detail.title}}</td>
                                <td>{{col.car.model.title}}</td>
                                <td>{{col.cost}}</td>
                                <td>
                                    <div type="button" class="btn btn-danger" v-on:click="deleteAssortment(col.id)">
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
                            <h4 class="modal-title">Импорт ассортимент из Excel</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form" method="POST" enctype="multipart/form-data"
                                  action="/admin/assortment/import">
                                <input type="file" id="excelUploadAssortment" name="excelUploadAssortment">
                                <br>
                                <button type="submit" class="btn btn-primary">Импортировать</button>
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
                search: '',
                assortment: [],
                details: [],
                brands: [],
                models: [],
                car: [],
                vmBrand: '',
                vmModel: '',
                vmCar: '',
                vmDetail: '',
                inputCost: '',
                modelSelected: '',
                carSelected: '',
                showModal: false,
                //UserData
                vmTypeDetail: '',
                detailSelected: '',
                inputTitleDetail: '',
                inputWeight: '',

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
            this.getTypeDetails();
            this.getBrands();
            this.getDetails();
        },
        computed: {
            filteredList() {
                console.log("filteredList()");
                return this.assortment.filter(filter => {
                    return filter.detail.title.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },
        methods: {
            newModal: function () {
                $('#addNew').modal('show');
            },
            update: function () {
                axios.get('/assortment/details').then((response) => {
                    this.assortment = response.data;
                    console.log(response.data);
                });
            },

            getBrands: function () {
                axios.get('/car/brands').then((response) => {
                    this.brands = response.data;
                    console.log(response.data);
                });
            },


            getDetails: function () {
                axios.get('/details').then((response) => {
                    this.details = response.data;
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
                        this.car = response.data;
                    });
            },

            getTypeDetails: function () {
                axios.get('/type/details').then((response) => {
                    this.typeDetails = response.data;
                    console.log(response.data);
                });
            },
            //Экспорт в данных в эксель
            exportExcel: function () {
                axios.get('/admin/assortment/export');
            },
            importFromExcel: function () {
                axios.get('admin/assortment/import');
            },


            storeDetail: function () {
                var formData = new FormData();
                formData.append('detail_id', this.detailSelected);
                formData.append('car_id', this.carSelected);
                formData.append('cost', this.inputCost);
                axios.post('/assortment/details', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                        this.vmDetail = ""
                        this.vmModel = ""
                        this.vmBrand = ""
                        this.vmCar = ""
                        this.inputCost = ""
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },


            deleteAssortment: function (id) {
                axios.delete('/assortment/details/' + id).then((response) => {
                    this.update();
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            },

            onSelectDetail(e) {
                this.detailSelected = e.target.value;
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
        }
    }
</script>
