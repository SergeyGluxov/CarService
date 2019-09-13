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
                    <td>{{col.created_at.date}}</td>
                </tr>
                </tbody>
            </table>

        </div>
        <v-pagination v-model="appoint.current_page"
                      :page-count="appoint.last_page"
                      :classes="bootstrapPaginationClasses"
                      :labels="paginationAnchorTexts"
                      @input="update(appoint.current_page)">
        </v-pagination>
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