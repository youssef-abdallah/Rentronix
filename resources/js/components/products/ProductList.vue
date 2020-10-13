<template>
  <div>
    <div class="products">
      <div class="container">
        <div class="row">
            <template v-for="product in products">
                <product-item :product="product" :key="product.id" ></product-item>
            </template>
        </div>
    </div>
  </div>
  </div>
</template>

<script>
  import ProductItem from './ProductItem.vue'
  export default {
    name: 'product-list',
    beforeMount() {
        axios.get('/api/allproducts').then(response => {
            this.products = response.data
        })
    },
    data() {
        return {
            products : []
        }
    },
    components: {
      'product-item': ProductItem
    }
  }
</script>