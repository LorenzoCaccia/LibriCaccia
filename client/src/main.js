import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';

import BooksList from '@/components/BooksList.vue';
import BooksDetail from '@/components/BooksDetail.vue';
import BooksCreate from '@/components/BooksCreate.vue';

Vue.config.productionTip = false

Vue.use(VueRouter);

const routes = [
  {
    path: '/list',
    name: "books_list",
    component: BooksList,
  },
  {
    path: '/detail/:id',
    name: "books_detail",
    component: BooksDetail,
  },
  {
    path: '/create',
    name: "books_create",
    component: BooksCreate,
  },  
  {
    path: '',
    redirect: '/list',
  }
];


const router = new VueRouter({
  mode: "history",
  routes,
});

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
