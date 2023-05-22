import './bootstrap';
import {createApp} from 'vue';

// Import Tag
import TagIndexComponent from "./components/admin/tag/IndexComponent.vue";
import TagShowComponent from "./components/admin/tag/ShowComponent.vue";
import TagCreateComponent from "./components/admin/tag/CreateComponent.vue";
import TagEditComponent from "./components/admin/tag/EditComponent.vue";

// Import Category
import CategoryIndexComponent from "./components/admin/category/IndexComponent.vue";
import CategoryShowComponent from "./components/admin/category/ShowComponent.vue";
import CategoryCreateComponent from "./components/admin/category/CreateComponent.vue";
import CategoryEditComponent from "./components/admin/category/EditComponent.vue";

// Import Post
import PostIndexComponent from "./components/admin/post/IndexComponent.vue";
import PostShowComponent from "./components/admin/post/ShowComponent.vue";

// Import User
import UserIndexComponent from "./components/admin/user/IndexComponent.vue";
import UserShowComponent from "./components/admin/user/ShowComponent.vue";
import UserCreateComponent from "./components/admin/user/CreateComponent.vue";
import UserEditComponent from "./components/admin/user/EditComponent.vue";

const app = createApp({});


// Tag Components
app.component('tag-index-component', TagIndexComponent)
app.component('tag-show-component', TagShowComponent)
app.component('tag-create-component', TagCreateComponent)
app.component('tag-edit-component', TagEditComponent)

// Category Components
app.component('category-index-component', CategoryIndexComponent)
app.component('category-show-component', CategoryShowComponent)
app.component('category-create-component', CategoryCreateComponent)
app.component('category-edit-component', CategoryEditComponent)

// Post Components
app.component('post-index-component', PostIndexComponent)
app.component('post-show-component', PostShowComponent)

// User Components
app.component('user-index-component', UserIndexComponent)
app.component('user-show-component', UserShowComponent)
app.component('user-create-component', UserCreateComponent)
app.component('user-edit-component', UserEditComponent)


app.mount('#app');
