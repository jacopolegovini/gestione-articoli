import { createApp } from 'vue';
import Test from './Test.vue';
import AuthorsList from './vue/AuthorsList.vue';
import './styles/app.css';

const appElement = document.getElementById('app-test');
if (appElement) {
    createApp(Test).mount('#app-test');
}

if (document.getElementById('app-authors')) {
    createApp(AuthorsList).mount('#app-authors');
}
