//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Товары</h2>

                <form class="form-horizontal">

                    <div class="form-group col-md-7">
                        <label class="control-label" for="exampleSelectBrand">Выберите деталь:</label>
                        <div>
                            <select v-model="vmDetail" @change.capture="onSelectDetail($event)" class="form-control" id="exampleSelectBrand">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in details" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group  col-md-6">
                        <label class="control-label">Выберите бренд:</label>
                        <select v-model="vmBrand" @change.capture="onSelectBrand($event)"
                                class="form-control">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in brands" :value="type.id"
                                    :key="type.id">{{type.title}}
                            </option>
                        </select>
                    </div>


                    <div class="form-group col-md-4">
                        <label class="control-label col-md-offset-2 "  >Выберите модель:</label>
                        <select  v-model="vmModel" @change.capture="onSelectModel($event)"
                                class="form-control col-md-offset-2 ">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="type in models" :value="type.id"
                                    :key="type.id">{{type.title}}
                            </option>
                        </select>
                    </div>

                    <div class="form-group  col-md-4">
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
                            <tbody v-for="col in assortment">
                            <tr>
                                <td>{{col.detail.title}}</td>
                                <td>{{col.avto_model.title}}</td>
                                <td>{{col.cost}}</td>
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
                                  action="/admin/users/import">
                                <input type="file" id="excelUploadUsers" name="excelUploadUsers">
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
                assortment: [],
                details: [],
                brands: [],
                models: [],
                vmBrand: '',
                vmModel: '',
                vmDetail: '',
                inputCost: '',
                modelSelected:'',
                showModal: false,
                //UserData
                vmTypeDetail: '',
                detailSelected:'',
                inputTitleDetail:'',
                inputWeight:'',

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

            getTypeDetails: function () {
                axios.get('/type/details').then((response) => {
                    this.typeDetails = response.data;
                    console.log(response.data);
                });
            },

            storeDetail: function () {
                var formData = new FormData();
                formData.append('detail', this.detailSelected);
                formData.append('avto_model', this.modelSelected);
                formData.append('cost', this.inputCost);
                axios.post('/assortment/details', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                        this.vmDetail = ""
                        this.vmModel = ""
                        this.vmBrand = ""
                        this.inputCost = ""
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
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
            },
        }
    }
</script>
