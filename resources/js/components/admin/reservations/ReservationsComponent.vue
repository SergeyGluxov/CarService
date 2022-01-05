//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Бронирования автозапчастей от клиентов</h2>

                <div class="card">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Статус</th>
                                <th>Деталь</th>
                                <th>Клиент</th>
                                <th>Количество</th>
                                <th>Дата создания</th>
                                <th class="text-center">Подтверждение</th>
                                <th class="text-center">Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in reservations">
                            <tr>
                                <td>{{col.id}}</td>
                                <td v-if="col.status==='create'">Получена</td>
                                <td v-if="col.status==='accept'">Подтвеждена</td>
                                <td>{{col.goods.detail.title}}</td>
                                <td>{{col.user.name}}</td>
                                <td>{{col.count}}</td>
                                <td>{{convertDat(col.created_at.date)}}</td>
                                <td class="text-center" v-if="col.status==='create'">
                                    <div type="button" class="btn btn-warning" v-on:click="acceptReservation(col.id)">
                                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i></div>
                                </td>
                                <td class="text-center" v-if="col.status==='accept'">
                                    <div type="button" class="btn btn-success" v-on:click="acceptReservation(col.id)">
                                        <i class="fas fa-check" aria-hidden="true"></i></div>
                                </td>
                                <td class="text-center">
                                    <div type="button" class="btn btn-danger" v-on:click="deleteReservation(col.id)">
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

        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        data: function () {
            return {
                reservations: [],
                showModal: false,
                //UserData
                createName: '',
                createEmail: '',
                createPassword: '',
                createPhone: '',
                createMarkCar: '',
                createModelCar: '',
                createGosNumberCar: '',
                vmDetail: '',
                vmSupplier: '',
                vmCount: '',
                details: [],
                suppliers: [],
                detailSelected:'',
                supplierSelected:'',

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
                axios.get('/reservations').then((response) => {
                    this.reservations = response.data;
                    console.log(response.data);
                });
            },

            storeOrder: function () {
                var formData = new FormData();
                formData.append('status', 'create');
                formData.append('detail_id', this.detailSelected);
                formData.append('supplier_id', this.supplierSelected);
                formData.append('count', this.vmCount);
                axios.post('/orders', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                        this.vmDetail = ""
                        this.vmSupplier = ""
                        this.vmCount = ""
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },
            acceptReservation: function (id) {
                axios.put('/reservations/' + id, {
                        status: 'accept'
                    }).then((response) => {
                    this.update();
                });
            },
            deleteReservation: function (id) {
                axios.delete('/reservations/' + id).then((response) => {
                    this.update();
                });
            },
            convertDat: function (date) {
                return moment(date).format('DD.MM.YYYY')
            },
        }
    }
</script>
