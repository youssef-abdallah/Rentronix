<template>
    <div v-if="shoppingcart.length != 0" class="content">
        <div class="title">
            <h1>Your Cart <i class="fas fa-shopping-cart"></i></h1>
        </div>
        <div class="rounded" v-for="product in shoppingcart" :key="product.id">
            <strong>Product</strong>: {{ product.model.id }} <br>
            <strong>Name</strong>: {{ product.model.name }} <br>
            <strong>Owner ID</strong>: {{ product.model.owner_id }} <br>
            <strong>Overview</strong>: {{ product.model.overview }} <br>
            <strong>Price</strong>: {{ product.model.price }} <br>
            <strong>Quantity</strong>: {{ product.qty }} <br>
            <strong>Type</strong>: {{ product.type}} <br>
            <strong>Datasheet</strong>: <a href="product.model.datasheet_url">datasheet</a> <br>
            <strong>Image</strong>: <img src="product.model.image_url"> <br> 
            <div class="text-right mb-3">
                <b-button @click="destroy(product)" variant="danger">Remove</b-button>   
            </div>              
        </div>
        <strong>Total</strong>: {{total}} <br>
        <b-button @click="checkout" variant="success">Checkout</b-button>
        <b-button @click="continueShopping" variant="info">Continue Shopping</b-button>
    </div>
    <div v-else>
        <h1>Your Cart is Empty</h1>
    </div>
</template>

<script>
export default {
    data() {
        return {
            shoppingcart : []
        }
    },
    beforeMount(){
        axios.get('/api/cart').then(response => this.shoppingcart = response.data)
    },
    methods: {
        destroy(product) {
            axios.delete(`/api/cart/${product.rowId}`).then(response => {
                this.$router.go(0);
            })
        },

        checkout(){
            this.$router.push("checkout")
        },

        continueShopping(){
            this.$router.push("home")
        }
    },
    computed:{
        total(){
            let total;
            for (const key in this.shoppingcart) {
                total = `${this.shoppingcart[key].subtotal}`;
            }
            total = parseFloat(total);
            return total;
        }
    }
}
</script>

<style lang="css">
    .rounded {
        border-radius: 25px;
        border: 2px solid #A0A0A0;
        padding: 20px;
        margin: 20px;
        width: 820px;
        height: 280px;
    }
    .btn1{
        margin-left: 700px;
    }
 
    .title{
        margin-left:15px;
    }

    .btn2{
        margin-left: 20px;
        margin-bottom: 50px;
        width: 300px;
        height :50px;
    }
    .btn3{
        margin-left: 220px;
        margin-bottom: 50px;
        width: 300px;
        height :50px;
    }

</style>