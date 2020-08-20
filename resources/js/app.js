import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import App from './App.vue'
import Rankings from './components/Rankings.vue'
import Home from './components/Home.vue'
import EventsIndex from './components/EventsIndex.vue'
import Event from './components/Event.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/Rankings',
            name: 'Rankings',
            component: Rankings
        },        
        {
            path: '/events',
            name: 'events.index',
            component: EventsIndex
        },        
        {
            path: '/event/:id',
            name: 'event.show',
            component: Event
        },        
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});