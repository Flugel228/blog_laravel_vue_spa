<template>
    <div class="row mb-4 collapse show">
        <div class="col-12">
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <div class="p-0">
                        <div class="row justify-content-center ml-5 mt-5">
                            <img class="w-50" :src="image.url" alt="">
                        </div>
                    </div>
                    <hr class="mt-5">
                    <div>
                        <div class="p-0">
                            <div class="row justify-content-center mt-5"><h1 class="text-bold">{{ element.title }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                    <div class="card">
                        <div
                            class="content mt-3 ml-5"
                            v-html="element.content"
                        ></div>
                        <div class="category mt-3 ml-5">
                            <p class="text-bold">Category: <strong class="text-blue">{{category.title}}</strong></p>
                        </div>
                        <div class="tags ml-5">
                            <p class="text-bold">Tags:
                                <strong
                                    class="text-blue"
                                    v-for="tag in tags"
                                > {{ tag.title + ' ' }}</strong>
                            </p>
                        </div>
                    </div>
                    <a @click.prevent="goEdit" class="btn btn-primary">Изменить</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row ml-2">
        <a @click="goBack" class="btn btn-secondary">Назад</a>
        <a @click="destroyElement"
           ref="btn"
           class="btn btn-danger ml-2"
        >Удалить</a>
    </div>

</template>

<script>
export default {
    name: "ShowComponent",

    data: () => ({
        element: {},
        id: '',
        image: {},
        category: {},
        tags: []
    }),

    methods: {
        timeStandard(elem) {
            if (elem) {
                return elem.replace('T', ' ').split('.')[0]
            }
            return elem
        },
        getElement() {
            axios.post(`http://localhost:8876/api/admin/posts/${this.id}`).then(res => {
                this.element = res.data.post
                this.image = res.data.image
                this.category = res.data.category
                this.tags = res.data.tags
            })
        },
        goBack() {
            window.history.back()
        },
        destroyElement() {
            this.$refs.btn.disabled = true
            axios.delete(`http://localhost:8876/api/admin/posts/${this.id}`)
                .then(res => {
                    if (res.status === 200) {
                        alert(res.data.message)
                        window.location.href = 'http://localhost:8876/admin/posts/'
                    }
                })
                .catch(error => {
                    if (error.response.status === 404) {
                        alert(error.response.data.error)
                    } else if (error.response.status === 500) {
                        alert(error.response.data.error)
                    }
                })
                .finally(() => {
                    this.$refs.btn.disabled = false
                })
        },
        goEdit() {
            window.location.href = `/admin/posts/${this.id}/edit`
        }
    },

    mounted() {
        this.id = window.location.pathname.replace('/admin/posts/', '')
        this.getElement()
    }
}
</script>

<style scoped>

</style>
