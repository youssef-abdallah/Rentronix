<template>
    <div v-if="favouritelist.length != 0" class="content">
        <div class="title">
            <h1>Your Favourite List <i class="far fa-star"></i></h1>
        </div>
        <b-card v-for="product in favouritelist" :key="product.id">
            <strong>Product</strong>: {{ product.product.id }} <br>
            <strong>Name</strong>: {{ product.product.name}} <br>
            <strong>Owner ID</strong>: {{ product.product.owner_id }} <br>
            <strong>Overview</strong>: {{ product.product.product_overview }} <br>
            <span v-if="product.product.available_for == 'rent'"><strong>Rental Price</strong>: {{product.product.rental_price }}</span>
            <span v-if="product.product.available_for == 'buy'"><strong>Selling Price</strong>: {{product.product.selling_price }}</span><br>
            <strong>Datasheet</strong>: <a href="product.product.datasheet_url">datasheet</a> <br>
            <strong>Image</strong>: <img src="product.product.image_url"> <br>
            <div class="text-right mb-3">
                <b-button @click="cart" variant="success">Add To Cart</b-button>
                <b-button @click="destroy(product)" variant="danger">Remove</b-button>   
            </div>            
        </b-card>
        <b-button @click="continueShopping" variant="info">Continue Shopping</b-button>
    </div>
    <div v-else>
        <h1>Your Favourite List is Empty</h1>
    </div>
</template>

<script>
export default {
    data() {
        return {
            favouritelist : []
        }
    },
    beforeMount(){
        axios.get('/api/favouritelist').then(response => this.favouritelist = response.data)
    },
    methods: {
        destroy(product) {
            axios.delete(`/api/favouritelist/${product.id}`).then(response => {
                this.$router.go(0);
            })
        },

        cart(){
            axios.post(`/api/cart`, null, { params: {
                'id': this.favouritelist.product.id,
                'type': this.favouritelist.product.available_for,
            }})
            .then(response => {
                alert(response.data.message)
                this.favouritelist['id'] = response.data.id;
            })
            .catch(err => console.warn(err));
        },

        continueShopping(){
            this.$router.push("home")
        }
    }
}
</script>

<style lang="css">
</style>