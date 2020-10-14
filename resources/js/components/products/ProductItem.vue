<template>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="product">
        <b-card-group>
            <b-card :img-src="product.image_url" img-alt="Image not found" img-top>
                <h4>{{ product.name }}</h4>
                <b-card-text>
                {{ product.overview }}
                </b-card-text>
                <span v-if="product.available_for === 'rent'">Rental Price ${{ product.rental_price }}</span>
                <span v-if="product.available_for === 'buy'">Selling Price ${{ product.selling_price }}</span>
                <div class="product__action">
                    <product-button :product="product" ></product-button>
                </div>
            </b-card>
        </b-card-group>
    </div>
  </div>
</template>

<script>
  import ProductButton from './ProductButton.vue'
  export default {
    name: 'product-item',
    props: ['product'],
    components: {
      'product-button': ProductButton
    }
  }
</script>