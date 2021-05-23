//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Форма создания новой заявки поставщику</h2>


                <form class="form-horizontal">

                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectDetail">Выберите деталь:</label>
                        <div>
                            <select v-model="vmDetail" @change.capture="onSelectDetail($event)" class="form-control" id="exampleSelectDetail">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in details" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectBrand">Выберите поставщика:</label>
                        <div>
                            <select v-model="vmSupplier" @change.capture="onSelectSupplier($event)" class="form-control" id="exampleSelectBrand">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="supplier in suppliers" :value="supplier.id"
                                        :key="supplier.id">{{supplier.company}}
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
                        <div class="col-md-10">
                            <button type="button" @click="storeOrder()" class="btn btn-success">
                                Добавить
                            </button>
                        </div>
                    </div>
                </form>

                <hr/>
                <h2>Заявки поставщикам</h2>

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
                                <th>Поставщик</th>
                                <th>Количество</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in orders">
                            <tr>
                                <td>{{col.id}}</td>
                                <td v-if="col.status==='create'">Создана</td>
                                <td v-if="col.status==='confirm'">Исполнена</td>
                                <td>{{col.detail.title}}</td>
                                <td>{{col.supplier.company}}</td>
                                <td>{{col.count}}</td>
                                <td>
                                    <div type="button" class="btn btn-danger" v-on:click="deleteOrder(col.id)">
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
                orders: [],
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
                vmSupplier: '',
                vmCount: '',
                details: [],
                suppliers: [],
                detailSelected:'',
                supplierSelected:'',

                showModalImport: false,
            }
        },
        mounted() {
            this.update();
            this.getDetails();
            this.getSuppliers();

        },
        methods: {
            newModal: function () {
                $('#addNew').modal('show');
            },
            update: function () {
                axios.get('/orders').then((response) => {
                    this.orders = response.data;
                    console.log(response.data);
                });
            },
            getDetails: function () {
                axios.get('/details').then((response) => {
                    this.details = response.data;
                    console.log(response.data);
                });
            },

            getSuppliers: function () {
                axios.get('/suppliers').then((response) => {
                    this.suppliers = response.data;
                    console.log(response.data);
                });
            },
            storeOrder: function () {
                var formData = new FormData();
                formData.append('status', 'create');
                formData.append('detail_id', this.detailSelected);
                formData.append('supplier_id', this.supplierSelected);
                formData.append('count', this.vmCount);
                axios.post('/orders', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                        this.vmDetail = ""
                        this.vmSupplier = ""
                        this.vmCount = ""
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },
            deleteOrder: function (id) {
                axios.delete('/orders/' + id).then((response) => {
                    this.update();
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            },
            onSelectDetail(e) {
                this.detailSelected = e.target.value;
            },

            onSelectSupplier(e) {
                this.supplierSelected = e.target.value;
            },
        }
    }
</script>
