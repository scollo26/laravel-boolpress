/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

//import pages
import App from "./views/App";
import Home from "./pages/Home";
import About from "./pages/About";
import Products from "./pages/Products";
import Product from "./pages/Product";
import Contacts from "./pages/Contacts";

import VueRouter from "vue-router";
import Vue from "vue";
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/products",
            name: "products",
            component: Products,
        },
        {
            path: "/products/:id",
            name: "product",
            props: true,
            component: Product,
        },
        {
            path: "/about",
            name: "about",
            component: About,
        },
        {
            path: "/contacts",
            name: "contacts",
            component: Contacts,
        },
    ],
});

const app = new Vue({
    el: "#app",
    render: (h) => h(App),
    router,
});
