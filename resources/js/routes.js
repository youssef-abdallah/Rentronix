import Home from './components/Home';
import About from './components/About';
import Login from './components/Login';
import LoginLoading from './components/LoginLoading';
import Admin from './components/admin/Admin';
import Search from './components/Search';
import AdvertisementsUploader from './components/admin/AdvertisementUploader'

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
        path: '/search',
        name: 'search',
        component: Search,
        meta: {

        }
    },
]

export default routes;