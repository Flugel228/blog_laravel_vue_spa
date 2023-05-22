<template>
    <div class="row mb-2">
        <form class="ml-3" id="form">
            <div class="form-group">
                <label for="title">Название Категории</label>
                <input type="text"
                       class="form-control tag _req"
                       id="title"
                       name="title"
                       placeholder="Введите категорию"
                       v-model="title"

                >
                <p class="text-error">{{ titleError }}</p>
            </div>
            <div class="row ml-0">
                <div class="form-group">
                    <a @click="goBack" class="btn btn-secondary">Назад</a>
                    <button type="submit"
                            class="btn btn-primary ml-2"
                            id="button"
                            @click.prevent="update"
                            ref="btn"
                    >Изменить
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "EditComponent",

    data: () => ({
        element: {},
        id: '',
        title: '',
        titleError: ''
    }),
    methods: {
        getElement() {
            axios.post(`http://localhost:8876/api/admin/categories/${this.id}`)
                .then(res => {
                    this.element = res.data
                    this.title = this.element.title
                })
        },

        update() {
            this.titleError = ''
            this.$refs.btn.disabled = true
            if (this.titleTest(this.title)){
                axios.put(`http://localhost:8876/api/admin/categories/${this.id}`, {
                    'title': this.title
                }).then( res => {
                    console.log(res);
                    if (res.status === 200) {
                        alert(res.data.message)
                        window.location.href = '/admin/categories';
                    }
                }).catch( error => {
                    console.log(error);
                    if (error.response.status === 409) {
                        alert(error.response.data.error)
                    } else if (error.response.status === 500) {
                        alert(error.response.data.error)
                    }
                }).finally(() => {
                    this.$refs.btn.disabled = false
                })

            } else {
                this.titleError = 'The title must contain only Latin and Cyrillic characters.'
                this.$refs.btn.disabled = false
            }
        },

        titleTest(input) {
            return /^[A-ZА-ЯЁa-zё\s]{0,254}$/.test(input);
        },

        goBack() {
            window.history.back()
        },
    },
    mounted() {
        this.id = window.location.pathname.replace('/admin/categories/', '').replace('/edit', '')
        this.getElement()
    }
}
</script>

<style scoped>

</style>
