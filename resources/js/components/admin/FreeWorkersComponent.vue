<template>
    <div class="container">
        <label class="control-label ">{{selectedDay}}</label>
        <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Должность</th>
                <!--TODO: Отображать не ID, а название-->
            </tr>
            </thead>
            <tbody v-for="worker in freeWorkers">
            <tr>
                <td>{{worker.name}}</td>
                <td>{{worker.role[0].name}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import moment from "moment";
    import {bus} from "../../app";

    export default {
        data: function () {
            return {
                freeWorkers: [],
                freeTime: [],
                freeDate: [],
                selectedDay: '',
                selectedTime: ''

            }
        },
        mounted() {
            this.getFreeDate();
            bus.$on('first-event', date => {
                this.selectedDay = date
            });
            bus.$on('search-event', date => {
                this.getFreeWorkers(date)
            });
            console.log('ПОЛУЧЕНО: ' + this.selectedDay)
        },
        methods: {
            update: function (page) {

            },
            //----------------------Получить свободных мастеров---------------------------------------------

            getFreeWorkers: function (searchDate) {
                console.log(searchDate);
                const formData = new FormData();
                formData.append('search_date', searchDate);
                axios.post('/api/workersFree', formData).then((response) => {
                    this.freeWorkers = response.data;
                    console.log(response.data);
                });
                console.log(this.freeTime);
            },

            onChangeDay(e) {
                this.selectedDay = e.target.value;
                console.log(this.selectedDay);
                this.getFreeTime(this.selectedDay);
            },
            onChangeTime(e) {
                this.selectedTime = e.target.value;
            },
            getFreeTime: function (reqDate) {
                const formData = new FormData();
                formData.append('request_date', reqDate);
                axios.post('/api/admin/appointment/getFreeTime', formData).then((response) => {
                    this.freeTime = response.data;
                });
                console.log(this.freeTime);
            },
            convertDat: function (date) {
                return moment(date).format('YYYY-MM-DD HH:ss')
            },
            getFreeDate: function () {
                for (let i = 0; i <= 7; i++) {
                    let dayData = {
                        //Y-m-d H:i:s
                        day: moment().add(i, 'days').locale('ru').format('YYYY-MM-DD HH:mm:ss'),
                        printValue: moment().add(i, 'days').format('LL')
                    };
                    this.freeDate.push(dayData);
                }
                console.log(this.freeDate);
            },
        }
    }
</script>
