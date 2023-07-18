import './bootstrap'
import { createApp } from 'vue'
import HelloWorld from '@/components/HelloWorld.vue'

const app = createApp({});

app.component('to-do-app', HelloWorld);

app.mount("#app");