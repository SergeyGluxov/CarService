<template>
    <div class="container">
        <div class="row">
            <h2>Управление телеканалами</h2>


            <form class="form-inline" method="GET" action="/admin/appointment/export">
                <button id="show-modal" type="button" class="btn btn-success" v-on:click="openModalNewChannel()"><i
                    class="fa fa-plus"> Добавить</i>
                </button>
                <button id="show-modal-import" type="button" class="btn btn-info" @click="showModalImport = true">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </button>
                <button type="submit" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i></button>


            </form>
            <br>

            <label class="control-label">Фильтровать по категории:</label>
            <select @change.capture="onSelectFilterCategory($event)" class="form-control">
                <option value="" disabled selected>Выбрать...</option>
                <option v-for="category in categories" :value="category.title"
                        :key="category.title">{{category.display_name}}
                </option>
            </select>
            <br>
            <label class="control-label">Поиск по названию:</label>
            <input type="text" class="form-control" v-model="search" placeholder="Введите текст..."/>
            <br>

            <label class="control-label">Найдено {{channelCount}} телеканалов</label>
            <hr/>

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
                <tbody v-for="col in filteredList">
                <tr>
                    <td @click="clickChangeChannels(col.id)">{{col.id}}</td>
                    <td @click="clickChangeChannels(col.id)">{{col.title}}</td>
                        <td @click="clickChangeChannels(col.id)">{{col.category.display_name}}</td>
                    <td @click="clickChangeChannels(col.id)">{{col.lang}}</td>
                    <td><a v-bind:href="col.logo" target="_blank" :value="col.logo">Ссылка</a></td>
                    <td @click="clickEditPlaylist(col.id)"><a>Список источников</a></td>
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
                                        <select v-model="selectElementCategory" @change.capture="onChangeType($event)"
                                                class="form-control">
                                            <option value="" disabled selected>Выбрать...</option>
                                            <option v-for="category in categories" :value="category.title"
                                                    :key="category.title">{{category.display_name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Язык:</label>
                                    <div class="col-xs-9">
                                        <select v-model="selectElementLang" @change.capture="onChangeLang($event)"
                                                class="form-control">
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

                                    <div class="col-xs-offset-3 col-xs-9">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="">Топовый?</label>
                                        </div>
                                    </div>
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

        <div v-if="showModalPlaylist">
            <div class="modal fade-in" style="display: block;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="showModalPlaylist = false">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" v-text="modal_title_playlist">Редактирование плейлистов</h4>
                        </div>
                        <div class="modal-body">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody v-for="col in playlists">
                                <tr>
                                    <td>{{col.url}}</td>
                                    <td>
                                        <div type="button" class="btn btn-danger"
                                             v-on:click="deletePlaylistChannel(col.id)">
                                            <i class="fas fa-times " aria-hidden="true"></i></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-xs-3">Новый плейлист:</label>
                                    <div class="col-xs-9">
                                        <input type="text" class="form-control" id="url_playlist" v-model="playlistUrl"
                                               placeholder="http://a3569458063-s26881.cdn.ngenix.net/hls/russia_hd/playlist_4.m3u8">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-3 col-xs-12">
                                        <button type="button" @click="addNewPlaylistChannel"
                                                class="btn btn-success">
                                            Добавить источник
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
                search: '',
                channel: {},
                channels: [],
                categories: [],
                playlists: [],
                users: [],
                selectFilterCategory: '',
                channelCount: '',
                selectElementLang: '',
                selectElementCategory: '',
                discriptionInput: '',
                selectedCategory: '',
                selectedLang: '',
                titleChannel: '',
                titleModal: '',
                playlistUrl: '',
                modal_title_playlist: '',
                currentChannelForPlaylist: '',
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
                    {index: '1', lang: 'rus'},
                    {index: '2', lang: 'eng'},
                    {index: '3', lang: 'hin'},
                    {index: '3', lang: 'AZ'},
                ],
                showModal: false,
                showModalPlaylist: false,
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
        computed: {
            filteredList() {
                console.log("filteredList()");
                return this.channels.filter(filter => {
                    return filter.title.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },
        methods: {
            update: function () {
                this.getAllTvChannels();
                this.getCategories();
            },

            //----------------------Управление телеканалами-------------------------------------------------------------

            getAllTvChannels: function () {
                axios.get('/channels').then((response) => {
                    this.channels = response.data;
                    this.channelCount = response.data.length
                    console.log(response.data);
                });
            },

            filterByCategory: function (category) {
                const formData = new FormData();
                formData.append('category_name', category);

                axios.post('/category/channels', formData).then((response) => {
                    this.channels = response.data;
                    this.channelCount = response.data.length
                    console.log(response.data);
                });
            },

            createChannel: function () {
                const formData = new FormData();
                formData.append('title', this.titleChannel);
                formData.append('lang', this.selectedLang);
                formData.append('category_id', this.selectedCategory);
                formData.append('logo', this.logoChannel);
                axios.post('/channels', formData).then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                    this.showModal = false;
                    this.update();
                });
            },

            updateChannel: function () {
                axios.put('/channels/' + this.channel.id,
                    {
                        title: this.titleChannel,
                        lang: this.selectElementLang,
                        logo: this.logoChannel,
                        category_id: this.selectElementCategory
                    }).then((response) => {
                    console.log(response.data);
                    this.showModal = false;
                    if(this.currentCategory){
                        this.filterByCategory(this.currentCategory);
                    }else {
                        this.update();
                    }
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
                    console.log(response.data);
                    this.channel = response.data;
                    this.titleChannel = response.data.title;
                    this.logoChannel = response.data.logo;
                    this.selectElementLang = response.data.lang;
                    this.selectElementCategory = response.data.category.title;
                });
            },

            //----------------------------------------------------------------------------------------------------------


            //------------------------------------Плейлисты-------------------------------------------------------------
            clickEditPlaylist: function (id) {
                this.showModalPlaylist = true;
                axios.get('/channels/' + id).then((response) => {
                    this.playlists = response.data.playlists;
                    this.currentChannelForPlaylist = id;
                    this.modal_title_playlist = 'Редактирование плейлиста телеканала ' + response.data.title;
                    console.log(response.data);
                });
            },

            //Добавить плейлист к телеканалу
            addNewPlaylistChannel: function () {
                const formData = new FormData();
                formData.append('url', this.playlistUrl);
                formData.append('channel_id', this.currentChannelForPlaylist);
                axios.post('/channels/source', formData).then((response) => {
                    this.clickEditPlaylist(this.currentChannelForPlaylist);
                    this.playlistUrl = "";
                });
            },

            //Добавить плейлист к телеканалу
            deletePlaylistChannel: function ($id) {
                axios.delete('/channels/source/' + $id).then((response) => {
                    this.clickEditPlaylist(this.currentChannelForPlaylist);
                    this.playlistUrl = "";
                });
            },


            //------------------------------------Категории-------------------------------------------------------------
            getCategories: function () {
                axios.get('/categories').then((response) => {
                    this.categories = response.data;
                    console.log(response.data);
                });
            },

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
                this.selectedCategory = e.target.value;
            },

            onSelectFilterCategory(e) {
                this.currentCategory=e.target.value;
                this.filterByCategory(e.target.value);
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
