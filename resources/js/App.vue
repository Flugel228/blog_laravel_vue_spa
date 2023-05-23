<template>
    <div class="edica-loader"></div>
    <header class="edica-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <router-link class="navbar-brand" :to="{ name: 'main.index.index' }"><img
                    src="../../public/assets/images/logo.svg"
                    alt="Edica">
                </router-link>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                        data-target="#edicaMainNav"
                        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="edicaMainNav">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{ name: 'main.index.index' }">Home <span
                                class="sr-only">(current)</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'main.about.index' }">About</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <router-link class="nav-link" :to="{ name: 'main.posts.index' }">Blog</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'main.contacts.index' }">Contacts</router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav"
                        v-if="accessToken">
                        <li class="nav-item row">
                            <router-link :to="{ name: 'main.user' }" class="nav-link"><i
                                class="nav-icon far fa-regular fa-user"></i>
                                {{ user.name }}
                            </router-link>
                        </li>
                        <li class="nav-item row">
                            <a @click.prevent="logout" class="nav-link logout"><i class="nav-icon fa fa-sign-out"
                                                                                  aria-hidden="true"></i>
                                Logout</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav"
                        v-else>
                        <li class="nav-item row">
                            <router-link :to="{ name: 'main.signup' }" class="nav-link"><i
                                class="nav-icon fas fa-user-plus"></i> Sign
                                Up
                            </router-link>
                        </li>
                        <li class="nav-item row">
                            <router-link :to="{ name: 'main.signin' }" class="nav-link"><i
                                class="nav-icon far fa-regular fa-user"></i> Sign In
                            </router-link>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <router-view :key="$route.fullPath"></router-view>
    <section class="edica-footer-banner-section">
        <div class="container">
            <div class="footer-banner" data-aos="fade-up">
                <h1 class="banner-title">Download it now.</h1>
                <div class="banner-btns-wrapper">
                    <button class="btn btn-success"><img src="../../public/assets/images/apple@1x.svg" alt="ios"
                                                         class="mr-2"> App Store
                    </button>
                    <button class="btn btn-success"><img src="../../public/assets/images/android@1x.svg" alt="android"
                                                         class="mr-2">
                        Google Play
                    </button>
                </div>
                <p class="banner-text">Add some helper text here to explain the finer details of your <br> product or
                    service.</p>
            </div>
        </div>
    </section>
    <footer class="edica-footer" data-aos="fade-up">
        <div class="container">
            <div class="row footer-widget-area">
                <div class="col-md-3">
                    <a href="index.html" class="footer-brand-wrapper">
                        <img src="../../public/assets/images/logo.svg" alt="edica logo">
                    </a>
                    <p class="contact-details">hello@edica.com</p>
                    <p class="contact-details">+23 3000 000 00</p>
                    <nav class="footer-social-links">
                        <a href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a href="#!"><i class="fab fa-twitter"></i></a>
                        <a href="#!"><i class="fab fa-behance"></i></a>
                        <a href="#!"><i class="fab fa-dribbble"></i></a>
                    </nav>
                </div>
                <div class="col-md-3">
                    <nav class="footer-nav">
                        <a href="#!" class="nav-link">Company</a>
                        <a href="#!" class="nav-link">Android App</a>
                        <a href="#!" class="nav-link">ios App</a>
                        <a href="#!" class="nav-link">Blog</a>
                        <a href="#!" class="nav-link">Partners</a>
                        <a href="#!" class="nav-link">Careers</a>
                    </nav>
                </div>
                <div class="col-md-3">
                    <nav class="footer-nav">
                        <a href="#!" class="nav-link">FAQ</a>
                        <a href="#!" class="nav-link">Reporting</a>
                        <a href="#!" class="nav-link">Block Storage</a>
                        <a href="#!" class="nav-link">Tools & Integrations</a>
                        <a href="#!" class="nav-link">API</a>
                        <a href="#!" class="nav-link">Pricing</a>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="dropdown footer-country-dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="footerCountryDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="flag-icon flag-icon-gb flag-icon-squared"></span> United Kingdom <i
                            class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="footerCountryDropdown">
                            <button class="dropdown-item" href="#">
                                <span class="flag-icon flag-icon-us flag-icon-squared"></span> United States
                            </button>
                            <button class="dropdown-item" href="#">
                                <span class="flag-icon flag-icon-au flag-icon-squared"></span> Australia
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom-content">
                <nav class="nav footer-bottom-nav">
                    <a href="#!">Privacy & Policy</a>
                    <a href="#!">Terms</a>
                    <a href="#!">Site Map</a>
                </nav>
                <p class="mb-0">© Edica. 2020 <a href="https://www.bootstrapdash.com" target="_blank"
                                                 rel="noopener noreferrer" class="text-reset">bootstrapdash</a> . All
                    rights
                    reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script>
import api from "./api";

export default {
    name: 'app',

    data: () => ({
        accessToken: '',
        user: {},
    }),

    methods: {
        getAccessToken() {
            this.accessToken = localStorage.getItem('access_token')
            this.getUser()
        },
        getUser() {
            api.post('http://localhost:8876/api/auth/me')
                .then(res => {
                    this.user = res.data.user
                }).catch(error => {
                console.log(error);
            })
        },
        logout() {
            api.post('http://localhost:8876/api/auth/logout')
                .then(() => {
                    localStorage.removeItem('access_token')
                    document.cookie = "jwt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    this.$router.push({name: 'main.signin'})
                })
        },
    },
    computed: {},

    updated() {
        this.getAccessToken()
        if (localStorage.getItem('access_token')) {
            this.getUser()
        }
    }
}
</script>

<style>
@import url("../../public/assets/vendors/flag-icon-css/css/flag-icon.min.css");
@import url("../../public/assets/vendors/font-awesome/css/all.min.css");
@import url("../../public/assets/vendors/aos/aos.css");
@import url("../../public/assets/css/style.css");
@import url("./assets/reset.css");

.logout {
    cursor: pointer;
}
</style>
