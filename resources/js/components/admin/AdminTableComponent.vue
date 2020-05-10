<template>
    <div class="container">
        <div class="row">
            <h2>Заявки пользователей</h2>
            <button id="show-modal" type="button" class="btn btn-success" @click="showModal = true">Создать заявку
            </button>
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Имя пользователя</th>
                    <th>Тип услуги</th>
                    <th>Наименование услуги</th>
                    <th>Описание</th>
                    <!--
                                        <th>Изменить статус</th>
                    -->
                    <th>Удаление</th>
                    <!--TODO: Отображать не ID, а название-->
                </tr>
                </thead>
                <tbody v-for="col in appoint">
                <tr v-if="col.status ==='Новая'" style="background: rgba(0,166,90,0.49)"
                    v-on:click="getModalSchedule(col.id)">
                    <td>{{col.status}}</td>
                    <td>{{col.created_at.date}}</td>
                    <td>{{col.user.name}}</td>
                    <td>{{col.type_service}}</td>
                    <td>{{col.service.title}}</td>
                    <td>{{col.description}}</td>
                    <!--   <td>
                           <button v-on:click="changeStatus(col.id)">-</button>
                       </td>-->
                    <td>
                        <button v-on:click="removeAppoint(col.id)">-</button>
                    </td>
                </tr>
                <tr v-if="col.status ==='В работе'" style="background: rgba(166,161,0,0.53)">
                    <td>{{col.status}}</td>
                    <td>{{col.created_at.date}}</td>
                    <td>{{col.user.name}}</td>
                    <td>{{col.type_service}}</td>
                    <td>{{col.service.title}}</td>
                    <!--<td>
                        <button v-on:click="changeStatus(col.id)">-</button>
                    </td>-->
                    <td>{{col.description}}</td>
                    <td>
                        <button v-on:click="removeAppoint(col.id)">-</button>
                    </td>
                </tr>
                <tr v-if="col.status ==='Выполнена'" style="background: rgba(166,14,0,0.6)">
                    <td>{{col.status}}</td>
                    <td>{{col.created_at.date}}</td>
                    <td>{{col.user.name}}</td>
                    <td>{{col.type_service}}</td>
                    <td>{{col.service.title}}</td>
                    <td>{{col.description}}</td>
                    <!-- <td>
                         <button v-on:click="changeStatus(col.id)">-</button>
                     </td>-->
                    <td>
                        <button v-on:click="removeAppoint(col.id)">-</button>
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
                            <h4 class="modal-title">Новая заявка</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Выберите пользователя:</label>
                                    <div class="col-xs-6">
                                        <select class="form-control" @change.capture="onChangeUser($event)">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="user in users" :value="user.id"
                                                    :key="user.id">{{user.name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <button type="submit" class="btn btn-primery">Создать нового
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Выберите тип заявки:</label>
                                    <div class="col-xs-9">
                                        <select @change.capture="onChangeType($event)" class="form-control">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="type in type_service" :value="type.category"
                                                    :key="type.category">{{type.category}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Выберите
                                        услугу:</label>
                                    <div class="col-xs-9">
                                        <select @change.capture="onChangeServices($event)" class="form-control"
                                                v-model="selectedService">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="service in services" :value="service.id"
                                                    :key="service.id">{{service.title}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="discription">Описание:</label>
                                    <div class="col-xs-9">
                                                <textarea rows="3" class="form-control" v-model="discriptionInput"
                                                          id="discription"
                                                          placeholder="Введите описание"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3" for="date">Дата и время:</label>
                                    <div class="col-xs-4">
                                        <select id="date" class="form-control">
                                            <option value="" disabled selected>Выбрать дату...</option>
                                            <option v-for="dat in freeDate" :value="dat"
                                                    :key="dat">{{dat}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select id="time" class="form-control">
                                            <option value="" disabled selected>Выбрать время...</option>
                                            <option v-for="dat in freeDate" :value="dat"
                                                    :key="dat">{{dat}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-6 col-xs-9">
                                        <button type="submit" @click="store" class="btn btn-success">Создать
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
    </div>
</template>

<script>
    import vPagination from 'vue-plain-pagination'
    import moment from 'moment'

    export default {
        components: {vPagination},
        data: function () {
            return {
                appoint: [],
                users: [],
                discriptionInput: '',
                selectedType: '',
                selectedUser: '',
                selectedService: '',
                selectedWorker: '',
                type_service: [
                    {index: '1', category: 'Осмотр'},
                    {index: '2', category: 'Ремонт'},
                    {index: '3', category: 'Топливная система'},
                ],
                services: [],
                showModal: false,
                showModalShedules: false,
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
                this.getUsers();
                this.getFreeDate();
            },

            getAppointments: function () {
                axios.get('/api/appointment').then((response) => {
                    this.appoint = response.data;
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

            //--------------------Получить все заявки----------------------------------
            getAppointments: function () {
                axios.get('/api/appointment').then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                });
            },

            //--------------------Удалить заявку---------------------------------------
            removeAppoint: function (id) {
                axios.delete('/api/appointment/' + id).then((response) => {
                    this.users = response.data;
                    this.update();
                    console.log(response.data);
                });
            },

            //----------------------Сохранить заявку----------------------------------
            store: function () {
                const formData = new FormData();
                formData.append('user_id', this.selectedUser);
                formData.append('service_id', this.selectedService);
                formData.append('type_service', this.selectedType);
                formData.append('description', this.discriptionInput);
                axios.post('/api/admin/appointment', formData).then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
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

            //Создание нового назначения
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
                this.updateSelectService(e.target.value);

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
            getFreeDate: function () {
                for (let i = 0; i <= 7; i++){
                    this.freeDate.push(moment().add(i,'days').format('LL'));
                }
                console.log(this.freeDate);
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

    .table tr:hover td {
        background: #6d6b52;
    }


</style>
