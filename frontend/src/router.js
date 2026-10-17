import { createRouter, createWebHistory } from 'vue-router'
import LoginPage from './views/LoginPage.vue'
import BooksPage from './views/BooksPage.vue'

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: LoginPage,
  },
  {
    path: '/',
    name: 'Books',
    component: BooksPage,
    meta: { requiresAuth: true },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Navigation guard: redirect to login if not authenticated
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  if (to.meta.requiresAuth && !token) {
    next('/login')
  } else if (to.path === '/login' && token) {
    next('/')
  } else {
    next()
  }
})

export default router
