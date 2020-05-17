//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Расписание работ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Заявка</th>
                                <th>Исполнитель</th>
                                <th>Должность</th>
                                <th>Статус</th>
                                <th>Дата назначения</th>
                                <th>Дата окончания работ</th>
                                <th>Изменить статус</th>
                            </tr>
                            </thead>
                            <tbody v-for="(col,index) in schedules">
                            <tr>
                                <td><a @click="showAlert(col.id)">Заявка #{{col.appointment.id}}</a></td>
                                <td>{{col.user.name}}</td>
                                <td>{{col.user.role[0].name}}</td>
                                <td>{{col.appointment.status}}</td>
                                <td>{{convertDat(col.created_at.date)}}</td>
                                <td>{{getFinishTime(index)}}</td>
                                <td>
                                    <div type="button" class="btn btn-warning" v-on:click="changeStatus(col.appointment.id)">
                                        <i class="fas fa-angle-up "  aria-hidden="true"></i></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <div v-if="showModalShedules">
            <div class="modal fade-in" style="display: block; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" @click="showModalShedules=false">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title">Заявка #{{schedule.appointment.id}}</h3>
                            </div>
                            <div class="modal-body">
                                <table class="table table-condensed">
                                    <tbody>
                                    <tr>
                                        <td>Клиент</td>
                                        <td>{{schedule.appointment.user.name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Автомобиль</td>
                                        <td>{{schedule.appointment.user.cars.brand+" "+schedule.appointment.user.cars.model}}</td>
                                    </tr>
                                    <tr>
                                        <td>Гос. номер</td>
                                        <td>{{schedule.appointment.user.cars.state_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Исполнитель</td>
                                        <td>{{schedule.user.name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Статус заявки</td>
                                        <td>{{schedule.appointment.status}}</td>
                                    </tr>
                                    <tr>
                                        <td>Тип заявки</td>
                                        <td>{{schedule.appointment.service.type}}</td>
                                    </tr>
                                    <tr>
                                        <td>Услуга</td>
                                        <td>{{schedule.appointment.service.title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость</td>
                                        <td>{{schedule.appointment.service.cost}} руб.</td>
                                    </tr>
                                    <tr>
                                        <td>Описание работы</td>
                                        <td>{{schedule.appointment.description}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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
                schedules: [],
                workers: [],
                showModal: false,
                showModalShedules: false,
                selectedType: '',
                selectedUser: '',
                selectedService: '',
                //Подробное описание работы
                currentScheduleSelected: '',
                schedule: {},
            }
        },
        mounted() {
            this.update();
        },
        methods: {

            update: function () {
                this.getWorkers();
                this.getSchedules();
            },

            //--------------------Получить все назначения----------------------------------
            getSchedules: function () {
                axios.get('/api/admin/schedules/').then((response) => {
                    this.schedules = response.data;
                    console.log(response.data);
                });
            },

            getSchedule: function (id) {
                axios.get('/api/admin/schedules/' + id).then((response) => {
                    this.schedule = response.data;
                    console.log(response.data);
                });
            },

            //--------------------Сохранить новое назначение----------------------------------
            store: function () {
                //Объект formData
                const formData = new FormData();
                formData.append('user_id', 1);
                formData.append('appointment_id', 1);
                //Отправка самого запроса
                axios.post('/api/schedules', formData)
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
            changeStatus: function (id) {
                const formData = new FormData();
                formData.append('id', id);
                axios.post('/api/admin/appointment/status', formData).then((response) => {
                    this.update();
                });
            },
            getFinishTime: function (index) {
                return moment(this.schedules[index].created_at.date)
                    .add(this.schedules[index].appointment.service.duration, "minutes").format('YYYY-MM-DD HH:ss')
            },
            //--------------------Получить всех сотрудников----------------------------------
            getWorkers: function () {
                axios.get('/api/workers').then((response) => {
                    this.workers = response.data;
                    console.log(response.data);
                });
            },

            onChangeType(e) {
                this.selectedType = e.target.value;
                this.updateSelectService(e.target.value);

            },

            onChangeWorker(e) {
                this.selectedUser = e.target.value;
            },

            onChangeServices(e) {
                this.selectedService = e.target.value;
            },
            showAlert(id) {
                this.showModalShedules = true;
                this.getSchedule(id);
            },
            convertDat: function (date) {
                return moment(date).format('YYYY-MM-DD HH:ss')
            },
        }
    }
</script>
<style>
    a {
        cursor: pointer;
    }
</style>
