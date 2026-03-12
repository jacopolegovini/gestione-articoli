import './styles/app.css';
import './stimulus_bootstrap.js';
import { registerVueControllerComponents } from '@symfony/ux-vue';

/*
 * Registra tutti i componenti .vue che si trovano in assets/vue/controllers/
 * Questo permette a Symfony di usarli con la funzione vue_component()
 */
registerVueControllerComponents(import.meta.glob('./vue/controllers/**/*.vue'));

console.log('AssetMapper e Vue pronti');
