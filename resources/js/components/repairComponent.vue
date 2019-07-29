<template>

    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">Запись на ремонт авто</h4>
                <form class="needs-validation" novalidate="">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="part">Ремонтируемый узел</label>
                            <select class="custom-select" id="part" required="">
                                <option value="">Выбрать...</option>
                                <option>Двигатель</option>
                                <option>Трансмиссия</option>
                                <option>Ходовая система</option>
                                <option>Электроника</option>
                                <option>Рулевые узлы</option>
                                <option>Кузов</option>
                            </select>
                            <div class="invalid-feedback">
                                Пожалуйста выберите ремонтируемый узел.
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="part1">Выберите СТО:</label>
                            <input type="text" class="form-control" id="part1" placeholder="Открыть карту" required="">
                            <div class="invalid-feedback" style="width: 100%;">
                                СТО не выбрано.
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
    export default {
        name: "repairComponent.vue"
    }
    $(document).ready(function () {
        $('#repairComponent').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/repair',
                data: $('#repairComponent').serialize(),
            });
        });
    });
</script>

<style scoped>
    body {
        color: white;
    }
    H4 {color: #cccccc; /* серый цвет */}
    label {color: #cccccc; /* серый цвет */}
</style>