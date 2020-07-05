<template>
    <div>
        <h1>Laramovies</h1>
        <p>
            <router-link :to="{ name: 'home' }" exact>Home</router-link>
            <router-link :to="{ name: 'hello' }">Hello</router-link>
            <router-link :to="{ name: 'events.index' }">Events</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>