<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Category</td>
                    <td>Subcategory</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product,index) in products" @key="index" :key="product.id">
                    <td>{{ product.id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products : []
        }
    },
    beforeMount(){
        axios.get('/api/admin/products').then(response => this.products = response.data)
    },
    methods: {
    }
}
</script>
