<template>
  <main class="blog">
    <div class="container">
      <h1 class="edica-page-title" data-aos="fade-up">Blog</h1>
      <div>
        <div class="col-sm-6 justify-content-start">
          <!-- select -->
          <div class="form-group">
            <label>Categories</label>
            <select v-model="category" class="form-control h-25 w-50">
              <option ref="opt" value="">-</option>
              <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
          </div>
        </div>
        <div class="col-sm-6 mb-4">
          <button class="btn btn-primary w-25" @click.prevent="get(1, category)">Найти</button>
        </div>
      </div>
      <section class="featured-posts-section">
        <div class="row">
          <div
              class="col-md-4 fetured-post blog-post"
              data-aos="fade-right"
              v-for="post in posts"
          >
            <div class="blog-post-thumbnail-wrapper">
              <img :src="post.img" alt="blog post">
            </div>
            <div class="row justify-content-between px-3">
              <p class="blog-post-category">{{ post.category }}</p>
              <p>{{ post.likes }} <i
                  :class="{
                'fa-heart': true,
                'fa': post.liked,
                'far': !post.liked,
                'pointer': true
              }"
                  @click.prevent="likePost(post.id)"
              /></p>
            </div>
            <div class="row justify-content-start px-3">
              <p>{{ post.date }}</p>
            </div>
            <router-link :to="{ name: 'main.posts.show', params: { id: post.id}}" class="blog-post-permalink">
              <h6 class="blog-post-title">{{ post.title }}</h6>
            </router-link>
          </div>
        </div>
      </section>
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
                  @click.prevent="get(pages.current_page - 1, category)">
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
                  @click.prevent="get(link.label, category)"
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
                 @click.prevent="get( pages.current_page + 1, category)">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </div>

  </main>
</template>

<script>
import api from "@/api";

export default {
  name: "BlogComponent",

  data: () => ({
    posts: [],
    pages: {},
    categories: [],
    category: ''
  }),

  mounted() {
    this.get()
    this.getCategories()
  },

  methods: {
    get(page = 1, category = null) {
      api.post('http://127.0.0.1:8876/api/posts', {
        page: page,
        category_id: category
      }).then(res => {
        this.posts = res.data.data
        this.pages = res.data.meta
      })
    },
    likePost(id) {
      api.post(`http://127.0.0.1:8876/api/posts/${id}/likes/store`)
          .then(res => {
            if (res.status === 200) {
              this.get(this.pages.current_page)
            }
          }).catch(error => {
        if (error.response.status === 401) {
          alert('Unauthorized')
        }
      })
    },
    getCategories() {
      api.post(`http://127.0.0.1:8876/api/posts/categories`)
          .then(res => {
            this.categories = res.data.categories
          })
    }
  },
}
</script>

<style scoped>
.pointer:hover {
  cursor: pointer;
}

</style>
