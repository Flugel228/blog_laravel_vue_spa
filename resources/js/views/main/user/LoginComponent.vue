<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <h1 class="edica-page-title" data-aos="fade-up">Sign In</h1>
                </div>
                <section class="edica-contact py-5 mb-5">
                    <div class="row">
                        <div class="col-md-8 contact-form-wrapper">
                            <h5 data-aos="fade-up">Sign In Form</h5>
                            <div class="row">
                                <div class="form-group col-md-6" data-aos="fade up">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email address"
                                           v-model="email"
                                    >
                                </div>
                                <div class="form-group col-md-6" data-aos="fade up">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password"
                                           v-model="password"
                                    >
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg" data-aos="fade-up"
                                        data-aos-delay="300"
                                        @click.prevent="login"
                                >Sign In
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</template>

<script>
import axios from "axios";

export default {
    name: "Login Component",
    data: () => ({
        email: '',
        password: '',
        api: null
    }),

    methods: {
         login() {
             axios.post('http://localhost:8876/api/auth/login', {
                email: this.email,
                password: this.password
            }).then(res => {
                localStorage.setItem('access_token', res.data.access_token)
                document.cookie = "jwt=" + res.data.access_token + "; path=/";
                this.$router.push({name: 'main.index.index'})
            }).catch(error => {
                console.log(error);
                if (error.response.data.error === 'Unauthorized') {
                    alert('The email or password was entered incorrectly.')
                }
            })
        },
    }
}
</script>

<style scoped>

</style>
