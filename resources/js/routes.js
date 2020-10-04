import Home from './components/Home';
import About from './components/About';
import Login from './components/Login';
import LoginLoading from './components/LoginLoading';
import Admin from './components/admin/Admin';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/about',
        name: 'about',
        component: About
    },
    {
        path: '/login',
        name: 'login',
        meta: {
            unauth: true
        },
        component: Login
    },
    {
        path: '/authorize/:provider/callback',
        name: 'login-loading',
        component: LoginLoading
    },
    {
        path: '/admin/:page',
        name: 'admin-pages',
        component: Admin,
        meta: {
            admin: true
        }
    },
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {
            admin: true
        }
    },
]

export default routes;