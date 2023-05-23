<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-11 mx-auto">
          <h1 class="edica-page-title" data-aos="fade-up">My Profile</h1>
        </div>

      </div>

      <section data-aos="fade-up" class="edica-contact py-5 mb-5">
        <div class="row">
          <div class="col-6">
            <div class="-group mb-3">
              <div class="row">
                <div class="col-md-8 ml-4">
                  <h2>Name</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ml-5">
                  <h5> {{ user.name }}</h5>
                </div>
              </div>
            </div>
            <div class="-group mb-5">
              <div class="row">
                <div class="col-md-8 ml-4">
                  <h2>Email</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ml-5">
                  <h5> {{ user.email }}</h5>
                </div>
              </div>
            </div>
            <div class="-group mt-5">
              <div class="row">
                <div class="col-md-8 ml-4">
                  <h2>Role</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ml-5">
                  <h5> {{ user.role === 1 ? 'Reader' : 'Admin' }}</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="-group mb-3">
              <div class="row">
                <div class="col-md-8 ml-4">
                  <h2>Date of registration</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ml-5">
                  <h5> {{ timeStandard(user.created_at) }}</h5>
                </div>
              </div>
            </div>
            <div class="-group mb-2">
              <div class="row">
                <div class="col-md-8 ml-4">
                  <h2>Likes</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ml-5">
                  <h5>Amount: {{ likes }}</h5>
                </div>
              </div>
              <div class="row ml-0">
                <div class="col-md-8 ml-3">
                  <router-link :to="{ name: 'main.user.likes.index'}" class="nav-link small-box-footer">More <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
              </div>
            </div>
            <div class="-group mb-3">
              <div class="row">
                <div class="col-md-8 ml-4">
                  <h2>Comments</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 ml-5">
                  <h5>Amount: {{ comments }}</h5>
                </div>
              </div>
              <div class="row ml-0">
                <div class="col-md-8 ml-3">
                  <router-link :to="{ name: 'main.user.comments.index' }" class="nav-link small-box-footer">More <i class="fas fa-arrow-circle-right"></i></router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<script>
import api from "@/api";

export default {
  name: "UserComponent",

  data: () => ({
    user: {},
    roles: [],
    likes: null,
    comments: null
  }),

  methods: {
    getUser() {
      api.post('http://127.0.0.1:8876/api/auth/me')
          .then(res => {
            this.user = res.data.user
            this.roles = res.data.roles
            this.likes = res.data.likes
            this.comments = res.data.comments
          })
    },
    timeStandard (time){
      if (time) {
        return time.split('T')[0]
      }
      return time
    },
  },


  mounted() {
    this.getUser()
  }
}
</script>

<style scoped>

</style>
