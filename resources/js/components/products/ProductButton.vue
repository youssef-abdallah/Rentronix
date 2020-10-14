<template>
  <div class="row mt-2">
    <div class="col-6">
        <b-button @click="addToCart" variant="success"><i class="fa fa-cart-plus"></i> Add to Cart</b-button>
    </div>
    <div class="col-6">
        <b-button @click="addToFavourite(product.id)" variant="danger"><i class="fa fa-heart"></i> Favorite </b-button>
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
      addToFavourite (id) {
          const formData = new FormData();
          formData.append('product_id', this.product.id)
          axios.post(`/api/favouritelist`, formData).then(response => {
                alert('product added to favourite list.')
        })
      }
    }
  }
</script>
