<template>
    <div class="container">
        <div class="row">
            <h2>Записи на осмотр</h2>
            <button id="show-modal" @click="showModal = true">Show Modal</button>

            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Описание</th>
                    <th>Время записи</th>
                    <th>Результат работы</th>
                    <th>Действие</th>
                    <!--TODO: Отображать не ID, а название-->
                </tr>
                </thead>
                <tbody v-for="col in appoint">
                <tr>
                    <td>{{col.type_service}}</td>
                    <td>{{col.description}}</td>
                    <td>{{col.description}}</td>
                    <td>{{col.description}}</td>
                    <td>
                        <button v-on:click="removeAppoint(col.id)">-</button>
                    </td>
                </tr>
                </tbody>
            </table>

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
                                    <h4 class="modal-title">Новая заявка</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-xs-3">Выберите тип заявки:</label>
                                            <div class="col-xs-9">
                                                <select @change.capture="onChange($event)" class="form-control">
                                                    <option value="" disabled selected>Выбрать...</option>
                                                    <option v-for="type in type_service" :value="type.category"
                                                            :key="type.category">{{type.category}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-3">Выберите услугу:</label>
                                            <div class="col-xs-9">
                                                <select class="form-control">
                                                    <option value="" disabled selected>Выбрать...</option>
                                                    <option v-for="service in services">{{service.title}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-xs-3" for="discription">Описание:</label>
                                            <div class="col-xs-9">
                                                <textarea rows="3" class="form-control" id="discription"
                                                          placeholder="Введите описание"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-offset-3 col-xs-9">
                                                <button type="submit" class="btn btn-primery">Добавить новую запись
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import vPagination from 'vue-plain-pagination'

    export default {
        components: {vPagination},
        data: function () {
            return {
                appoint: [],
                type_service: [
                    {index: '1', category: 'Осмотр'},
                    {index: '2', category: 'Ремонт'},
                    {index: '3', category: 'Топливная система'},
                ],
                services: [],
                showModal: false,
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
                }
            }
        },
        mounted() {
            this.update();
            this.updateSelectService('Ремонт');
        },
        methods: {
            store: function () {
                const formData = new FormData();
                formData.append('type_service', 'Осмотр');
                formData.append('description', this.selected);
                axios.post('/api/appointment', formData).then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                });
            },

            update: function () {
                axios.get('/api/appointment').then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                });
                /*axios.get('/api/services').then((response) => {
                    this.services = response.data;
                    console.log(response.data);
                });*/
            },
            removeAppoint: function (id) {
                axios.delete('/api/appointment/' + id).then((response) => {
                    this.users = response.data;
                    this.update();
                    console.log(response.data);
                });
            },

            updateSelectService: function (type) {
                axios.get('/api/services/findByType/?type=' + type).then((response) => {
                    console.log(response.data);
                    this.services = response.data;
                });
            },
            onChange(e) {
                this.selected = e.target.value;
                this.updateSelectService(e.target.value);
            }
        }
    }
</script>
