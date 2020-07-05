import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import App from './App.vue'
import Hello from './components/Hello.vue'
import Home from './components/Home.vue'
import EventsIndex from './components/EventsIndex.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello
        },        
        {
            path: '/events',
            name: 'events.index',
            component: EventsIndex
        },        
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});