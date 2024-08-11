import { createApp } from "vue";
import App from './App.vue';
import router from './router';
import Cleave from 'vue-cleave-component';
import axios from 'axios';
import pagination from './components/pagination.vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

require('./bootstrap');

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(Cleave);
app.use(VueSweetalert2);
app.component('pagination',pagination);
app.mount("#app");