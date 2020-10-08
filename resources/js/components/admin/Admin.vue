<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Admin Dashboard</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div>
                        <ul style="list-style-type:none">
                            <li style="float:left;" class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                            <li style="float:left;"><button class="btn" @click="setComponent('requests')">Requests</button></li>
                            <li style="float:left;"><button class="btn" @click="setComponent('users')">Users</button></li>
                            <li style="float:left;"><button class="btn" @click="setComponent('products')">Products</button></li>
                            <li style="float:left;"><button class="btn" @click="setComponent('orders')">Orders</button></li>
                            <li style="float:left;"><button class="btn" @click="setComponent('complaints')">Complaints</button></li>
                            <li style="float:left;"><button class="btn" @click="setComponent('advertisements')">Advertisements</button></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <component :is="activeComponent"></component>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Main from './Main'
    import Requests from './Requests'
    import Users from './Users'
    import Products from './Products'
    import Orders from './Orders'
    import Complaints from './Complaints'
    import Advertisements from './Advertisements'

    export default {
        data() {
            return {
                activeComponent: null
            }
        },
        components: {
            Main, Requests, Users, Products, Orders, Complaints,
            Advertisements
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            axios.defaults.headers.common['Content-Type'] = 'application/json'
        },
        methods: {
             setComponent(value) {
                switch(value) {
                    case "requests":
                        this.activeComponent = Requests
                        break;
                    case "users":
                        this.activeComponent = Users
                        break;
                    case "products":
                        this.activeComponent = Products
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        break;
                    case "complaints":
                        this.activeComponent = Complaints
                        break;
                    case "advertisements":
                        this.activeComponent = Advertisements
                        break;
                    default:
                        this.activeComponent = Main
                        break;
                }
            }
        }
    }
    </script>

    <style scoped>
    .hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    </style>