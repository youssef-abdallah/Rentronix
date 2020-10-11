<template>
    <div class="sidebar">
        <div class="sidebar-backdrop" @click="toggle" v-if="isMenuOpen"></div>
        <transition name="slide">
            <div v-if="isMenuOpen"
                 class="sidebar-panel">
                <ul class="sidebar-panel-nav">
                <li><a href="/profile">Profile</a></li>
                <li><a href="/profile/edit">Edit Profile</a></li>
                <li><a href="/request">Create a request</a></li>
                <li><a href="/categories">Categories</a></li>
                </ul>
            </div>
        </transition>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex'
    import { mapActions } from 'vuex'

    export default {
        methods: {
            ...mapActions({
                toggle: 'toggleMenu',
            })
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