require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
    },
    created() {
        localStorage.total = "";
        localStorage.order = [];
    },
    mounted() {
        setTimeout(function() {
            window.location.href = 'http://127.0.0.1:8000/homepage';
        }, 3000);
    }
});