<template>
    <div v-if="favouritelist.length != 0" class="content">
        <div class="title">
            <h1>Your Favourite List <i class="far fa-star"></i></h1>
        </div>
        <div v-for="item in favouritelist" :key="item.id">
            <div>
            <b-card
                :title="'Product ' + item.product.id"
                :img-src="item.product.image_url"
                img-alt="Image"
                img-top
                img-height="20vh"
                tag="article"
                style="max-width: 50rem;"
                class="mb-2"
            >
                <b-card-text>
                <strong>Product</strong>: {{ item.product.id }} <br>
                <strong>Name</strong>: {{ item.product.name}} <br>
                <strong>Owner ID</strong>: {{ item.product.owner_id }} <br>
                <strong>Overview</strong>: {{ item.product.product_overview }} <br>
                <span v-show="item.product.available_for==='rent'"><strong>Rental Price</strong>: {{ item.product.rental_price }} <br></span>
                <span v-show="item.product.available_for==='buy'"><strong>Selling Price</strong>: {{ item.product.selling_price }} <br></span>
                <strong>Datasheet</strong>: <a href="item.product.datasheet_url">datasheet</a> <br>
                <div class="text-right mb-3">
                    <b-button @click="addToCart(item.product)" variant="success">Add To Cart</b-button>
                    <b-button @click="destroy(item)" variant="danger">Remove</b-button>   
                </div>
                </b-card-text>

            </b-card>
            </div>            
        </div>
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

        addToCart(product) {
            axios.post(`/api/cart`, null, { params: {
                'id': product.id,
                'type': product.available_for,
            }})
            .then(response => {
                alert(response.data.message)
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
    .wrapper {
        border-radius: 10px;
        border: 2px solid #A0A0A0;
        padding: 20px;
        margin: 20px 0;
        width: 800px;
        height: 250px;
    }
</style>