<template>
    <div class="row mb-4 collapse show">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Создано</th>
                            <th>Обновлено</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ element.name }}</td>
                            <td>{{ timeStandard(element.created_at) }}</td>
                            <td>{{ timeStandard(element.updated_at) }}</td>
                            <td><a @click.prevent="goEdit" class="btn btn-primary">Изменить</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
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
    }),

    methods: {
        timeStandard (elem) {
            if (elem) {
                return elem.replace('T', ' ').split('.')[0]
            }
            return elem
        },
        getElement () {
            axios.post(`http://localhost:8876/api/admin/users/${this.id}`).
            then( res => {
                this.element = res.data.user
            })
        },
        goBack () {
            window.history.back()
        },
        destroyElement () {
            this.$refs.btn.disabled = true
            axios.delete(`http://localhost:8876/api/admin/users/${this.id}`)
                .then( res => {
                    console.log(res);
                    if (res.status === 200) {
                        alert(res.data.message)
                        window.location.href = 'http://localhost:8876/admin/users/'
                    }
                })
                .catch( error => {
                    console.log(error);
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
        goEdit () {
            window.location.href = `/admin/users/${this.id}/edit`
        }
    },

    mounted () {
        this.id = window.location.pathname.replace('/admin/users/', '')
        this.getElement()
    }
}
</script>

<style scoped>

</style>
