<template>
  <div class="row mt-2">
    <div class="col-6">
        <b-button @click="addToCart" variant="success"><i class="fa fa-cart-plus"></i> Add to Cart</b-button>
    </div>
    <div class="col-6">
        <b-button @click="removeFromCart(product.id)" variant="danger"><i class="fa fa-trash"></i> Remove </b-button>
    </div>
   
  </div>
</template>

<script>
  export default {
    props: ['product'],
    data () {
      return {
        
      }
    },
    methods: {
      addToCart () {
          axios.post(`/api/cart`, null, { params: {
                'id': this.product.id,
                'type': this.product.available_for,
            }})
            .then(response => {
                alert(response.data.message)
                this.product['rowId'] = response.data.rowId;
            })
            .catch(err => console.warn(err));
      },
      removeFromCart (id) {
          axios.delete(`/api/cart/${this.product.rowId}`).then(response => {
                this.$router.go(0);
        })
      }
    }
  }
</script>
