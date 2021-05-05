import { createRouter, createWebHistory } from 'vue-router'
import Game from '../views/Game.vue'
import Form from '../views/Form.vue'

const routes = [
  {
    path: '/',
    name: 'Game',
    component: Game
  },
  {
    path: '/form',
    name: 'Form',
    component: Form,
    props: true
  },
  { path: '/:pathMatch(.*)*',
    redirect: '/'
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
