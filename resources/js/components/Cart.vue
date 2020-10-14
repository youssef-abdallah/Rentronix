<template>
    <div v-if="shoppingcart.length != 0" class="content">
        <div class="title">
            <h1>Your Cart <i class="fas fa-shopping-cart"></i></h1>
        </div>
        <div v-for="product in shoppingcart" :key="product.id">
            <div>
            <b-card
                :title="'Product ' + product.model.id"
                :img-src="product.model.image_url"
                img-alt="Image"
                img-top
                img-height="20vh"
                tag="article"
                style="max-width: 50rem;"
                class="mb-2"
            >
                <b-card-text>
                <strong>Product</strong>: {{ product.model.id }} <br>
                <strong>Name</strong>: {{ product.model.name }} <br>
                <strong>Owner ID</strong>: {{ product.model.owner_id }} <br>
                <strong>Overview</strong>: {{ product.model.product_overview}} <br>
                <strong>Datasheet</strong>: <a href="product.model.datasheet_url">datasheet</a> <br>
                <strong>Avilable For</strong>: {{ product.model.available_for}} <br>
                <span v-show="product.model.available_for==='rent'"><strong>Rental Price</strong>: {{ product.model.rental_price }} <br></span>
                <span v-show="product.model.available_for==='buy'"><strong>Selling Price</strong>: {{ product.model.selling_price }} <br></span>
                <div>
                    <label for="demo-sb"><strong>Quantity</strong>:</label>
                    <b-spinbutton v-model="product.qty" min="1" max="20"></b-spinbutton>
                </div>
                <div v-if="product.model.available_for === 'rent'">
                    <label for="demo-sb"><strong>Rental Hours</strong>:</label>
                    <b-spinbutton v-model="product.hours" min="1" max="720"></b-spinbutton>
                </div> 
                
                <div class="text-right mb-3 mt-4">
                    <b-button @click="saveChanges(product)" variant="primary">Save Changes</b-button> 
                    <b-button @click="destroy(product)" variant="danger">Remove</b-button>   
                </div>
                </b-card-text>
            </b-card>
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
        },

        saveChanges(product){
            axios.put(`/api/cart/${product.rowId}`, null, { params: {
                'quantity': product.qty,
                'hours' : product.hours,
            }})
            .then(response => {
                alert(response.data.message)
            })
            .catch(err => console.warn(err));
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
</style>