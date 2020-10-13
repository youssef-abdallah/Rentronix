import Home from './components/Home';
import About from './components/About';
import Login from './components/Login';
import Admin from './components/admin/Admin';
import Search from './components/Search';
import AdvertisementsUploader from './components/admin/AdvertisementUploader'
import Cart from './components/Cart';
import Checkout from './components/Checkout';
import Orders from './components/User/Orders';
import Requests from './components/User/Requests';
import Request from './components/User/Request'
import Complaint from './components/User/Complaint';
import Complaints from './components/User/Complaints';

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
    },
    {
        path: '/requests',
        name: 'requests',
        component: Requests,
        meta: {
            auth: true,
        }
    },
    {
        path: '/complaint',
        name: 'complaint',
        component: Complaint,
        meta: {
            auth: true,
        }
    },
    {
        path: '/complaints',
        name: 'complaints',
        component: Complaints,
        meta: {
            auth: true,
        }
    }
]

export default routes;