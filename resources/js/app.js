/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import $ from 'jquery/dist/jquery.slim';
import * as dt from 'datatables.net';
import * as dt_bs from 'datatables.net-bs';


require('./bootstrap');
window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import 'jquery-ui/ui/widgets/autocomplete.js';
import 'jquery-ui/ui/widgets/menu.js';
import 'jquery-ui/ui/widgets/selectmenu.js';
import 'jquery-ui/ui/widgets/button.js';

import 'jquery-ui/themes/base/all.css';
import 'jquery-ui/themes/base/autocomplete.css';
import 'jquery-ui/themes/base/menu.css';
import 'jquery-ui/themes/base/selectmenu.css';
import 'jquery-ui/themes/base/button.css';




Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});