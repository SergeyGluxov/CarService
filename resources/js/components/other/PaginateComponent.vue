<template>
    <div class="container">
        <v-pagination v-model="currentPage"
                      :page-count="totalPages"
                      :classes="bootstrapPaginationClasses"
                      :labels="paginationAnchorTexts"></v-pagination>
    </div>
</template>

<script>
    import vPagination from 'vue-plain-pagination'

    export default {
        components: { vPagination },
        data() {
            return {
                currentPage: 1,
                totalPages: 30,
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
        }
    }
</script>
<style>

</style>