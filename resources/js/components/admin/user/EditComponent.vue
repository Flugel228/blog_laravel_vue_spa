<template>
    <div class="row mb-2">
        <form class="ml-3" id="form">
            <div class="form-group">
                <label for="name">Имя пользователя</label>
                <input v-model="name" type="text" class="form-control" id="name" name="name"
                       placeholder="Введите имя">
                <p class="text-error">{{ errors.name }}</p>
            </div>
            <div class="form-group">
                <label for="email">Email пользователя</label>
                <input v-model="email" type="email" class="form-control" id="email" name="email"
                       placeholder="Введите email">
                <p class="text-error">{{ errors.email }}</p>
            </div>
            <div class="form-group">
                <label for="role">Роль пользователя</label>
                <select v-model="role" class="form-control" name="role" id="role">
                    <option v-for="(role, id) in JSON.parse(roles)" :value="id">{{role}}</option>
                </select>
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

    props: [
        'roles'
    ],

    data: () => ({
        name: '',
        email: '',
        role: '',
        errors: {
            name: '',
            email: '',
        }
    }),
    methods: {
        getElement() {
            axios.post(`http://localhost:8876/api/admin/users/${this.id}`)
                .then(res => {
                    this.element = res.data.user
                    this.name = this.element.name
                    this.email = this.element.email
                    this.role = this.element.role
                })
        },

        update() {
            this.test()
            if (this.$refs.btn.disabled){
                axios.patch(`http://localhost:8876/api/admin/users/${this.id}`, {
                    name: this.name,
                    email: this.email,
                    role: this.role
                }).then( res => {
                    if (res.status === 200) {
                        alert(res.data.message)
                        window.location.href = '/admin/users';
                    }
                }).catch( error => {
                    if (error.response.status === 409) {
                        alert(error.response.data.error)
                    } else if (error.response.status === 500) {
                        alert(error.response.data.error)
                    }
                }).finally(() => {
                    this.$refs.btn.disabled = false
                })
            }
        },

        test() {
            for (let error in this.errors){
                this.errors.error = ''
            }
            this.$refs.btn.disabled = true
            if (!/^[A-ZА-ЯЁa-zё\d\s]{0,254}$/.test(this.name)) {
                this.errors.name = 'The name must contain only numbers, Latin and Cyrillic characters.'
                this.$refs.btn.disabled = false
            }
            if (!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email)) {
                this.errors.email = 'The form email must be in the form example@example.domain'
                this.$refs.btn.disabled = false
            }
        },

        goBack() {
            window.history.back()
        },
    },
    mounted() {
        this.id = window.location.pathname.replace('/admin/users/', '').replace('/edit', '')
        this.getElement()
    }
}
</script>

<style scoped>

</style>
