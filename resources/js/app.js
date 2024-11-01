

import './bootstrap';
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'

import { createApp } from 'vue';

const app = createApp({});

import MainPage from './components/MainPage.vue';

import router from './router/router'

app.component('main-page', MainPage)
app.use(router);
app.use(ViewUIPlus)

app.mount('#app');
