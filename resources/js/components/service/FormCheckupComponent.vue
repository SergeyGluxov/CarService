<template>
    <div class="container">
        <custom-tab-component></custom-tab-component>
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
                selected: {},
                part_checkup: [
                    {category: 'Подвеска'},
                    {category: 'Кузов'},
                    {category: 'Топливная система'},
                ],
                sto_checkup: [
                    {title: 'СТО на Мичурина'},
                    {title: 'СТО "Квадрат"'},
                    {title: 'СТО "Шараш-Монтаж"'},
                ]
            }
        },
        mounted() {
            // this.get_part();
        },
        methods: {
            /**TODO: Получить список доступных для осмотр частей**/
            /**TODO: Получить список доступных автосервисов**/
            /**TODO: Получить список доступных дат для записи**/
            // get_part: function () {
            //     axios.get('/api/appointment').then((response)=>{
            //         this.part_checkup=response.data;
            //         console.log(response.data);
            //     });
            // },
            /**Метод отправки записи на осмотр**/
            store: function () {
                //Объект formData
                const formData = new FormData();
                formData.append('type_service', 'Осмотр');
                formData.append('description', this.selected);
                //Отправка самого запроса
                axios.post('/api/appointment', formData);
                console.log(formData);
            },
            onChange(e) {
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