import {createWebHistory, createRouter} from "vue-router";

const routes = [
    {
        path: "/",
        alias: "/fruits",
        name: "fruits",
        component: () => import("./components/Fruits")
    },
    {
        path: "/",
        alias: "/fruits/favorite",
        name: "favoriteFruits",
        component: () => import("./components/FavoriteFruits")
    },
    {
        path: "/fruits/:id",
        name: "fruit-details",
        component: () => import("./components/Fruit")
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;