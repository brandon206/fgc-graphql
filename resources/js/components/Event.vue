<template>
    <div>
        <div v-if="loading">
            Loading...
        </div>
        <div v-else class="event-info border-b border-gray-800">
            <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
                <div class="flex-none">
                    <img
                        v-if="data.images"
                        :src="data.images[0].url"
                        alt="event-image"
                        class="w-96"
                    />
                </div>
                <div class="md:ml-24">
                    <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ data.name }}</h2>
                    <!-- <div class="flex flex-wrap items-center text-gray-400 text-sm"> -->
                    <div>
                        <a class="text-sm" :href="data.primaryContact">
                            <svg style="display: inline-block" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 75 75">
                                <path d="M66 17.25H9c-.824 0-1.5.676-1.5 1.5v37.5c0 .824.676 1.5 1.5 1.5h57c.824 0 1.5-.676 1.5-1.5v-37.5c0-.824-.676-1.5-1.5-1.5zm-3.602 3L37.5 45.148 12.602 20.25zM10.5 22.352L25.648 37.5 10.5 52.648zm2.176 32.398L27.75 39.676l8.7 8.699c.6.602 1.5.602 2.1 0l8.7-8.7L62.324 54.75zM64.5 52.648L49.352 37.5 64.5 22.352zm0 0"/>
                                <path d="M603-382.5v1263H-735v-1263H603m6-6H-741v1275H609zm0 0" fill="#00f"/>
                            </svg>
                            {{ data.primaryContact }}
                        </a>
                    </div>
                    <div>
                            <svg style="display: inline-block" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 75 75">
                                <path d="M61.5 17.25h-6v-3c0-.824-.676-1.5-1.5-1.5s-1.5.676-1.5 1.5v3h-30v-3c0-.824-.676-1.5-1.5-1.5s-1.5.676-1.5 1.5v3h-6c-3.3 0-6 2.7-6 6v33c0 3.3 2.7 6 6 6h48c3.3 0 6-2.7 6-6v-33c0-3.3-2.7-6-6-6zm3 39c0 1.648-1.352 3-3 3h-48a3.01 3.01 0 01-3-3v-22.5h54zm0-25.5h-54v-7.5c0-1.648 1.352-3 3-3h6v4.5c0 .824.676 1.5 1.5 1.5s1.5-.676 1.5-1.5v-4.5h30v4.5c0 .824.676 1.5 1.5 1.5s1.5-.676 1.5-1.5v-4.5h6c1.648 0 3 1.352 3 3zm0 0"/>
                                <path d="M183-592.5v1263h-1338v-1263H183m6-6h-1350v1275H189zm0 0" fill="#00f"/>
                            </svg>
                            <span v-if="data.startAt && data.endAt" class="text-white font-semibold">{{ doFormatting(data.startAt) }} - {{ doFormatting(data.endAt) }}</span>
                    </div>
                    <div>
                            <!-- <span class="mx-2">|</span> -->
                            <svg style="display: inline-block" fill="#ffffff" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 75 75">
                                <path d="M37.5 6c-11.55 0-21 9.3-21 20.773 0 24.454 19.2 41.176 20.023 41.926.528.45 1.426.45 1.954 0C39.3 67.95 58.5 51.15 58.5 26.773 58.5 15.301 49.05 6 37.5 6zm0 59.477c-3.898-3.75-18-18.75-18-38.704C19.5 16.95 27.602 9 37.5 9s18 7.95 18 17.773c0 19.954-14.102 34.954-18 38.704zM37.5 15c-6.602 0-12 5.398-12 12s5.398 12 12 12 12-5.398 12-12-5.398-12-12-12zm0 21c-4.95 0-9-4.05-9-9s4.05-9 9-9 9 4.05 9 9-4.05 9-9 9zm0 0"/>
                                <path d="M1233-277.5v1263H-105v-1263h1338m6-6H-111v1275h1350zm0 0" fill="#00f"/>
                            </svg>
                            {{ data.venueAddress }}
                        </div>
                    <div v-if="data.owner">
                        <p>Organizer: {{ data.owner.name }}</p>
                        <p v-if="data.owner.bio">Bio: {{ data.owner.bio }}</p>
                    </div>
                    <p class="text-gray-300 mt-8">Rules: {{ data.rules }}</p>
                    <div class="mt-12">
                        <h4 class="text-white font-semibold">
                            Featured Commentators
                        </h4>
                        <div class="flex mt-4">
                            <div>
                                <div>Mr. Aquaman</div>
                                <div class="text-sm text-gray-400">
                                    Color Caster, Play-by-Play
                                </div>
                            </div>
                            <div class="ml-8">
                                <div>Samoy</div>
                                <div class="text-sm text-gray-400">
                                    Color Caster
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12">
                        <button
                            class="flex.items-center.bg-orange-500.text-gray-900.rounded.font-semibold.px-5.py-4.hover:bg-orange-600 transition ease-in-out duration-150"
                        >
                            <span>Register for Event</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="entrants border-b border-b border-gray-800">
                <div class="container mx-auto px-4 py-16">
                    <h2 class="text-4xl font-semibold">Entrants</h2>
                    <div
                        v-if="data.participants"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8"
                    >
                        <div v-for="(participant,index) in data.participants.nodes" :key="index" class="px-4 md:px-0 mt-8">
                            <a v-if=" participant.images.length != 0" href="#">
                                <img
                                    :src="participant.images[0]"
                                    alt="event-1"
                                    class="w-64lg:w-96 hover:opacity-75 transition ease-in-out duration-150"
                                />
                            </a>
                            <a v-else href="#">
                                <img
                                    
                                    src="http://placehold.jp/224x224.png"
                                    alt="event-1"
                                    class="w-64lg:w-96 hover:opacity-75 transition ease-in-out duration-150"
                                />
                            </a>
                            <div class="mt-4">
                                <div
                                    class="flex items-center text-white font-semibold"
                                >
                                    <span>{{ participant.gamerTag }}</span>
                                </div>
                                <div v-if="participant.entrants" class="text-sm text-gray-400">
                                    <div>
                                        Games Entered:
                                    </div>
                                    <div style="padding-left: 12px;">
                                        <ul>
                                            <li style="list-style: disc" v-for="(entry, index) in participant.entrants" :key="index">
                                                {{ entry.event.name }} <span v-if="entry.seeds">(Seed: {{ entry.seeds[0].seedNum}})</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div v-else class="text-sm text-gray-400">
                                    Spectator
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
                data: [],
                id: null,
                loading: false,
                totalPages: null,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.id = this.$route.params.id;
            // this.totalParticipants = this.$route.params.totalParticipants;
            this.fetchData();
        },
        methods: {
            fetchData() {
                    this.loading = true;
                    axios
                    .get(`/api/event/${this.id}`)
                    .then(res => {
                        debugger;
                        console.log(res.data.tournament);
                        this.data = res.data.data.tournament;
                        this.totalPages = res.data.data.tournament.participants.pageInfo.totalPages;
                    });
                this.loading = false;
            },
            // fetchData() {
            //     let morePagesAvailable = true;
            //     let currentPage = 0;
            //     let allData = [];
            //     while(morePagesAvailable) {
            //         this.loading = true;
            //         currentPage++;
                    
            //         axios
            //         .get(`/api/event/${this.id}`)
            //         .then(res => {
            //             debugger;
            //             console.log(res.data.tournament);
            //             data = res.data.data.tournament;
            //             data.forEach(e => allData.unshift(e));
            //             morePagesAvailable = currentPage < 2;
            //         });
            //     }
            //     this.loading = false;
            // },
            // fetchData() {
            //     let morePagesAvailable = true;
            //     let currentPage = 0;
            //     while(this.morePagesAvailable) {
            //         this.loading = true;
            //         currentPage++;
            //         const response = axios
            //         .get(`/api/event/${this.id}`, {
            //             currentPage
            //         })
            //         .then(res => {
            //             debugger;
            //             console.log(res.data.tournament);
            //             data = res.data.data.tournament;
            //             data.forEach(e => this.data.unshift(e));
            //             morePagesAvailable = currentPage < total_pages;
            //         });
            //     }
            // },
            doFormatting(date) {
                var result = fromUnixTime(date);
                result = format(result, 'MM/dd/yyyy');
                return result;
            },
        },
    }
</script>