<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Name</td>
                    <td>Subcategory</td>
                    <td>Details</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product,index) in products" @key="index" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.subcategory_id }}</td>

                    <td>
                        <div>
                            <b-button id="show-btn" @click="$bvModal.show('more-details'); setCurrentProduct(index)">More details</b-button>

                            
                            </div>
                    </td>
                </tr>
                <div>
                    <b-modal id="more-details" hide-footer v-show="currentProduct !== null">
                        <template v-slot:modal-title>
                        <code>Product {{ currentProduct.id }}</code>
                        </template>
                        <div class="d-block" v-show="currentProduct !== null">
                        <div v-if="currentProduct !== null">
                            <strong>Product</strong>: {{ currentProduct.id }} <br>
                            <strong>Name</strong>: {{ currentProduct.name }} <br>
                            <strong>Owner ID</strong>: {{ currentProduct.owner_id }} <br>
                            <strong>Overview</strong>: {{ currentProduct.overview }} <br>
                            <strong>Available for</strong>: {{ currentProduct.available_for }} <br>
                            <strong>Available quantity</strong>: {{ currentProduct.available_stock }} <br>
                            <strong>Price</strong>: {{ currentProduct.selling_price }} <br>
                            <strong>Price Per Hour</strong>: {{ currentProduct.rental_price }} <br>
                            <strong>Datasheet</strong>: <a href="currentProduct.datasheet_url">datasheet</a> <br>
                            <strong>Image</strong>: <img src="currentProduct.image_url"> <br>
                            <button class="btn btn-danger" @click="destroy(currentProduct)">Delete</button>
                            
                        </div>
                        </div>
                    </b-modal>
                </div>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentProduct : null,
            products : []
        }
    },
    beforeMount(){
        axios.get('/api/admin/products').then(response => this.products = response.data)
    },
    methods: {
        setCurrentProduct(index) {
            this.currentProduct = this.products[index];
        },

        destroy(product) {
            axios.delete(`/api/admin/products/${product.id}`).then(response => {
                this.$router.go(0);
            })
        }
    }
}
</script>

<style lang="css">
    td {
        white-space: nowrap;
        overflow: hidden;
        width: 10px;
        height: 25px;
        border: 1px solid black;
    }

    table{
        table-layout:fixed; 
        width: 40px;
    }
</style>
