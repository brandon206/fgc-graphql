<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-blue-500">Home Component</div>

                    <div class="card-body">
                        I'm an home component.
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
