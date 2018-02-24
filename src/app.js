import Vue from 'vue'
import App from './App.vue'
import { createRouter } from './router'
import { createStore } from './store'
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
import titleMixin from './util/title'
import ElementUI from 'element-ui'
// import { sync } from 'vuex-router-sync'

const router = createRouter()
const store = createStore()

Vue.config.productionTip = false
Vue.mixin(titleMixin)
Vue.use(MintUI)
Vue.use(ElementUI)

export function createApp () {
  const app = new Vue({
    router,
    store,
    render: h => h(App)
  })
  return { app, router, store }
}
