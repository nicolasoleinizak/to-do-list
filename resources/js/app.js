import './bootstrap';
import * as VueRouter from 'vue-router';
import { createApp } from 'vue';
import Main from './views/Main.vue';
import Login from './views/Login.vue';
import Home from './views/Home.vue';
import Register from './views/Register.vue';
import colors from 'vuetify/lib/util/colors'
import 'vuetify/styles';
import '@mdi/font/css/materialdesignicons.css'
import { aliases, mdi } from 'vuetify/iconsets/mdi';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
  theme: {
    themes: {
      light: {
        dark: false,
        colors: {
          primary: colors.blue.base,
          secondary: colors.blue.darken2,
        }
      }
    }
  },
  components,
  directives,
})

const routes = [
  { 
    path: '/', 
    component: Home
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/register',
    component: Register
  }
];

const router = VueRouter.createRouter({
  history: VueRouter.createWebHashHistory(),
  routes,
})

const app = createApp({});

app.component('to-do-app', Main);

app.use(vuetify).use(router).mount("#app");