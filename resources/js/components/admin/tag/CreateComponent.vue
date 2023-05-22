<template>
    <div class="row mb-2">
        <form class="ml-3" id="form">
            <div class="form-group">
                <label for="title">Название Тега</label>
                <input v-model="title" type="text" class="form-control" id="title" name="title"
                       placeholder="Введите категорию">
                <p class="text-error">{{ titleError }}</p>
            </div>
            <div class="row ml-0">
                <div class="form-group">
                    <a @click="goBack" class="btn btn-secondary">Назад</a>

                    <button ref="btn" type="submit" class="btn btn-primary ml-2" id="button"
                            @click.prevent="sending"
                    >Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "CreateComponent",

    data: () => ({
        title: '',
        titleError: ''
    }),

    methods: {
        sending() {
            this.titleError = ''
            this.$refs.btn.disabled = true
            if (this.titleTest(this.title)) {
                axios.post('http://localhost:8876/api/admin/tags/store', {
                    title: this.title
                }).then( res => {
                    if (res.status === 200) {
                        alert(res.data.message)
                        window.location.href = '/admin/tags'
                    }
                }).catch( error => {
                    if (error.response.status === 409) {
                        alert(error.response.data.error)
                    } else if (error.response.status === 500) {
                        alert(error.response.data.error)
                    }
                }).finally( () => {
                    this.$refs.btn.disabled = false;
                })
            } else {
                this.titleError = 'The name must contain only: numbers, punctuation marks, Latin and Cyrillic characters.'
                this.$refs.btn.disabled = false
            }
        },

        goBack() {
            window.history.back()
        },

        titleTest(input) {
            return /^[A-ZА-ЯЁa-zё\s]{0,254}$/.test(input);
        }
    },

    mounted() {
    }
}
</script>

<style scoped>

</style>
