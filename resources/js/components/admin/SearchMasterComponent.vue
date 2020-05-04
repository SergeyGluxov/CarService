<template>
    <div class="container">
        <label class="control-label ">Задайте интервал для поиска свободных мастеров:</label>

        <div class="form-group">
            <div class="col-xs-3">
                <datapicker-component></datapicker-component>
            </div>
            <div class="col-xs-3">
                <datapicker-component></datapicker-component>
            </div>

            <div class="col-xs-3">
                <input type="submit" class="btn btn-primary" value="Найти свободного мастера">
            </div>
        </div>
        <div class="form-group">
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                appoint: []
            }
        },
        mounted() {
        },
        methods: {
            update: function (page) {

            },
        }
    }
</script>
