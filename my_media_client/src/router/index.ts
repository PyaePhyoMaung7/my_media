import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'homePage',
      alias: '/home',
      component: ()=> import('../views/HomePage.vue')
    },
    {
      path: '/newsDetails',
      name:'newsDetails',
      component: ()=> import('../views/NewsDetails.vue')
    },
    {
      path: '/login',
      name:'login',
      component: ()=> import('../views/LoginPage.vue')
    }
  ]
})

export default router
