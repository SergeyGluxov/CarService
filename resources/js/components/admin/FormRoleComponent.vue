//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <h2>Форма добавления новой должности:</h2>
        <div class="card">
            <form class="form-horizontal">

                <div class="form-group col-md-10">
                    <label class="control-label" for="createNameRole">Наименование:</label>
                    <div>
                        <input type="text" class="form-control" v-model="createNameRole"
                               id="createNameRole"
                               placeholder="Маляр"/>
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

            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Внутренний номер</th>
                        <th>Наименование</th>
                    </tr>
                    </thead>
                    <tbody v-for="col in roles">
                    <tr>
                        <td>{{col.id}}</td>
                        <td>{{col.name}}</td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td>
                            <div type="button" class="btn btn-danger" v-on:click="deleteRole(col.id)">
                                <i class="fas fa-times " aria-hidden="true"></i></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                schedules: [],
                showModal: false,
                createNameRole: '',
                users: [],
                roles: []
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                axios.get('/api/users').then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });
                axios.get('/api/roles').then((response) => {
                    this.roles = response.data;
                    console.log(response.data);
                });
            },
            store: function () {
                //Объект formData
                const formData = new FormData();
                formData.append('name', this.createNameRole);
                //Отправка самого запроса
                axios.post('/api/roles', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
                this.showModal = false;
            },
            deleteRole: function (id) {
                const formData = new FormData();
                formData.append('id', id);
                axios.post('/api/roles/delete',formData).then((response) => {
                    this.update();
                    console.log(response.data);
                });
            },
        }
    }
</script>
