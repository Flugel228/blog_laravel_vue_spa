<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <section class="edica-404">
                        <h1 class="page-title" data-aos="fade-up">404</h1>
                        <h5 class="edica-404-subtitle" data-aos="fade-up" data-aos-delay="100">Page not found!</h5>
                        <p class="edics-404-text" data-aos="fade-up" data-aos-delay="200">Oops! The page you are looking for does not exist. It might have been moved or deleted.</p>
                        <router-link :to="{ name: 'main.index' }" class="edica-404-link btn btn-warning" data-aos="fade-up" data-aos-delay="300">Go Back to Index Page</router-link>
                    </section>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "404",

    methods: {
        back() {
            this.$router.go(-1)
        }
    }
}
</script>

<style scoped>

</style>
