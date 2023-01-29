import './bootstrap';
import '../css/index.css';
import { FontAwesomeIcon } from './plugins/font-awesome.js';
import { createApp } from 'vue'
import App from './components/App.vue';
import axios from 'axios';
import router from './router';
import store from './store';
// import 'vuetify/styles'
// import { createVuetify } from 'vuetify'
// import * as components from 'vuetify/components'
// import * as directives from 'vuetify/directives'

//Axios
axios.defaults.baseURL = 'http://localhost:8000/api/';
axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

// Vuetify
// const vuetify = createVuetify({
//     components,
//     directives,
// })

createApp(App)
    .use(router)
    .use(store)
    .component("font-awesome-icon", FontAwesomeIcon)
    .mount('#app')
