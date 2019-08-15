//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <button class = "btn btn-primary" @click="update">Обновить</button>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица пользователей</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Эл. почта</th>
                                <th>Зарегистрирован</th>
                                <th>Последнее изменение</th>
                                <!--TODO: Отображать не ID, а название-->
                                <th>Автомобиль</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in users">
                            <tr>
                                <td>{{col.name}}</td>
                                <td>{{col.email}}</td>
                                <td>{{col.created_at.date}}</td>
                                <td>{{col.updated_at.date}}</td>
                                <td>{{col.cars_id}}</td>
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
        data:function(){
          return{
              users:[]
          }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                axios.get('/api/users').then((response)=>{
                    this.users=response.data;
                    console.log(response.data);
                });
            }
        }
    }
</script>
