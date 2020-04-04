//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-xs-3" for="role">Наименование должности:</label>
                <div class="col-xs-6">
                    <input type="text" class="form-control" id="role" placeholder="">
                </div>
            </div>
            <br />
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <input type="submit" class="btn btn-primary" value="Добавить должность">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                schedules: [],
                users: [],
                roles: []
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                axios.get('/api/users').then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });
                axios.get('/api/roles').then((response) => {
                    this.roles = response.data;
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
