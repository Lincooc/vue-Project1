import '@/css/base.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router/router'
// import 'bootstrap'
import '@/js/jquery.min.js'
import '@/js/bootstrap.bundle.min.js'
import '@/js/bootstrap.min.js'

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
