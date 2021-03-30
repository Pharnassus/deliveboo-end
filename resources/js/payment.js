require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        order: [],
        total: 0
    },
    mounted() {
        if (localStorage.total) {
            this.total = Number(localStorage.total);
        }
        if(localStorage.getItem('order')) {
            this.order = JSON.parse(localStorage.getItem('order'));
        }
    },
    methods: {
        deleteOrder() {
            localStorage.total = "";
            localStorage.order = "";
            localStorage.count = 0;
        }

    },
    watch: {
        total(newtotal) {
            localStorage.total = newtotal;
        },
        order: {
            handler() {
                localStorage.setItem('order', JSON.stringify(this.order));
            },
            deep: true
        }
    }
});