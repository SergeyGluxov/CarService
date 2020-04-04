<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="mb-3">Запись на диагностику авто</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="part">Что диагностируем?</label>
                        <select @change.capture="onChange($event)" class="custom-select" name="part" id="part"
                                required="">
                            <option value="" disabled selected>Выбрать...</option>
                            <option v-for="part in part_checkup">{{part.category}}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="part">Выберите СТО:</label>
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <select class="custom-select" id="STO" required="">
                                    <option value="" disabled selected>Выбрать...</option>
                                    <option v-for="part in sto_checkup">{{part.title}}</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <!--@click="visible=!visible"-->
                                <button id="bt_map" class="btn btn-primary" type="submit">
                                    <i class="fas fa-map fa-1x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Выберите дату и время:</label>
                    <div class="container">
                        <div class="row">
                            <datapicker-component></datapicker-component>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <button @click="store" class="btn btn-primary btn-lg btn-block" type="submit">Записаться</button>
                </div>
            </div>
            <div class="col-md-6">
                <yandex-map-component></yandex-map-component>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data: function () {
            return {
                /** Просто пример как данные отображаются в списках,
                 * здесь будут просто пустые массивы для хранения полученных данных
                 * axios запросами**/
                errorValidation: {},
                selected: {},
                part_checkup: [
                    {index:'1', category: 'Подвеска'},
                    {index:'2', category: 'Кузов'},
                    {index:'3', category: 'Топливная система'},
                ],
                sto_checkup: [
                    {index:'1', title: 'СТО на Мичурина'},
                    {index:'2', title: 'СТО "Квадрат"'},
                    {index:'3', title: 'СТО "Шараш-Монтаж"'},
                ]
            }
        },
        mounted() {
        },
        methods: {
            store: function () {
                //Объект formData
                const formData = new FormData();
                formData.append('type_service', 'Осмотр');
                formData.append('description', this.selected);
                //Отправка самого запроса
                axios.post('/api/appointment', formData)
                    .then(response => {
                        console.log('Запрос успешен!')
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            alert('Введите корректные данные!')
                        }
                    });
            },
            onChange(e) {
                alert(e.target.index)
                this.selected = e.target.value;
            }
        }
    }
</script>
<style>
    body {
        color: white;
    }
</style>
