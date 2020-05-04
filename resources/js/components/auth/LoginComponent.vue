<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Вход</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" v-model="form_email" type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"  class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" v-model="form_password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-5 offset-md-4">
                                <button @click="login" class="btn btn-primary btn-lg btn-block" type="submit">
                                    Войти
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
                form_email:'',
                form_password:''
            }
        },
        methods: {
            login: function () {
                const formData = new FormData();
                formData.append('email', this.form_email);
                formData.append('password', this.form_password);
                axios.post('/auth/login', formData)
                    .then(response => {
                        window.location="/home"
                    });
            }
        }
    }
</script>
