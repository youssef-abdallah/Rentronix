<template>
    <div class="sidebar">
        <div class="sidebar-backdrop" @click="toggle" v-if="isMenuOpen"></div>
        <transition name="slide">
            <div v-if="isMenuOpen"
                 class="sidebar-panel">
                <ul class="sidebar-panel-nav">
                <li><a href="/profile">Profile</a></li>
                <li><a href="#" v-b-toggle.collapse-2>Categories</a>
                <b-collapse id="collapse-2">
                <b-card v-for="category in categories" :key="category.id">{{ category.title }}
                    <b-button v-b-toggle.collapse-1-inner size="sm" @click="setSubcategory(category)">View subcategories</b-button>
                    <b-collapse id="collapse-1-inner" class="mt-2">
                        <b-card v-for="subcategory in filteredSubcategories" :key="subcategory.id">{{ subcategory.title }}</b-card>
                    </b-collapse>
                </b-card>
                </b-collapse>
                </li>
                <li><a href="/orders">My Orders</a></li>
                <li><a href="/requests">My Requests</a></li>
                <li><a href="/request">Create a request</a></li>
                <li><a href="/favouritelist">Favourite list</a></li>
                <li><a href="/cart">My Cart</a></li>
                <li><a href="/complaint">Make a complaint</a></li>
                <li><a href="/complaints">My complaints</a></li>
                <li><a href="/subscribe">Subscribe to newsletters</a></li>
                </ul>
            </div>
        </transition>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex'
    import { mapActions } from 'vuex'

    export default {
        data() {
            return {
                categories: [],
                subcategories: [],
                filteredSubcategories: []
            }
        },
        mounted() {
            axios.get(`api/category`).then(response => this.categories = response.data)
            axios.get(`api/allsubcategories`).then(response => this.subcategories = Object.values(response.data))
        },
        methods: {
            ...mapActions({
                toggle: 'toggleMenu',
            }),

            setSubcategory(category) {
                this.filteredSubcategories = this.subcategories.filter((subcategory) => subcategory.category_id === category.id) 
            }
        },
        computed: {
            ...mapGetters([
             'isMenuOpen'
            ])
        }
    }
</script>
<style>
    .slide-enter-active,
    .slide-leave-active
    {
        transition: transform 0.2s ease;
    }

    .slide-enter,
    .slide-leave-to {
        transform: translateX(-100%);
        transition: all 150ms ease-in 0s
    }

    .sidebar-backdrop {
        background-color: rgba(0,0,0,.5);
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        cursor: pointer;
    }

    .sidebar-panel {
        overflow-y: auto;
        background-color: rgb(1, 4, 17);
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        z-index: 999;
        padding: 3rem 20px 2rem 20px;
        width: 300px;
    }
</style>