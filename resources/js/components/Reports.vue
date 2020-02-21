<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reports</div>

                <div class="card-body">
                    Generate Reports
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Reports",
        mounted() {
            this.$Progress.start()
            this.$Progress.finish()
        }
    }
</script>

<style scoped>

</style>
