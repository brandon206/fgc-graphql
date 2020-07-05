<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Events Component</div>

                    <div class="card-body">
                        <div>FGC Events</div>
                        <div v-for="event in events" :key="event.id">
                            <div><a :href="event.slug">{{ event.name }}</a></div>
                            <div style="max-height=200px;" v-if="event.images.length !== 0">
                                <!-- <div v-for="image in event.images" :key="image.id"> -->
                                    <!-- <div>Am I going into here?</div> -->
                                    <img :src="event.images[0].url" alt="">
                                <!-- </div> -->
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
                    this.events = res.data.data.tournaments.nodes;
                    // debugger;
                    // console.log(event.images[0].url);
                    if(this.events[0].images.length === 0) {
                        console.log("don't have any images");
                    }
                    console.log(this.events[0].images);
                });
            }
        }
    }
</script>
