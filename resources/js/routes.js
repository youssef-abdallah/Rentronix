import Home from './components/Home';
import About from './components/About';
import Login from './components/Login';

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
        component: Login
    }
]

export default routes;