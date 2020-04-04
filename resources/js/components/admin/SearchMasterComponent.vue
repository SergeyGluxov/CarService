<template>
    <div class="container">
        <div class="form-group has-feedback has-search">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="form-group">
            <div class="">
                <input type="submit" class="btn btn-primary" value="Найти свободного мастера">
            </div>
        </div>
    </div>
</template>
<style>
    .main {
        width: 50%;
        margin: 50px auto;
    }

    /* Bootstrap 3 text input with search icon */

    .has-search .form-control-feedback {
        right: initial;
        left: 0;
        color: #ccc;
    }

    .has-search .form-control {
        padding-right: 12px;
        padding-left: 34px;
    }

</style>
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
