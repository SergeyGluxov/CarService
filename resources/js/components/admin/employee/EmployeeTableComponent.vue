<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Сотрудники</h2>
                <div class="card">
                    <button id="show-modal" type="button" class="btn btn-success" @click="showModal = true">Добавить
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
                                    <button type="button" class="btn btn-danger" v-on:click="deleteEmployee(col.id)">уволить</button>
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
    import moment from "moment";

    export default {
        data: function () {
            return {
                employee: [],
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
                this.getWorkers();
            },
            getWorkers: function () {
                axios.get('/api/workers').then((response) => {
                    this.employee = response.data;
                    console.log(response.data);
                });
            },
            deleteEmployee: function (id) {
                axios.delete('/api/roles/' + id).then((response) => {
                    this.update();
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            }
        }
    }
</script>
