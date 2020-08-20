<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container mx-auto flex flex-col md:flex-row px-4 pt-16">
                        <div class="popular-movies">
                            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Featured Events</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                                <div v-for="event in events" :key="event.id" class="px-4 md:px-0 mt-8">
                                    <router-link v-if="event.images" :to="{ name: 'event.show', params: {id: event.id} }">
                                        <img :src="event.images[0].url" alt="" class="hover:opacity-75 transition ease-in-out duration-150" style="min-height: 224px;">
                                    </router-link>
                                    <div class="mt-4" style="max-height=200px;" v-if="event.images.length !== 0">
                                        <a :href="event.slug" class="text-lg hover:text-gray:300">{{ event.name }}</a>
                                        <div class="text-gray-400">
                                            <span class="text-white font-semibold">Attendees:</span> {{ event.numAttendees ? event.numAttendees : 'N/A' }}
                                        </div>
                                        <div class="text-gray-400">
                                            <span class="text-white font-semibold">Address:</span> {{ event.venueAddress }}
                                        </div>
                                        <div class="text-gray-400">
                                            <span class="text-white font-semibold">Starts At:</span> {{ doFormatting(event.startAt) }}
                                        </div>
                                        <div class="text-gray-400">
                                            <span class="text-white font-semibold">Registration Closes:</span> {{ doFormatting(event.registrationClosesAt) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { format, fromUnixTime } from 'date-fns';

    export default {
        data() {
            return {
                events: [],
                loading: false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
            this.loading = true;
            axios
                .get('/api/events')
                .then(res => {
                    this.loading = false;
                    debugger;
                    this.events = res.data;
                    console.log(this.events);
                    this.events.forEach(event => {
                        if(event.images.length === 0) {
                            // event.images = [{ url: 'http://placehold.jp/224x224.png' }];
                            event.images = [{ url: '../../images/no-image.png' }];
                        }
                    });
                    // if(this.events[0].images.length === 0) {
                    //     this.events[0].images = [{ url: 'http://placehold.jp/224x224.png' }];
                    // }
                });
            },
            doFormatting(date) {
                var result = fromUnixTime(date);
                return result;
            }
        }
    }
</script>
