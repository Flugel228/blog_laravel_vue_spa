<template>
  <div class="blog-post">
    <div class="container">
      <h1 class="edica-page-title aos-init aos-animate" data-aos="fade-up">{{ post.title }}</h1>
      <p class="edica-blog-post-meta aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">{{ post.date }} •
        {{ post.comments }} Comments</p>
      <section class="blog-post-featured-img aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
        <img :src="post.img" alt="featured image" class="w-100">
      </section>
      <section class="post-content" v-html="post.content"></section>
      <div class="row">
        <div class="col-lg-9 mx-auto">
          <section class="pt-4 d-flex justify-content-end">
            <p>{{ post.likes }} <i
                :class="{
                'pointer': true,
                'fa-heart': true,
                'fa': post.liked,
                'far': !post.liked,
                'transition': true
              }"
                @click.prevent="likePost($route.params.id)"
            /></p>
          </section>
          <section v-if="relatedPosts" class="related-posts">
            <h2 class="section-title mb-4 aos-init" data-aos="fade-up">Related Posts</h2>
            <div class="row">
              <div
                  class="col-md-4 aos-init"
                  data-aos="fade-right"
                  data-aos-delay="100"
                  v-for="post in relatedPosts"
              >
                <img :src="post.img" alt="related post"
                     class="post-thumbnail">
                <section class="row justify-content-between pl-3 pr-3">
                  <p class="post-category">{{ post.category }}</p>
                  <p>{{ post.likes }} <i
                      :class="{
                      'fa-heart': true,
                      'fa': post.liked,
                      'far': !post.liked,
                      'pointer': true
                      }"
                      @click.prevent="likePost(post.id)"
                  /></p>
                </section>
                <a @click="getPost(post.id)" class="blog-post-permalink"><h5
                    class="blog-post-title">{{ post.title }}</h5></a>
              </div>
            </div>
          </section>
          <form-component v-if="accessToken"></form-component>
          <div v-if="comments.length > 0" class="card-footer border shadow card-comments mb-5 p-4">
            <div
                class="card-comment aos-animate"
                v-for="(comment, id) in comments"
                data-aos="fade-up"
                data-aos-delay="200"
            >
              <div class="comment-text">
                    <span class="username row justify-content-between">
                      <div class="ml-3 row">
                      <p class="text-black-50">{{ comment.user.name }}</p>
                        <p class="ml-2">{{ comment.user.role === 0 ? 'Reader' : 'Admin' }}</p>
                      </div>
                      <span class="text-muted top float-right">{{ comment.date }}</span>
                    </span><!-- /.username -->
                {{ comment.comment }}
              </div>
              <!-- /.comment-text -->
              <hr v-if="id !== comments.length -1">
            </div>
          </div>
          <div class="row mb-4" v-if="pages.last_page > 1">
            <nav aria-label="Пример навигации по страницам">
              <ul class="pagination">
                <li :class="{
                        'page-item': true,
                        'disabled': pages.current_page === 1,
                        }">
                  <a
                      class="page-link"
                      aria-label="Предыдущая"
                      @click.prevent="getComments(pages.current_page - 1, this.$route.params.id)">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li v-for="link in pages.links"
                    :class="{
                            'page-item': true,
                            'active': link.active,
                            }">
                  <a
                      class="page-link"
                      href="#"
                      v-if="Number(link.label) &&
                                      (pages.current_page - parseInt(link.label) > -2 &&
                                      pages.current_page - parseInt(link.label) < 2) ||
                                      Number(link.label) === 1 ||
                                      Number(link.label) === pages.last_page
                                      "
                      @click.prevent="getComments(link.label, this.$route.params.id)"
                  >{{ link.label }}</a>
                  <a
                      class="page-link"
                      v-if="Number(link.label) &&
                                      pages.current_page !== pages.last_page -2 &&
                                      pages.current_page - parseInt(link.label) === -2 ||
                                      Number(link.label) &&
                                      pages.current_page !== 3 &&
                                      pages.current_page - parseInt(link.label) === 2
                                      "
                  >...</a>
                </li>
                <li :class="{
                        'page-item': true,
                        'disabled': pages.current_page === pages.last_page
                        }">
                  <a class="page-link"
                     aria-label="Следующая"
                     @click.prevent="getComments( pages.current_page + 1, this.$route.params.id)">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import FormComponent from "@/components/main/post/FormComponent.vue";
import api from "@/api";

export default {
  name: "ShowComponent",

  components: {
    FormComponent
  },

  data: () => ({
    post: {},
    relatedPosts: [],
    accessToken: '',
    comments: [],
    pages: {}
  }),

  mounted() {
    this.accessToken = localStorage.getItem('access_token')
    this.getPost(this.$route.params.id)
  },


  methods: {
    getPost(id) {
      api.post(`http://localhost:8876/api/posts/${id}`)
          .then(res => {
            this.post = res.data.post
            this.relatedPosts = res.data.relatedPosts
            this.getComments(1, id)
            window.history.pushState({}, '', `http://localhost:5173/posts/${id}`);
          })
    },
    getComments(page = 1, id) {
      axios.post(`http://localhost:8876/api/posts/${id}/comments`, {
        page: page
      }).then(res => {
        this.comments = res.data.data
        this.pages = res.data.meta
      })
    },
    likePost(id) {
      api.post(`http://127.0.0.1:8876/api/posts/${id}/likes/store`)
          .then(res => {
            if (res.status === 200) {
              this.getPost(this.$route.params.id)
            }
          }).catch(error => {
        if (error.response.status === 401) {
          alert('Unauthorized!')
        }
      })
    }
  }
}
</script>

<style scoped>
.pointer:hover {
  cursor: pointer;
}

.blog-post-permalink:hover {
  cursor: pointer;
}
</style>