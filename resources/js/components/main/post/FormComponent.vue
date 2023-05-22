<template>
  <section class="comment-section">
    <h2 class="section-title mb-5 aos-init" data-aos="fade-up">Leave a Reply</h2>
    <form>
      <div class="row">
        <div class="form-group col-12 aos-init" data-aos="fade-up">
          <label for="comment" class="sr-only">Comment</label>
          <textarea
              name="comment"
              id="comment"
              class="form-control"
              placeholder="Comment"
              rows="10"
              v-model="comment"
          >Comment</textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-12 aos-init" data-aos="fade-up">
          <input @click.prevent="send" type="submit" value="Send Message" class="btn btn-warning">
        </div>
      </div>
    </form>
  </section>
</template>

<script>
import api from "@/api";

export default {
  name: "FormComponent",

  data: () => ({
    comment: ''
  }),

  methods: {
    send() {
      api.post(`http://localhost:8876/api/posts/${this.$route.params.id}/comments/store`,
          {
            comment: this.comment,
          }).then(res => {
        if (res.status === 200) {
          this.$parent.getComments(this.$parent.pages.current_page, this.$route.params.id)
          this.comment = ''
        }
      }).catch(error => {
          alert('Ops... Something was wrong!')
      })
    }
  },
}
</script>

<style scoped>

</style>