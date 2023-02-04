import './bootstrap';
import '../css/index.css';
import { FontAwesomeIcon } from './plugins/font-awesome.js';
import { createApp } from 'vue'
import App from './components/App.vue';
import axios from 'axios';
import router from './router';
import store from './store';



//Axios
axios.defaults.baseURL = 'http://localhost:8000/api/';
axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;


createApp(App)
    .use(router)
    .use(store)
    .component("font-awesome-icon", FontAwesomeIcon)
    .mount('#app')
