<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <h1 class="edica-page-title" data-aos="fade-up">Sign Up</h1>
                </div>
                <section class="edica-contact py-5 mb-5">
                    <div class="row">
                        <div class="col-md-8 contact-form-wrapper">
                            <h5 data-aos="fade-up">Sign Up Form</h5>
                            <div class="row">
                                <div class="form-group col-md-6" data-aos="fade up">
                                    <label for="name">Name</label>
                                    <input v-model="name" type="text" class="form-control" id="name" name="name"
                                           placeholder="Your full name">
                                </div>
                                <div class="form-group col-md-6" data-aos="fade up">
                                    <label for="email">Email</label>
                                    <input v-model="email"
                                           type="email"
                                           :class="{
                                              'form-control': true,
                                              'input-error': errors.email
                                           }"
                                           id="email"
                                           name="email"
                                           placeholder="Email address">
                                    <p class="text-error">{{errorMessages.email}}</p>
                                </div>
                                <div class="form-group col-md-6" data-aos="fade up">
                                    <label for="password">Password</label>
                                    <input v-model="password"
                                           type="password"
                                           :class="{
                                              'form-control': true,
                                              'input-error': errors.password
                                           }"
                                           id="password"
                                           name="password"
                                           placeholder="Password">
                                    <p class="text-error">{{errorMessages.password}}</p>
                                </div>
                                <div class="form-group col-md-6" data-aos="fade up">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input v-model="confirm_password"
                                           type="password"
                                           :class="{
                                              'form-control': true,
                                              'input-error': errors.confirm_password
                                           }"
                                           id="confirm_password"
                                           name="confirm-password"
                                           placeholder="Confirm password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg" data-aos="fade-up"
                                        data-aos-delay="300"
                                        @click.prevent="store"
                                >Sign Up
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
    name: "Registration Component",

    data: () => ({
        name: '',
        email: '',
        password: '',
        confirm_password: '',
        errors: {
            email: false,
            password: false,
            confirm_password: false
        },
        errorMessages: {
            email: '',
            password: '',
        }

    }),

    methods: {
        store() {
            this.validateData()
            if (
                !this.errors.email &&
                !this.errors.password &&
                !this.errors.confirm_password
            ) {
                axios.post('http://127.0.0.1:8876/api/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.confirm_password
                }).then(res => {
                    if (res.data.message === 'The user has been successfully created.') {
                        localStorage.setItem('access_token', res.data.accessToken)
                        alert('The user has been successfully created.')
                        this.$router.push({name: 'main.index'})
                    }
                }).catch(error => {
                    if (error.response.data.message === 'The user with this email already exists.') {
                        alert('The user with this email already exists.')
                    }
                })
            }
        },
        validateData() {
            for (let message in this.errorMessages) {
                this.errorMessages.message = ''
            }
            this.errors.email = !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(this.email)
            this.errors.password = !/^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*()_+=[\]{}|\\;:'",.<>/?`~\-]{8,128}$/.test(this.password)
            this.errors.confirm_password = !(this.password === this.confirm_password)
            if (this.errors.email) {
                this.errorMessages.email = 'The email address must be in the format example@example.com.'
            }
            if (this.errors.password) {
                this.errorMessages.password = 'The password must be at least 8 characters, contain at least one capital letter and one number.'
            }
        }
    }
}
</script>

<style scoped>
.input-error {
    box-shadow: 0 0 15px rgba(255, 0, 0, 0.7);
}
</style>
