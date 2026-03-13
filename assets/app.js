import { createApp } from 'vue';
import Test from './Test.vue';
import './styles/app.css';

const appElement = document.getElementById('app-test');
if (appElement) {
    createApp(Test).mount('#app-test');
}
