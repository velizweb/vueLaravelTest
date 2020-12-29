import Vue from "vue";
import VueRouter from "vue-router";
import Login from "./view/Login";
import Users from "./view/Users";
import Items from "./view/Items";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Login",
        component: Login
    },
    {
        path: "/users",
        name: "Users",
        component: Users
    },
    {
        path: "/items",
        name: "Items",
        component: Items
    }
];

const router = new VueRouter({
    routes
});

export default router;
