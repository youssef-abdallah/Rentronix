<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link> 
                        <li class="nav-item">
                            <router-link :to="{ name: 'about' }" class="nav-link">About</router-link> 
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLogged">Login</router-link>
                            </li>
                            <b-button @click="doLogout" v-if="isLogged" variant="outline-info" class="mb-2">
                                <b-icon icon="power" aria-hidden="true"></b-icon> Logout
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

    computed: {
        ...mapGetters([
        'isLogged'
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