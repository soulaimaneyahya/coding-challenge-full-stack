import { createRouter, createWebHistory } from 'vue-router'

import HomePage from '@/views/home.vue'

import productIndex from '@/views/products/index.vue'
import productCreate from '@/views/products/create.vue'

import categoryIndex from '@/views/categories/index.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: HomePage,
      name: 'home',
    },
    // products
    {
      path: '/products',
      component: productIndex,
      name: 'products.index',
    },
    {
      path: '/products/create',
      component: productCreate,
      name: 'products.create',
    },
    // categories
    {
      path: '/categories',
      component: categoryIndex,
      name: 'categories.index',
    },
  ],
})

export default router
