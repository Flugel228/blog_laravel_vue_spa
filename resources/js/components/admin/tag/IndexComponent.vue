<template>
    <div class="col ml-4">
        <div class="row mb-4">
            <a @click.prevent="create" class="btn btn-block btn-primary col-sm-2">Создать</a>
        </div>
        <div class="row mb-4 collapse show">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица тегов</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text"
                                       name="table_search"
                                       class="form-control float-right"
                                       placeholder="Поиск"
                                       v-model="query"
                                       @keypress.enter="pagination(pages.current_page, query)"
                                >

                                <div class="input-group-append">
                                    <button
                                        type="submit"
                                        class="btn btn-default"
                                        @click="pagination(pages.current_page, query)"
                                    >
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Тег</th>
                                <th>Создано</th>
                                <th>Обновлено</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="element in elements">
                                <td>{{ element.id }}</td>
                                <td>{{ element.title }}</td>
                                <td>{{ timeStandard(element.created_at) }}</td>
                                <td>{{ timeStandard(element.updated_at) }}</td>
                                <td><a @click="show(element.id)" class="btn btn-primary">Посмотреть</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>

                <!-- /.card -->
            </div>
        </div>
        <div class="row mb-4" v-if="pages.last_page > 1">
            <nav aria-label="Пример навигации по страницам">
                <ul class="pagination">
                    <li :class="{
                        'page-item': true,
                        'disabled': pages.current_page === 1}">
                        <a
                            class="page-link"
                            aria-label="Предыдущая"
                            @click.prevent="pagination(pages.current_page - 1)">
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
                            @click.prevent="pagination(link.label)"
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
                           @click.prevent="pagination( pages.current_page + 1)">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "IndexComponent",

    data: () => ({
        elements: [],
        pages: {},
        query: ''
    }),
    mounted() {
        this.pagination()
    },
    methods: {
        timeStandard (elem){
            if (elem) {
                return elem.replace('T', ' ').split('.')[0]
            }
            return elem
        },
        pagination (page = 1) {
            axios.post('http://localhost:8876/api/admin/tags', {
                'like': this.query,
                'page': page
            }).
            then( res => {
                this.elements = res.data.data
                this.pages = res.data.meta
            })
        },
        show (id) {
            window.location.href = `http://localhost:8876/admin/tags/${id}`
        },
        create () {
            window.location.href = 'http://localhost:8876/admin/tags/create'
        }

    },
}
</script>

<style scoped>

</style>
