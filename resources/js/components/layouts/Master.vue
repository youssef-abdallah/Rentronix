<template>
    <div>
        <h1>Vue Router Demo</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'about' }">About</router-link> |
            <router-link :to="{ name: 'login' }" v-if="!isLogged">Login</router-link>
            <button type="button" @click="doLogout" v-if="isLogged">
            Logout
            </button>
        </p>

        <div class="container">
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