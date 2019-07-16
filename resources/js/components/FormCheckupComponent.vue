<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">Запись на диагностику авто</h4>
                <form class="needs-validation" novalidate="">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="part">Что диагностируем?</label>
                            <select class="custom-select" id="part" required="">
                                <option value="">Выбрать...</option>
                                <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="part1">Выберите СТО:</label>
                            <input type="text" class="form-control" id="part1" placeholder="Открыть карту" required="">
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
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
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Записаться</button>
                </form>
            </div>
            <div class="col-md-6 order-md-2 mb-4">
                <yandex-map-component></yandex-map-component>
            </div>
        </div>
    </div>
</template>


<script>

</script>
<style>
    body {
        color: white;
    }
</style>