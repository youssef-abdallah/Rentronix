import Home from './components/Home';
import About from './components/About';
import Login from './components/Login';
import LoginLoading from './components/LoginLoading';
import Admin from './components/admin/Admin';
import Search from './components/Search';
import AdvertisementsUploader from './components/admin/AdvertisementUploader'
import Request from './components/Request'
import Cart from './components/Cart';
import Checkout from './components/Checkout';
import Orders from './components/User/Orders';

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
        path: '/admin/advertisements/upload',
        name: 'advertisement-upload',
        component: AdvertisementsUploader,
        meta: {
            auth: true,
            admin: true
        }
    },
    {
        path: '/admin/:page',
        name: 'admin-pages',
        component: Admin,
        meta: {
            auth: true,
            admin: true
        }
    },
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {
            auth: true,
            admin: true
        }
    },
    {
        path: '/request',
        name: 'request',
        component: Request,
        meta: {
            auth: true,
        }
    },
    {
        path: '/search',
        name: 'search',
        component: Search,
        meta: {

        }
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart,
        meta: {
            auth: true,
        }
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        meta: {
            auth: true,
        }
    },
    {
        path: '/orders',
        name: 'orders',
        component: Orders,
        meta: {
            auth: true,
        }
    }
]

export default routes;