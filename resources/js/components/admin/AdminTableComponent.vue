<template>
    <div class="container">
        <div class="row">
            <h2>Управление телеканалами</h2>

            <form class="form-inline" method="GET" action="/admin/appointment/export">
                <button id="show-modal" type="button" class="btn btn-success" v-on:click="openModalNewChannel()"><i
                    class="fa fa-plus" aria-hidden="true"></i>
                </button>
                <button id="show-modal-import" type="button" class="btn btn-info" @click="showModalImport = true">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i></button>
            </form>

            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Категория</th>
                    <th>Язык</th>
                    <th>Лого</th>
                    <th>Список источников</th>
                    <!--TODO: Отображать не ID, а название-->
                </tr>
                </thead>
                <tbody v-for="col in channels">
                <tr>
                    <td @click="clickChangeChannels(col.id)">{{col.id}}</td>
                    <td @click="clickChangeChannels(col.id)">{{col.title}}</td>
                    <td @click="clickChangeChannels(col.id)">Category</td>
                    <td @click="clickChangeChannels(col.id)">{{col.lang}}</td>
                    <td><a v-bind:href="'{col.logo}'" target="_blank">Ссылка на лого</a></td>
                    <td @click="clickChangeChannels(col.id)"><a>Список источников</a></td>
                    <td>
                        <div type="button" class="btn btn-danger" v-on:click="removeChannels(col.id)">
                            <i class="fas fa-times " aria-hidden="true"></i></div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div v-if="showModal">
            <div class="modal fade-in" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="showModal = false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" v-text="titleModal">Добавление телеканала</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Название:</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="title" v-model="titleChannel"
                                               placeholder="СТС/ТНТ/Россия 1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Категория:</label>
                                    <div class="col-xs-9">
                                        <select @change.capture="onChangeType($event)" class="form-control">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="type in categoryChannel" :value="type.category"
                                                    :key="type.category">{{type.category}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Язык:</label>
                                    <div class="col-xs-9">
                                        <select @change.capture="onChangeLang($event)" class="form-control">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="type in langChannels" :value="type.lang"
                                                    :key="type.lang">{{type.lang}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Лого:</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="logo" v-model="logoChannel"
                                               placeholder="http://logo.ru/logo.png">
                                    </div>
                                </div>
                                <div class="form-group" v-if="titleModal==='Добавление нового канала'">
                                    <div class="col-xs-offset-6 col-xs-9">
                                        <button type="button" @click="createChannel" v-text="buttonModal"
                                                class="btn btn-success">
                                            Добавить телеканал
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group" v-if="titleModal==='Редактирование канала'">
                                    <div class="col-xs-offset-6 col-xs-9">
                                        <button type="button" @click="updateChannel" v-text="buttonModal"
                                                class="btn btn-success">
                                            Изменить телеканал
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
</template>

<script>
    import vPagination from 'vue-plain-pagination'
    import moment from 'moment'
    import 'moment/locale/ru'

    export default {
        components: {vPagination},
        data: function () {
            return {
                channel: {},
                channels: [],
                users: [],
                discriptionInput: '',
                selectedType: '',
                selectedLang: '',
                titleChannel: '',
                titleModal: '',
                buttonModal: '',
                logoChannel: '',
                selectedUser: '',
                selectedService: '',
                selectedWorker: '',
                selectedDay: '',
                selectedTime: '',
                //todo Сделать загрузку категорий из API
                categoryChannel: [
                    {index: '1', category: 'Фильмы'},
                    {index: '2', category: 'Развлекательные'},
                    {index: '3', category: 'Новости'},
                    {index: '3', category: 'Спорт'},
                ],
                langChannels: [
                    {index: '1', lang: 'RU'},
                    {index: '2', lang: 'KZ'},
                    {index: '3', lang: 'UA'},
                    {index: '3', lang: 'AZ'},
                ],
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
                },
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                this.getAllTvChannels();
            },

            //----------------------Управление телеканалами-------------------------------------------------------------

            getAllTvChannels: function () {
                axios.get('/channels').then((response) => {
                    this.channels = response.data;
                    console.log(response.data);
                });
            },

            createChannel: function () {
                const formData = new FormData();
                formData.append('title', this.titleChannel);
                formData.append('lang', this.selectedLang);
                formData.append('logo', this.logoChannel);
                axios.post('/channels', formData).then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                    this.showModal = false;
                    this.update();
                });
            },

            updateChannel: function () {
                const formData = new FormData();
                formData.append('title', this.titleChannel);
                formData.append('lang', this.selectedLang);
                formData.append('logo', this.logoChannel);
                axios.put('/channels/' + this.channel.id,
                    {
                        title:this.titleChannel,
                        lang:this.selectedLang,
                        logo:this.logoChannel
                    }).then((response) => {
                    console.log(response.data);
                    this.showModal = false;
                    this.update();
                });
            },

            removeChannels: function (id) {
                axios.delete('/channels/' + id).then((response) => {
                    this.update();
                    console.log(response.data);
                });
            },

            clickChangeChannels(id) {
                this.showModal = true;
                this.titleModal = "Редактирование канала"
                this.buttonModal = "Изменить"
                axios.get('/channels/' + id).then((response) => {
                    this.channel = response.data;
                    this.titleChannel = response.data.title;
                    this.logoChannel = response.data.logo;
                });
            },

            //----------------------------------------------------------------------------------------------------------


            //------------------Модальное окно----------------------------------
            closeOrOpenModal: function () {
                this.showModal = false;
            },

            //Форма добавление телеканала
            openModalNewChannel: function () {
                this.titleModal = "Добавление нового канала"
                this.buttonModal = "Добавить"
                this.showModal = true;
                this.titleChannel = "";
                this.logoChannel = "";
            },


            //----------------------------------События-----------------------------------------------------------------
            onChangeType(e) {
                this.selectedType = e.target.value;
            },


            onChangeLang(e) {
                this.selectedLang = e.target.value;
            },

            onChangeUser(e) {
                this.selectedUser = e.target.value;
            },

            onChangeServices(e) {
                this.selectedService = e.target.value;
            },
            onChangeWorkers(e) {
                this.selectedWorker = e.target.value;
            },
            onChangeDay(e) {
                this.selectedDay = e.target.value;
                console.log(this.selectedDay);
                this.getFreeTime(this.selectedDay);
            },
            onChangeTime(e) {
                this.selectedTime = e.target.value;
            },

            //--------------------------------------Другое--------------------------------------------------------------

            //Экспорт в данных в эксель
            exportExcel: function () {
                axios.get('/admin/appointment/export');
            },

            convertDat: function (date) {
                return moment(date).format('YYYY-MM-DD HH:ss')
            }
        }
    }
</script>

<style>
    .table {
        border-collapse: collapse;
        border-spacing: 0;
        cursor: pointer;
        width: 100%;
    }

    .table th, .table td {
        border: 1px solid #888;
        padding: 10px;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }


</style>
