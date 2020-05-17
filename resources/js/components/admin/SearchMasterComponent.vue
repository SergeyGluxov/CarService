<template>
    <div class="container">
        <label class="control-label ">Задайте интервал для поиска свободных мастеров:</label>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-3">
                    <select id="date" class="form-control" @change.capture="onChangeDay($event)">
                        <option value="" disabled selected>Выбрать дату...</option>
                        <option v-for="dat in freeDate" :value="dat.day"
                                :key="dat.day">{{dat.printValue}}
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="time" class="form-control" @change.capture="onChangeTime($event)">
                        <option value="" disabled selected>Выбрать время...</option>
                        <option v-for="time in freeTime" :value="time.time"
                                :key="time.time">{{time.time}}
                        </option>
                    </select>
                </div>

                <div type="button" class="btn btn-primary" @click="clickSearch">
                    <i class="fas fa-search fa-1x"></i>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    import moment from "moment";
    import {bus} from "../../app";

    export default {
        data: function () {
            return {
                appoint: [],
                freeTime: [],
                freeDate: [],
                selectedDay: '',
                selectedTime: ''

            }
        },
        mounted() {
            this.getFreeDate();
        },
        methods: {
            update: function (page) {

            },
            onChangeDay(e) {
                this.selectedDay = e.target.value;
                console.log(this.selectedDay);
                bus.$emit('first-event', this.selectedDay);
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
            clickSearch: function () {
                let formDate = moment(this.selectedDay).format('YYYY-MM-DD');
                console.log(this.selectedTime);
                let dd = formDate + " " + this.selectedTime;
                let formTime = moment(new Date(dd)).format('YYYY-MM-DD HH:mm:ss');
                console.log(formTime);
                bus.$emit('search-event', formTime);
            }
        }
    }
</script>
