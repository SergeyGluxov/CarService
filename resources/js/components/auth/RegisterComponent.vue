<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Регистрация</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя: </label>

                            <div class="col-md-6">
                                <input v-model="form_name" id="name" type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email: </label>

                            <div class="col-md-6">
                                <input v-model="form_email" id="email" type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Введите номер телефона:</label>

                            <div class="col-md-6">
                                <input v-model="phone" id="phone" type="text"
                                       class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input v-model="form_password" id="password" type="password" class="form-control"
                                       name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Повторите
                                пароль:</label>

                            <div class="col-md-6">
                                <input v-model="form_confirm_password" id="password-confirm" type="password"
                                       class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-4">
                                <button @click="register" class="btn btn-primary btn-lg btn-block" type="submit">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                form_name: '',
                form_email: '',
                form_password: '',
                form_confirm_password: '',
                phone: ''
            }
        },
        mounted() {
        },
        methods: {
            register: function () {
                const formData = new FormData();
                formData.append('name', this.form_name);
                formData.append('email', this.form_email);
                formData.append('password', this.form_password);
                formData.append('password_confirmation', this.form_confirm_password);
                formData.append('phone', this.phone);
                axios.post('/auth/register', formData)
                    .then(response => {
                        window.location = "/home"
                    });
            }
        }
    }
</script>
