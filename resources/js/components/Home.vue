<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="container mx-auto flex flex-col md:flex-row px-4 pt-16">
                        <div class="popular-movies">
                            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Featured Events</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                                <div class="px-4 md:px-0 mt-8">
                                    <a href="#">
                                        <img src="../../images/sonic.jpg" alt="event-1" class="hover:opacity-75 transition ease-in-out duration-150">
                                    </a>
                                    <div class="mt-4">
                                        <a href="#" class="text-lg hover:text-gray:300">Event 1</a>
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <span>star</span>
                                            <span class="ml-1">85%</span>
                                            <span class="mx-2">|</span>
                                            <span>Feb 20, 2020</span>
                                        </div>
                                        <div class="text-gray-400">
                                            Action, Thriller, Comedy
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 md:px-0 mt-8">
                                    <a href="#">
                                        <img src="../../images/sonic.jpg" alt="event-1" class="hover:opacity-75 transition ease-in-out duration-150">
                                    </a>
                                    <div class="mt-4">
                                        <a href="#" class="text-lg hover:text-gray:300">Event 1</a>
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <span>star</span>
                                            <span class="ml-1">85%</span>
                                            <span class="mx-2">|</span>
                                            <span>Feb 20, 2020</span>
                                        </div>
                                        <div class="text-gray-400">
                                            Action, Thriller, Comedy
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 md:px-0 mt-8">
                                    <a href="#">
                                        <img src="../../images/sonic.jpg" alt="event-1" class="hover:opacity-75 transition ease-in-out duration-150">
                                    </a>
                                    <div class="mt-4">
                                        <a href="#" class="text-lg hover:text-gray:300">Event 1</a>
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <span>star</span>
                                            <span class="ml-1">85%</span>
                                            <span class="mx-2">|</span>
                                            <span>Feb 20, 2020</span>
                                        </div>
                                        <div class="text-gray-400">
                                            Action, Thriller, Comedy
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 md:px-0 mt-8">
                                    <a href="#">
                                        <img src="../../images/sonic.jpg" alt="event-1" class="hover:opacity-75 transition ease-in-out duration-150">
                                    </a>
                                    <div class="mt-4">
                                        <a href="#" class="text-lg hover:text-gray:300">Event 1</a>
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <span>star</span>
                                            <span class="ml-1">85%</span>
                                            <span class="mx-2">|</span>
                                            <span>Feb 20, 2020</span>
                                        </div>
                                        <div class="text-gray-400">
                                            Action, Thriller, Comedy
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 md:px-0 mt-8">
                                    <a href="#">
                                        <img src="../../images/sonic.jpg" alt="event-1" class="hover:opacity-75 transition ease-in-out duration-150">
                                    </a>
                                    <div class="mt-4">
                                        <a href="#" class="text-lg hover:text-gray:300">Event 1</a>
                                        <div class="flex items-center text-gray-400 text-sm">
                                            <span>star</span>
                                            <span class="ml-1">85%</span>
                                            <span class="mx-2">|</span>
                                            <span>Feb 20, 2020</span>
                                        </div>
                                        <div class="text-gray-400">
                                            Action, Thriller, Comedy
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
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        // created() {
        //     axios
        //         .get('/api/events')
        //         .then(res => {
        //             console.log(response.data);
        //         });
        // },
    }
</script>
