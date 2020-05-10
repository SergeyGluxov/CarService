//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <button id="show-modal" @click="showModal = true">Show Modal</button>

                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Телефон</th>
                                <th>Эл. почта</th>
                                <th>Дата регистрации</th>
                                <!--TODO: Отображать не ID, а название-->
                                <th>Автомобиль</th>
                                <th>Гос. номер</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in users">
                            <tr>
                                <td>{{col.name}}</td>
                                <td>{{col.phone}}</td>
                                <td>{{col.email}}</td>
                                <td>{{col.created_at.date}}</td>
                                <td v-for="car in col.cars">{{car.brand+" "+car.model}}</td>
                                <td v-for="car in col.cars">{{car.state_number}}</td>
                                <td v-if="col.cars.length===0">Нет</td>
                                <td v-if="col.cars.length===0">Нет</td>
                                <td>
                                    <button v-on:click="deleteUser(col.id)">-</button>
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
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" @click="showModal=false">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
                                        modal body
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                users: [],
                showModal: false
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
                axios.get('/api/users').then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });
            },
            deleteUser: function (id) {
                axios.delete('/api/users/' + id).then((response) => {
                    this.users = response.data;
                    this.update();
                    console.log(response.data);
                });
            }
        }
    }
</script>
