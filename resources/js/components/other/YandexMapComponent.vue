<template>
    <div id="map" style="width: 100%; height: 400px"></div>
</template>
<script>
    export default {
        data: function () {
            return {
                sto: []
            }
        },
        mounted() {
            ymaps.ready(this.init);
        },
        methods: {
            //клик по меткам
            onObjectEvent: function (e) {
                var objectId = e.get('objectId');
                //Получить объект по индексу
                console.log(this.sto[objectId-1].name);
            },
            init: function () {
                var myMap = new ymaps.Map("map", {
                    center: [55.354727, 86.088374],
                    zoom: 11
                }, {
                    searchControlProvider: 'yandex#search'
                });
                var objectManager = new ymaps.ObjectManager({
                    clusterize: false,
                    gridSize: 32,
                    clusterDisableClickZoom: true
                });
                objectManager.objects.options.set('preset', 'islands#blueAutoIcon');
                objectManager.clusters.options.set('preset', 'islands#blueAutoIcon');
                myMap.geoObjects.add(objectManager);

                /*Запрос меток по адресу*/
                axios.get('/sto').then((response) => {
                    this.sto = response.data;
                    for (var item = 0; item < this.sto.length; item++) {
                        objectManager.add({
                            "type": "FeatureCollection",
                            "features": [{
                                "type": "Feature",
                                //задаем id объекта, как id записи
                                "id": this.sto[item].id,
                                "geometry": {
                                    "type": "Point",
                                    "coordinates": [this.sto[item].coordinate_x, this.sto[item].coordinate_y]
                                },
                                "properties": {
                                    "balloonContentHeader": `<h4>СТО "${this.sto[item].name}"</h4>`,
                                    "balloonContentBody": `Адрес: ${this.sto[item].address}<br>Телефон: ${this.sto[item].address}<br><br><button class="center btn btn-primary">Выбрать дату и время</button>`,
                                }
                            }]
                        });
                    }
                });
                objectManager.events.add("click",this.onObjectEvent);
            },
        }
    }


</script>