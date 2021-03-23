<template>
    <div class="container">
        <div class="row">
            <h2>Топ популярных каналов</h2>

            <form class="form-inline" method="GET" action="/admin/appointment/export">
                <button id="show-modal" type="button" class="btn btn-success" v-on:click="openModalNewChannel()"><i
                    class="fa fa-plus"> Добавить</i>
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
                    <td>{{col.id}}</td>
                    <td>{{col.title}}</td>
                    <td>{{col.category.title}}</td>
                    <td>{{col.lang}}</td>
                    <td><a v-bind:href="col.logo"  target="_blank" :value="col.logo">Ссылка</a></td>
                    <td><a>Список источников</a></td>
                    <td>
                        <div type="button" class="btn btn-danger">
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
                                            <option v-for="category in categories" :value="category.id"
                                                    :key="category.title">{{category.title}}
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
                channels: [],
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
        methods: {
            update: function () {
                this.getTopTvChannels();
            },

            //----------------------Управление телеканалами-------------------------------------------------------------

            getTopTvChannels: function () {
                const formData = new FormData();
                formData.append('is_top', 1);
                var query = '?is_top=1'
                axios.get('/filter/channels' + query).then((response) => {
                    this.channels = response.data;
                    console.log(response.data);
                });
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
