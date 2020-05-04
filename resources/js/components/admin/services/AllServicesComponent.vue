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
                                <th>Наименование</th>
                                <th>Стоимость</th>
                                <th>Время выполнения</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in services">
                            <tr>
                                <td>{{col.title}}</td>
                                <td>{{col.cost}}</td>
                                <td>{{col.duration}} мин</td>
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
                services: [],
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
                axios.get('/api/services').then((response) => {
                    this.services = response.data;
                    console.log(response.data);
                });
            },
            deleteUser: function (id) {
                axios.delete('/api/services/' + id).then((response) => {
                    this.update();
                    console.log(response.data);
                });
            }
        }
    }
</script>
