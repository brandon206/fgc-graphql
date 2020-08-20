<template>
    <div>
        <div class="border-b border-gray-800">
            <div class="container flex mx-auto px-4 flex flex-col md:flex-row items-center justify-between py-6">
                <ul class="flex flex-col md:flex-row items-center">
                    <li class="hover:text-gray-300"><router-link :to="{ name: 'home' }" exact><img class="h-6" src="../images/fgc-logo.png"/></router-link></li>
                    <!-- <li class="ml-12 hover:text-gray-300"><router-link :to="{ name: 'home' }" exact>Home</router-link></li> -->
                    <li class="mt-3 md:mt-0 md:ml-12 hover:text-gray-300"><router-link :to="{ name: 'rankings' }">Rankings</router-link></li>
                    <li class="mt-3 md:mt-0 md:ml-12 hover:text-gray-300"><router-link :to="{ name: 'events.index' }">Events</router-link></li>
                    <li class="mt-3 md:mt-0 md:ml-12 hover:text-gray-300"><router-link :to="{ name: 'event.index' }">Event</router-link></li>
                </ul>
                <div class="flex flex-col md:flex-row items-center">
                    <div class="relative mt-3 md:mt-0">
                        <div class="absolute top-0">
                            <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
                        </div>
                        <input type="text" class="bg-gray-800 rounded-full w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline" placeholder="Search Events">
                    </div>
                    <div class="md:ml-4 mt-3 md:mt-0">
                        <router-link :to="{ name: 'events.index' }">
                            <img class="rounded-full w-8 h-8" src="../images/fgc-logo.png"/>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="container flex mx-auto">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { format } from 'date-fns'

export default {
    
}
</script>