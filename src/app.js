import Vue from 'vue'
import App from './App.vue'
import { createRouter } from './router'
import { createStore } from './store'
import titleMixin from './util/title'
require('./util/fullpage')

const router = createRouter()
const store = createStore()

Vue.config.productionTip = false
Vue.mixin(titleMixin)

export function createApp () {
  const app = new Vue({
    router,
    store,
    render: h => h(App)
  })
  return { app, router, store }
}
