<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Сотрудники</h2>
                <div class="card">
                    <button id="show-modal" type="button" class="btn btn-success" @click="showModalNewEmployee = true"><i
                        class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Должность</th>
                                <th>Эл. почта</th>
                                <th>Номер телефона</th>
                                <th>Уволить сотрудника</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in employee">
                            <tr>
                                <td>{{col.name}}</td>
                                <td>{{col.role[0].name}}</td>
                                <td>{{col.email}}</td>
                                <td>{{col.phone}}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" v-on:click="deleteEmployee(col.id)">
                                        уволить
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div v-if="showModalNewEmployee">
                <div class="modal fade-in" style="display: block; padding-right: 17px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" @click="showModalNewEmployee=false">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Новый сотрудник</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="newChedule">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Выберите e-mail пользователя:</label>
                                        <div class="col-xs-6">
                                            <select class="form-control" @change.capture="onChangeUserEmail($event)">
                                                <option value="" disabled selected>Выбрать...</option>
                                                <option v-for="user in users" :value="user.id"
                                                        :key="user.id">{{user.email}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Выберите должность:</label>
                                        <div class="col-xs-6">
                                            <select class="form-control" @change.capture="onChangeRole($event)">
                                                <option value="" disabled selected>Выбрать...</option>
                                                <option v-for="role in roles" :value="role.id"
                                                        :key="role.id">{{role.name}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-offset-3 col-xs-9">
                                            <button type="submit" @click="storeUserRole" class="btn btn-success">
                                                Добавить сотрудника
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
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        data: function () {
            return {
                employee: [],
                users: [],
                roles: [],
                showModalNewEmployee: false,
                selectedUserEmail: '',
                selectedRole: '',
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
                this.getWorkers();
                this.getAllUserEmail();
                this.getRole();
            },
            getWorkers: function () {
                axios.get('/api/workers').then((response) => {
                    this.employee = response.data;
                    console.log(response.data);
                });
            },
            getAllUserEmail: function () {
                axios.get('/api/users').then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });
            },
            getRole: function () {
                axios.get('/api/roles').then((response) => {
                    this.roles = response.data;
                    console.log(response.data);
                });
            },
            deleteEmployee: function (id) {
                axios.delete('/api/roles/' + id).then((response) => {
                    this.update();
                });
            },
            storeUserRole: function () {
                const formData = new FormData();
                formData.append('user_id', this.selectedUserEmail);
                formData.append('role_id', this.selectedRole);
                axios.post('/api/roles/setUser', formData).then((response) => {
                    this.update();
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            },
            onChangeUserEmail(e) {
                this.selectedUserEmail = e.target.value;
            },
            onChangeRole(e) {
                this.selectedRole = e.target.value;
            },
        }
    }
</script>
