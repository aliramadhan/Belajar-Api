import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Demo from '../pages/Demo';

//import compoinent book
import Books from '../components/Books/Index';
import AddBook from '../components/Books/Create';
import EditBook from '../components/Books/Edit';

//import compoinent design
import IndexDesign from '../components/DesignDemo/Index';
import CreateDesign from '../components/DesignDemo/Create';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'demo',
        path: '/demo/:name',
        component: Demo
    },
    //Route Books
    {
        name: 'books',
        path: '/books',
        component: Books,
        props: true
    },
    {
        name: 'addbook',
        path: '/books/add',
        component: AddBook
    },
    {
        name: 'editbook',
        path: '/books/edit/:id',
        component: EditBook
    },
    //Route DesignDemo
    {
        name: 'indexDesign',
        path: '/template',
        component: IndexDesign,
    },
    {
        name: 'CreateDesign',
        path: '/template/create',
        component: CreateDesign,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;