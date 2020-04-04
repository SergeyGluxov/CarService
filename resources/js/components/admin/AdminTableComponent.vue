<template>
    <div class="container">
        <div class="row">
            <h2>Записи на осмотр</h2>
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Описание</th>
                    <th>Время записи</th>
                    <th>Результат работы</th>
                    <!--TODO: Отображать не ID, а название-->
                </tr>
                </thead>
                <tbody v-for="col in appoint.data">
                <tr>
                    <td>{{col.type_service}}</td>
                    <td>{{col.description}}</td>
                    <td>{{col.description}}</td>
                    <td>{{col.description}}</td>
                    <td>{{col.created_at.date}}</td>
                </tr>
                </tbody>
            </table>

        </div>
      <!--  <v-pagination v-model="appoint.current_page"
                      :page-count="appoint.last_page"
                      :classes="bootstrapPaginationClasses"
                      :labels="paginationAnchorTexts"
                      @input="update(appoint.current_page)">
        </v-pagination>-->
       <!-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">Создание новой задачи</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Название задачи</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="body" class="col-md-4 col-form-label text-md-right">Описание задачи</label>

                        <div class="col-md-6">
                            <textarea id="body" type="area" class="form-control" name="body"/>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-5 offset-md-4">
                            <button @click="login" class="btn btn-primary btn-lg btn-block" type="submit">
                                Создать
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</template>

<script>
    import vPagination from 'vue-plain-pagination'

    export default {
        components: {vPagination},
        data: function () {
            return {
                appoint: [],
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
            this.update(1);
        },
        methods: {
            update: function (page) {
                axios.get('/api/appointment?page=' + page).then((response) => {
                    this.appoint = response.data;
                    console.log(response.data);
                });
            },
        }
    }
</script>
