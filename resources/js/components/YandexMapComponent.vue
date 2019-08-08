<template>
        <div id="map" style="width: 100%; height: 400px"></div>
</template>
<script>
    // if (window.innerWidth >= 768){
    //
    // }
    ymaps.ready(init);
    var myMap;
    function init() {
            myMap = new ymaps.Map("map", {
                center: [55.354727, 86.088374],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            });
            objectManager = new ymaps.ObjectManager({
                // Чтобы метки начали кластеризоваться, выставляем опцию.
                clusterize: true,
                // ObjectManager принимает те же опции, что и кластеризатор.
                gridSize: 32,
                clusterDisableClickZoom: true
            });

            // Чтобы задать опции одиночным объектам и кластерам,
            // обратимся к дочерним коллекциям ObjectManager.
            objectManager.objects.options.set('preset', 'islands#redSportIcon');
            objectManager.clusters.options.set('preset', 'islands#redSportIcon');
            myMap.geoObjects.add(objectManager);

            /*Запрос меток по адресу*/
            $.ajax({
                // url: "data.json" запрос api адресов сервисов
            }).done(function () {
                objectManager.add({
                        "type": "FeatureCollection",
                        "features": [
                            {
                                "type": "Feature",
                                "id": 0,
                                "geometry": {"type": "Point", "coordinates": [55.354727, 86.088374]},
                                "properties": {
                                    "balloonContentHeader": "<font size=3><b><a target='_blank' href='https://yandex.ru'>Здесь может быть ваша ссылка</a></b></font>",
                                    "balloonContentBody": "<p>Ваше имя: <input name='login'></p><p><em>Телефон в формате 2xxx-xxx:</em>  <input></p><p><input type='submit' value='Отправить'></p>",
                                    "balloonContentFooter": "<font size=1>Информация предоставлена: </font> <strong>этим балуном</strong>",
                                    "clusterCaption": "<strong><s>Еще</s> одна</strong> метка",
                                    "hintContent": "<strong>Текст  <s>подсказки</s></strong>"
                                }
                            }]
                    }
                );
            });
    }
    //
    // window.onresize = function() {
    //     if (window.innerWidth >= 768) {
    //         if (!myMap){
    //             document.getElementById('bt_map').style.display='none';
    //             init();
    //         }
    //     }
    //     if (window.innerWidth <= 1024) {
    //         if (myMap){
    //             document.getElementById('bt_map').style.display='block';
    //             myMap.destroy();
    //             myMap=null;
    //         }
    //     }
    // };
</script>