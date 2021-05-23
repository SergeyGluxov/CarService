//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <h2>Добавление сотрудника</h2>
        <form class="form-horizontal">

            <div class="form-group col-md-10">
                <label class="control-label" for="exampleSelectUser">Выберите пользователя:</label>
                <div>
                    <select v-model="vmUser" @change.capture="onSelectUser($event)" class="form-control"
                            id="exampleSelectUser">
                        <option value="" disabled selected>Выбрать...</option>
                        <option v-for="user in users" :value="user.id"
                                :key="user.id">{{user.name}}
                        </option>
                    </select>
                </div>
            </div>


            <div class="form-group col-md-10">
                <label class="control-label" for="exampleSelectRole">Выберите должность:</label>
                <div>
                    <select v-model="vmRole" @change.capture="onSelectRole($event)" class="form-control"
                            id="exampleSelectRole">
                        <option value="" disabled selected>Выбрать...</option>
                        <option v-for="role in roles" :value="role.id"
                                :key="role.id">{{role.name}}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9">
                    <button type="button" @click="store" class="btn btn-success">
                        Добавить
                    </button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Должность</th>
                            <th>Эл. почта</th>
                            <th>Уволить сотрудника</th>
                        </tr>
                        </thead>
                        <tbody v-for="col in employee">
                        <tr>
                            <td>{{col.name}}</td>
                            <td>{{col.role.name}}</td>
                            <td>{{col.email}}</td>
                            <td>
                                <button type="button" class="btn btn-danger" v-on:click="deleteEmployee(col.id)">
                                    Уволить
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        data: function () {
            return {
                employee: [],
                schedules: [],
                users: [],
                roles: [],
                vmUser:'',
                vmRole:'',
                selectedUser:'',
                selectedRole:'',
            }
        },
        mounted() {
            this.update();
        },
        methods: {

            getWorkers: function () {
                axios.get('/workers').then((response) => {
                    this.employee = response.data;
                });
            },

            update: function () {
                axios.get('/users').then((response) => {
                    this.users = response.data;
                });
                axios.get('/roles').then((response) => {
                    this.roles = response.data;
                });
                axios.get('/workers').then((response) => {
                    this.employee = response.data;
                    console.log(response.data);
                });
            },
            store: function () {
                const formData = new FormData();
                formData.append('user_id', this.selectedUser);
                formData.append('role_id', this.selectedRole);
                axios.post('/roles/setUser', formData).then((response) => {
                    this.update();
                });
            },
            deleteEmployee: function (id) {
                axios.delete('/roles/' + id).then((response) => {
                    this.update();
                });
            },
            onSelectUser(e) {
                this.selectedUser = e.target.value;
            },
            onSelectRole(e) {
                this.selectedRole = e.target.value;
            },
        }
    }
</script>
