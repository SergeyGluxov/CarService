<template>
    <div class="container">
        <div class="row">
            <h2>Управление телеканалами</h2>

            <form class="form-inline" method="GET" action="/admin/appointment/export">
                <button id="show-modal" type="button" class="btn btn-success" @click="showModal = true"><i
                    class="fa fa-plus" aria-hidden="true"></i>
                </button>
                <button id="show-modal-import" type="button" class="btn btn-info" @click="showModalImport = true">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i></button>
            </form>

            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Категория</th>
                    <th>Язык</th>
                    <th>Список источников</th>
                    <!--TODO: Отображать не ID, а название-->
                </tr>
                </thead>
                <tbody v-for="col in channels">
                <tr>
                    <td>{{col.id}}</td>
                    <td>{{col.title}}</td>
                    <td>Category</td>
                    <td>{{col.lang}}</td>
                    <td><a>Список источников</a></td>
                    <td></td>
                    <td>
                        <div type="button" class="btn btn-danger" v-on:click="removeAppoint(col.id)">
                            <i class="fas fa-times " aria-hidden="true"></i></div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div v-if="showModal">
            <div class="modal fade-in" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="showModal=false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Добавление телеканала</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Название:</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="title" v-model="titleChannel" placeholder="СТС/ТНТ/Россия 1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Категория:</label>
                                    <div class="col-xs-9">
                                        <select @change.capture="onChangeType($event)" class="form-control">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="type in categoryChannel" :value="type.category"
                                                    :key="type.category">{{type.category}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Язык:</label>
                                    <div class="col-xs-9">
                                        <select @change.capture="onChangeLang($event)" class="form-control">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="type in langChannels" :value="type.lang"
                                                    :key="type.lang">{{type.lang}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Лого:</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="logo" placeholder="http://logo.ru/logo.png">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-6 col-xs-9">
                                        <button type="submit" @click="store" class="btn btn-success">
                                            Добавить телеканал
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModalShedules">
            <div class="modal fade-in" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="showModalShedules=false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Новое назначение</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="newChedule">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Выберите исполнителя:</label>
                                    <div class="col-xs-6">
                                        <select class="form-control" @change.capture="onChangeWorkers($event)">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="worker in workers" :value="worker.id"
                                                    :key="worker.id">{{worker.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <button type="submit" class="btn btn-primery">Создать нового
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-3 col-xs-9">
                                        <button type="submit" @click="storeSchedule" class="btn btn-success">
                                            Создать
                                            заявку
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                            <h4 class="modal-title">Новое назначение</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form" method="POST" enctype="multipart/form-data"
                                  action="/admin/appointment/import">
                                <input type="file" id="excelUpload" name="excelUpload">
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
    import vPagination from 'vue-plain-pagination'
    import moment from 'moment'
    import 'moment/locale/ru'

    export default {
        components: {vPagination},
        data: function () {
            return {
                channels: [],
                users: [],
                discriptionInput: '',
                selectedType: '',
                selectedLang: '',
                titleChannel: '',
                selectedUser: '',
                selectedService: '',
                selectedWorker: '',
                selectedDay: '',
                selectedTime: '',
                //todo Сделать загрузку категорий из API
                categoryChannel: [
                    {index: '1', category: 'Фильмы'},
                    {index: '2', category: 'Развлекательные'},
                    {index: '3', category: 'Новости'},
                    {index: '3', category: 'Спорт'},
                ],
                langChannels: [
                    {index: '1', lang: 'RU'},
                    {index: '2', lang: 'KZ'},
                    {index: '3', lang: 'UA'},
                    {index: '3', lang: 'AZ'},
                ],
                services: [],
                freeTime: [],
                showModal: false,
                showModalShedules: false,
                showModalImport: false,
                currentPage: 1,
                bootstrapPaginationClasses: {
                    ul: 'pagination',
                    li: 'page-item',
                    liActive: 'active',
                    liDisable: 'disabled',
                    button: 'page-link'
                },
                paginationAnchorTexts: {
                    first: 'Начало',
                    prev: 'Назад',
                    next: 'Вперед',
                    last: 'Конец'
                },
                //Создание нового назначения
                currentSelectAppointments: 1,
                workers: [],
                freeDate: []
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            //--------------------Получить все заявки----------------------------------
            update: function () {
                this.getAppointments();
            },

            getAppointments: function () {
                axios.get('/channels').then((response) => {
                    this.channels = response.data;
                    console.log(response.data);
                });
            },

            //--------------------Получить всех пользователей--------------------------

            getUsers: function () {
                axios.get('/api/users').then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });
            },
            //--------------------Получить всех пользователей--------------------------


            //--------------------Удалить заявку---------------------------------------
            removeAppoint: function (id) {
                axios.delete('/channels/' + id).then((response) => {
                    this.update();
                    console.log(response.data);
                });
            },

            //----------------------Сохранить заявку----------------------------------

            store: function () {
                const formData = new FormData();
                formData.append('title', this.titleChannel);
                formData.append('lang', this.selectedLang);
                formData.append('logo', this.logo);
                axios.post('/channels', formData).then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                    this.update();
                });
            },

            //------------------Изменить статус заявки----------------------------------
            changeStatus: function (id) {
                const formData = new FormData();
                formData.append('id', id);
                axios.post('/api/admin/appointment/status', formData).then((response) => {
                    this.update();
                });
            },

            //Зассетить данные в селектор услуг
            updateSelectService: function (type) {
                const formData = new FormData();
                formData.append('type', type);
                axios.post('/api/services/findByType', formData).then((response) => {
                    console.log(response);
                    console.log(response.data);
                    this.services = response.data;
                });
            },

            //------------------Создание нового назначения----------------------------------
            //Заполнить информацию в модальное окно
            getModalSchedule(id) {
                this.currentSelectAppointments = '';
                this.currentSelectAppointments = id;
                this.showModalShedules = true;
                this.getWorkers()
            },

            getWorkers: function () {
                axios.get('/api/workers').then((response) => {
                    this.workers = response.data;
                    console.log(response.data);
                });
            },

            //------------------Создание нового назначения----------------------------------
            storeSchedule: function () {
                this.changeStatus(this.currentSelectAppointments);
                const dataNewChedule = new FormData();
                dataNewChedule.append('user_id', this.selectedWorker);
                dataNewChedule.append('appointment_id', this.currentSelectAppointments);
                axios.post('/api/admin/schedules', dataNewChedule).then((response) => {
                    console.log(response.data);
                }).catch(error => {
                    alert(error.response.status)
                });
            },

            onChangeType(e) {
                this.selectedType = e.target.value;
            },


            onChangeLang(e) {
                this.selectedLang = e.target.value;
            },

            onChangeUser(e) {
                this.selectedUser = e.target.value;
            },

            onChangeServices(e) {
                this.selectedService = e.target.value;
            },
            onChangeWorkers(e) {
                this.selectedWorker = e.target.value;
            },
            onChangeDay(e) {
                this.selectedDay = e.target.value;
                console.log(this.selectedDay);
                this.getFreeTime(this.selectedDay);
            },
            onChangeTime(e) {
                this.selectedTime = e.target.value;
            },

            //------------------Работа с датами----------------------------------

            getFreeDate: function () {
                for (let i = 0; i <= 7; i++) {
                    let dayData = {
                        //Y-m-d H:i:s
                        day: moment().add(i, 'days').locale('ru').format('YYYY-MM-DD HH:mm:ss'),
                        printValue: moment().add(i, 'days').format('LL')
                    };
                    this.freeDate.push(dayData);
                }
                console.log(this.freeDate);
            },

            getFreeTime: function (reqDate) {
                const formData = new FormData();
                formData.append('request_date', reqDate);
                axios.post('/api/admin/appointment/getFreeTime', formData).then((response) => {
                    this.freeTime = response.data;
                });
                console.log(this.freeTime);
            },

            exportExcel: function () {
                axios.get('/admin/appointment/export');
            },

            convertDat: function (date) {
                return moment(date).format('YYYY-MM-DD HH:ss')
            }
        }
    }
</script>
<style>
    .table {
        border-collapse: collapse;
        border-spacing: 0;
        cursor: pointer;
        width: 100%;
    }

    .table th, .table td {
        border: 1px solid #888;
        padding: 10px;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }


</style>
