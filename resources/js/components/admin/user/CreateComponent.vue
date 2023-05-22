<template>
    <div class="row mb-2">
        <form class="ml-3 w-25" id="form">
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
                <label for="password">Пароль пользователя</label>
                <input v-model="password" type="password" class="form-control" id="password" name="password"
                       placeholder="Введите пароль">
                <p class="text-error">{{ errors.password }}</p>
            </div>
            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль</label>
                <input v-model="confirm_password" type="password" class="form-control" id="confirm_password" name="confirm_password"
                       placeholder="Подтвердите пароль">
                <p class="text-error">{{ errors.confirm_password }}</p>
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

    props: [
      'roles'
    ],

    data: () => ({
        name: '',
        email: '',
        password: '',
        confirm_password: '',
        role: 0,
        errors: {
            name: '',
            email: '',
            password: '',
            confirm_password: ''
        }
    }),

    methods: {
        sending() {
            this.test()
            if (this.$refs.btn.disabled) {
                axios.post('http://localhost:8876/api/admin/users/store', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.confirm_password,
                    role: this.role
                }).then(res => {
                    if (res.status === 200) {
                        alert(res.data.message)
                        window.location.href = '/admin/users'
                    }
                }).catch(error => {
                    if (error.response.status === 409) {
                        alert(error.response.data.error)
                    } else if (error.response.status === 422) {
                        this.errors.email = error.response.data.message
                    } else if (error.response.status === 500) {
                        alert(error.response.data.error)
                    }
                }).finally(() => {
                    this.$refs.btn.disabled = false;
                })
            }
        },

        goBack() {
            window.history.back()
        },

        test() {
            for ( let error in this.errors){
                this.errors[error] = ''
            }
            this.$refs.btn.disabled = true
            if (!/^[A-ZА-ЯЁa-zё\d\s]{1,254}$/.test(this.name)) {
                this.errors.name = 'The name must contain only numbers, Latin and Cyrillic characters.'
                this.$refs.btn.disabled = false
            }
            if (!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email)) {
                this.errors.email = 'The form email must be in the form example@example.domain'
                this.$refs.btn.disabled = false
            }
            if (!/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/.test(this.password)) {
                this.errors.password = 'The password must contain from 6 to 20 elements, and also: contains uppercase and lowercase Latin letters and numbers.'
                this.$refs.btn.disabled = false
            }
            if (this.password !== this.confirm_password) {
                this.errors.confirm_password = 'Passwords must match.'
                this.$refs.btn.disabled = false
            }
        }
    },

    mounted() {
    }
}
</script>

<style scoped>

</style>
