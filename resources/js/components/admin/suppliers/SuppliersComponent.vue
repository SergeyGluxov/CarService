//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Форма добавления нового поставщика</h2>
                <div class="card">


                    <form class="form-horizontal">

                        <div class="form-group  col-md-7">
                            <label class="control-label" for="companyName">Наименование компании:</label>
                            <div>
                                <input type="text" id="companyName" class="form-control" v-model="vmCompanyName"
                                       placeholder="Введите наименование"/>
                            </div>
                        </div>

                        <div class="form-group  col-md-7">
                            <label class="control-label" for="address">Адрес:</label>
                            <div>
                                <input type="text" id="address" class="form-control" v-model="vmAddress"
                                       placeholder="ул. Ленина, 143/3"/>
                            </div>
                        </div>

                        <div class="form-group  col-md-7">
                            <label class="control-label" for="phoneCompany">Номер телефона:</label>
                            <div>
                                <input type="text" id="phoneCompany" class="form-control" v-model="vmPhoneCompany"
                                       placeholder="79999999999"/>
                            </div>
                        </div>

                        <div class="form-group  col-md-7">
                            <label class="control-label" for="emailCompany">Почтовый адрес:</label>
                            <div>
                                <input type="text" id="emailCompany" class="form-control" v-model="vmEmailCompany"
                                       placeholder="example@mail.ru"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-9">
                                <button type="button" @click="storeSupplier()" class="btn btn-success">
                                    Добавить
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <h2>Список поставщиков</h2>
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Наименование</th>
                                <th>Номер телефона</th>
                                <th>Почта</th>
                                <th>Адрес</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in users">
                            <tr>
                                <td>{{col.company}}</td>
                                <td>{{col.phone}}</td>
                                <td>{{col.email}}</td>
                                <td>{{col.address}}</td>
                                <td>
                                    <div type="button" class="btn btn-danger" v-on:click="deleteSupplier(col.id)">
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
                users: [],
                showModal: false,
                //UserData
                createName: '',
                createEmail: '',
                createPassword: '',
                createPhone: '',
                createMarkCar: '',
                createModelCar: '',
                createGosNumberCar: '',
                vmCompanyName:'',
                vmAddress:'',
                vmPhoneCompany:'',
                vmEmailCompany:'',
                showModalImport: false,
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            newModal: function () {
                $('#addNew').modal('show');
            },
            update: function () {
                axios.get('/suppliers').then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });
            },
            storeSupplier: function () {
                var formData = new FormData();
                formData.append('company', this.vmCompanyName);
                formData.append('address', this.vmAddress);
                formData.append('phone', this.vmPhoneCompany);
                formData.append('email', this.vmEmailCompany);
                axios.post('/suppliers', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                        this.vmCompanyName = ""
                        this.vmAddress = ""
                        this.vmPhoneCompany = ""
                        this.vmEmailCompany = ""
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },
            deleteSupplier: function (id) {
                axios.delete('/suppliers/' + id).then((response) => {
                    this.users = response.data;
                    this.update();
                    console.log(response.data);
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            }
        }
    }
</script>
