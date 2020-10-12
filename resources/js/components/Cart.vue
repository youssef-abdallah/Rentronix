
<template>

    <div class="navbar-item has-dropdown is-hoverable" >
        <a class="navbar-link" href="" >
            <strong>Cart ({{ $store.state.cartCount }})</strong>
        </a>

        <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
            <dev v-for="item in $store.state.cart"
               :key="item.id"
               class="navbar-item"
               href="">

                <a class="removeBtn"
                      title="Remove from cart"
                      @click.prevent="removeFromCart(item)"><strong>X</strong>
                </a>

               <span style="font-size: 17px" class="price"> {{ item.name }}
                   <span style="color:red">x{{ item.quantity }}
                   </span>  - ${{ item.totalPrice }}
               </span>
            </dev>

            <span class="navbar-item" style="color: deepskyblue" >
               <span style="color:darkred;font-size: larger ">Total: </span>
            <strong><span style="color: red;font-size: larger">{{ totalPrice }}$</span></strong>
            </span>

            <hr class="navbar-divider">

<!--            <a class="navbar-item" href="">-->
<!--                Checkout-->
<!--            </a>-->
        </div>

        <div v-else class="navbar-dropdown is-boxed is-right">
            <div class="navbar-item" href="">
                Cart is empty
            </div>
        </div>
    </div>
</template>
<script >

export default {

    methods: {
        removeFromCart(item) {
            this.$store.commit('removeFromCart', item);
        }
    },
    computed: {
        totalPrice() {
            let total = 0;

            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }

            return total.toFixed(2);
        }
    },

};
</script>

<style>
.removeBtn {
    margin-right: 1rem;
    color: red;

}
.navbar-link{
    margin-right: 10rem;
}
.price{
    font-size: 15px;
    color: darkred;
    font-family: Andalus;
}
</style>
