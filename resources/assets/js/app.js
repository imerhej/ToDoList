/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Toasted from "vue-toasted";
Vue.use(Toasted);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import TodoComponent from "./components/TodoComponent.vue";
import Create from "./components/Create.vue";
import Edit from "./components/Edit.vue";
import Show from "./components/Show.vue";
import EditSubTask from "./components/EditSubTask.vue";

const routes = [
    {
        path: "/",
        components: {
            todocomponent: TodoComponent
        }
    },
    { path: "/create", component: Create, name: "create" },
    { path: "/edit/:id", component: Edit, name: "edit" },
    { path: "/show/:id", component: Show, name: "show" },
    { path: "/editsubtask/:id", component: EditSubTask, name: "editsubtask" }
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: "#app",
    router
});
