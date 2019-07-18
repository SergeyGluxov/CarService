<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица записей на осмотр</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                            <tbody v-for="col in admin_table">
                            <tr>
                                <td>{{col.name}}</td>
                                <td>{{col.description}}</td>
                                <td>{{col.created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'admin_table'
        ],
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                console.log(this.admin_table);
            }
        }
    }
</script>
