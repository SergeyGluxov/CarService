<template>
    <div class="container">
        <paginate-component></paginate-component>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица записей на осмотр</h3>
                    </div>
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
                            <tbody v-for="col in appoint">
                            <tr>
                                <td>{{col.user.name}}</td>
                                <td>{{col.type_service}}</td>
                                <td>{{col.description}}</td>
                                <td>{{col.created_at.date}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:function(){
            return{
                appoint:[]
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                axios.get('/api/appointment').then((response)=>{
                    this.appoint=response.data;
                    console.log(response.data);
                });
            },
        }
    }
</script>