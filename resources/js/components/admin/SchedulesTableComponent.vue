//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <div class="row">
            <button class="btn btn-primary" @click="store">Добавить в расписание</button>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Расписание работ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Должность</th>
                                <th>Зарегистрирован</th>
                                <th>Последнее изменение</th>
                                <!--TODO: Отображать не ID, а название-->
                                <th>Автомобиль</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody v-for="col in schedules">
                            <tr>
                                <td>{{col.user.name}}</td>
                                <td>{{col.user.role.name}}</td>
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
        data: function () {
            return {
                schedules: []
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                axios.get('/api/schedules').then((response) => {
                    this.schedules = response.data;
                    console.log(response.data);
                });
            },
            store: function () {
                //Объект formData
                const formData = new FormData();
                formData.append('user_id', 1);
                formData.append('appointment_id', 1);
                //Отправка самого запроса
                axios.post('/api/schedules', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                        this.update();
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            }
        }
    }
</script>
