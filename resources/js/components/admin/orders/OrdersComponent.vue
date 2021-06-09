<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Форма создания новой заявки поставщику</h2>
                <form class="form-horizontal">
                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectDetail">Выберите деталь:</label>
                        <div>
                            <select v-model="vmDetail" @change.capture="onSelectDetail($event)"
                            class="form-control" id="exampleSelectDetail">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="type in details" :value="type.id"
                                        :key="type.id">{{type.title}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="control-label" for="exampleSelectBrand">Выберите поставщика:</label>
                        <div>
                            <select v-model="vmSupplier" @change.capture="onSelectSupplier($event)"
                            class="form-control" id="exampleSelectBrand">
                                <option value="" disabled selected>Выбрать...</option>
                                <option v-for="supplier in suppliers" :value="supplier.id"
                                        :key="supplier.id">{{supplier.company}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  col-md-3">
                        <label class="control-label" for="count">Количество:</label>
                        <div>
                            <input type="text" id="count" class="form-control" v-model="vmCount"
                                   placeholder="1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10">
                            <button type="button" @click="storeOrder()" class="btn btn-success">
                                Добавить
                            </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <h2>Заявки поставщикам</h2>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Статус</th>
                                <th>Деталь</th>
                                <th>Поставщик</th>
                                <th>Количество</th>
                                <th>Удаление</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in orders">
                            <tr>
                                <td>{{col.id}}</td>
                                <td v-if="col.status==='create'">Создана</td>
                                <td v-if="col.status==='confirm'">Исполнена</td>
                                <td>{{col.detail.title}}</td>
                                <td>{{col.supplier.company}}</td>
                                <td>{{col.count}}</td>
                                <td>
                                    <div type="button" class="btn btn-danger" v-on:click="deleteOrder(col.id)">
                                        <i class="fas fa-times " aria-hidden="true"></i></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                orders: [],
                details: [],
                suppliers: [],
                vmDetail: '',
                vmSupplier: '',
                vmCount: '',
                detailSelected:'',
                supplierSelected:'',
            }
        },
        mounted() {
            this.update();
            this.getDetails();
            this.getSuppliers();
        },
        methods: {
            //Получить все заказы
            update: function () {
                axios.get('/orders').then((response) => {
                    this.orders = response.data;
                    console.log(response.data);
                });
            },
            //Получить все детали
            getDetails: function () {
                axios.get('/details').then((response) => {
                    this.details = response.data;
                    console.log(response.data);
                });
            },
            //Получить всех поставщиков
            getSuppliers: function () {
                axios.get('/suppliers').then((response) => {
                    this.suppliers = response.data;
                    console.log(response.data);
                });
            },
            //Отправить запрос на создание нового заказа
            storeOrder: function () {
                //Формируем данные для запроса
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
            //Удалить заказ
            deleteOrder: function (id) {
                axios.delete('/orders/' + id).then((response) => {
                    this.update();
                });
            },

            onSelectDetail(e) {
                this.detailSelected = e.target.value;
            },

            onSelectSupplier(e) {
                this.supplierSelected = e.target.value;
            },
        }
    }
</script>
