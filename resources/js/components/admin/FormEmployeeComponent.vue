//Тут есть пример как использовать api в запросе денных через axios
<template>
    <div class="container">
        <h2>Добавление сотрудника</h2>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-xs-3">Выберите пользователя:</label>
                <div class="col-xs-9">
                    <select class="form-control">
                        <option value="" disabled selected>Выбрать...</option>
                        <option v-for="user in users">{{user.name}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Выберите должность:</label>
                <div class="col-xs-9">
                    <select class="form-control">
                        <option value="" disabled selected>Выбрать...</option>
                        <option v-for="role in roles">{{role.name}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="pasport">Паспортные данные:</label>
                <div class="col-xs-3">
                    <input type="text" class="form-control" id="pasport" placeholder="Серия">
                </div>
                <div class="col-xs-3">
                    <input type="text" class="form-control" id="fatherName" placeholder="Номер">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3" for="inputEmail">Телефона:</label>
                <div class="col-xs-9">
                    <input type="email" class="form-control" id="inputEmail" placeholder="+7900123123">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" for="inputSNILS">СНИЛС:</label>
                <div class="col-xs-9">
                    <input type="password" class="form-control" id="inputSNILS" placeholder="Номер СНИЛС">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3" for="postalAddress">Адрес:</label>
                <div class="col-xs-9">
                    <textarea rows="3" class="form-control" id="postalAddress" placeholder="Введите адрес"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Пол:</label>
                <div class="col-xs-2">
                    <label class="radio-inline">
                        <input type="radio" name="genderRadios" value="male"> Мужской
                    </label>
                </div>
                <div class="col-xs-2">
                    <label class="radio-inline">
                        <input type="radio" name="genderRadios" value="female"> Женский
                    </label>
                </div>
            </div>
            <br />
            <div class="form-group">
                <div class="col-xs-offset-3 col-xs-9">
                    <input type="submit" class="btn btn-primary" value="Добавить сотрудника">
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
