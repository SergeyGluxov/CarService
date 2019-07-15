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
                        <label >Выберите дату и время:</label>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4538.506878606129!2d86.075949278537!3d55.336121704455664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x42d80c06318f83d9%3A0xab5211326750408e!2z0YPQuy4g0JzQuNGH0YPRgNC40L3QsCwgNTcsINCa0LXQvNC10YDQvtCy0L4sINCa0LXQvNC10YDQvtCy0YHQutCw0Y8g0L7QsdC7LiwgNjUwMDU1!5e0!3m2!1sru!2sru!4v1563094975403!5m2!1sru!2sru"
                        frameborder="0"
                        style="border:0; width: 100%; height: 150%"
                        allowfullscreen>
                </iframe>
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