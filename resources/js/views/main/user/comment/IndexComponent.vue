<template>
  <div class="container">
    <h1 class="edica-page-title aos-init aos-animate" data-aos="fade-up">Comments</h1>
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
        <div class="row my-3 ml-0">
          <router-link :to="{
            name: 'main.posts.show',
            params: {
              id: comment.post_id
            }
          }" class="blog-post-permalink">See more</router-link>
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
                @click.prevent="getComments(pages.current_page - 1)">
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
                @click.prevent="getComments(link.label)"
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
               @click.prevent="getComments( pages.current_page + 1)">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import api from "@/api";

export default {
  name: "LikesComponent",

  data: () => ({
    comments: [],
    pages: {}
  }),

  mounted() {
    this.getComments()
  },

  methods: {
    getComments(page = 1) {
      api.post(`http://localhost:8876/api/auth/comments`, {
        page: page
      }).then(res => {
        console.log(res);
        this.comments = res.data.data
        this.pages = res.data.meta
      })
    },
  },
}
</script>

<style scoped>

</style>