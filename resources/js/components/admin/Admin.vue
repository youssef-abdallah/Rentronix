<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Admin Dashboard</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <ul style="list-style-type:none">
                            <li class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                            <!-- <li><button class="btn" @click="setComponent('orders')">Orders</button></li>
                            <li><button class="btn" @click="setComponent('products')">Products</button></li>
                            <li><button class="btn" @click="setComponent('users')">Users</button></li> -->
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <component :is="activeComponent"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Main from './Main'
    // import Users from '../components/admin/Users'
    // import Products from '../components/admin/Products'
    // import Orders from '../components/admin/Orders'

    export default {
        data() {
            return {
                activeComponent: null
            }
        },
        components: {
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            axios.defaults.headers.common['Content-Type'] = 'application/json'
        },
        methods: {
             setComponent(value) {
                switch(value) {
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