<template>
    <div>
        <side-bar></side-bar>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <toggler></toggler>
                        </li>
                        <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link> 
                        <li class="nav-item">
                            <router-link :to="{ name: 'about' }" class="nav-link">About</router-link> 
                        </li>
                        <router-link v-if="isAdmin" class="nav-link" :to="{ name: 'admin' }">Admin</router-link>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <router-link :to="{ name: 'search' }" class="nav-link">Search <i class="fas fa-search"></i></router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLogged">Login <i class="fas fa-user"></i></router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'cart' }" class="nav-link" v-if="isLogged">Cart <i class="fas fa-shopping-cart"></i></router-link>
                            </li>
                            <b-button @click="doLogout" v-if="isLogged" class="mb-2">
                                 Logout
                            </b-button>
                    </ul>
                </div>
            </div>
        </nav>
            <!-- <div class="container">
                <router-link :to="{ name: 'home' }" >Home</router-link> 
                <router-link :to="{ name: 'about' }">About</router-link> 
                <router-link :to="{ name: 'login' }" v-if="!isLogged">Login</router-link>
                <button type="button" @click="doLogout" v-if="isLogged">
                Logout        </nav>
                </button>
            </div> -->

        <div class="container mt-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import { mapGetters } from 'vuex'
import Sidebar from './Sidebar'
import Toggler from './Toggler'

export default {

    mounted() {
		if (this.getCookie('token')) {
            this.loginCallback(this.getCookie('token'));
            document.cookie = "token=; max-age=0";
        }
        // if (token != null) {
		// 	this.loginCallback(token)
		// 	console.log(token);
		// }
    },

    components: {
        "side-bar": Sidebar,
        "toggler": Toggler
    },

    computed: {
        ...mapGetters([
        'isLogged',
        'isAdmin'
        ])
    },

    methods: {
		...mapActions({
            loginCallback: 'loginCallback',
            logout : 'logout'
        }),

        getCookie(name) {
            // Split cookie string and get all individual name=value pairs in an array
            var cookieArr = document.cookie.split(";");
            
            // Loop through the array elements
            for(var i = 0; i < cookieArr.length; i++) {
                var cookiePair = cookieArr[i].split("=");
                
                /* Removing whitespace at the beginning of the cookie name
                and compare it with the given string */
                if(name == cookiePair[0].trim()) {
                    // Decode the cookie value and return
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            
            // Return null if not found
            return null;
        },
        doLogout(){
            this.logout();
        }
    }
}


</script>

<style>
html {
   height: 100%;
 }

 body {
   border: 0; margin: 0; padding: 0;
   font-family: 'Lato';
   height: 100%;
   background: rgb(19, 167, 110);
   background: rgb(155, 169, 192);
 }

 .logo {
   align-self: center;
   color: #fff;
   font-weight: bold;
   font-family: 'Lato'
 }

 .main-nav {
   display: flex;
   justify-content: space-between;
   padding: 0.5rem 0.8rem;
 }

 ul.sidebar-panel-nav {
   list-style-type: none;
 }

 ul.sidebar-panel-nav > li > a {
   color: #fff;
   text-decoration: none;
   font-size: 1.5rem;
   display: block;
   padding-bottom: 0.5em;
 }
</style>