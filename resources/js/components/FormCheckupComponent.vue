<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="mb-3">Запись на диагностику авто</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="part">Что диагностируем?</label>
                        <select class="custom-select" id="part" required="">
                            <option value="">Выбрать...</option>
                            <option>United States</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="part">Выберите СТО:</label>
                        <div class="row">
                            <div class="col-md-10 mb-3">
                                <select class="custom-select" id="STO" required="">
                                    <option value="">Выбрать...</option>
                                    <option>United States</option>
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
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Записаться</button>
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
        // data() {
        //     return {
        //         visible: false
        //     }
        // }
    }
</script>
<style>
    body {
        color: white;
    }
</style>