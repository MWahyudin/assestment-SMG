import { createApp } from 'vue';

import routes from './routes.js';


// Vue.component('v-select', vSelect)

import App from './App.vue';

const app = createApp(App);

app.use(routes);

app.mount('#app');
