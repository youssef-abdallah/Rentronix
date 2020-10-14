<template>
  <div>
    <b-form @submit.prevent="confirm" @reset="backToCart">
		<h1>
        <i class="fas fa-shipping-fast"></i>Shipping Details
        </h1>
      <b-form-group id="input-group-1" label="Name:" label-for="input-1">
        <b-form-input
          id="input-1"
          v-model="form.name"
          required
          placeholder="Enter your full name"
        ></b-form-input>
      </b-form-group>


      <b-form-group id="input-group-2" label="Phone No." label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.phone"
          required
          placeholder="Enter your phone no."
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Address" label-for="input-3">
        <b-form-input
          id="input-3"
          v-model="form.address"
          required
          placeholder="Enter your detailed address"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-4" label="Zip" label-for="input-4">
        <b-form-input
          id="input-4"
          v-model="form.zip"
          required
          placeholder="Enter Zip code"
        ></b-form-input>
      </b-form-group>

		<h1>
            <i class="far fa-credit-card"></i> Payment Information
        </h1>
      <b-form-group id="input-group-5" label="Credit Card No." label-for="input-5">
        <b-form-input
          id="input-5"
          v-model="form.creditcard_no"
          required
          placeholder="Enter credit card no."
        ></b-form-input>
      </b-form-group>
	  
	  <b-form-group id="input-group-6" label="EXP" label-for="input-6">
        <b-form-input
          id="input-6"
          v-model="form.exp"
          required
        ></b-form-input>
      </b-form-group>
	
	<b-form-group id="input-group-7" label="CCV" label-for="input-7">
        <b-form-input
          id="input-7"
          v-model="form.ccv"
          required
        ></b-form-input>
      </b-form-group>	


      <b-button type="submit" variant="success">Checkout</b-button>
      <b-button type="reset" variant="info">Back To Cart</b-button>
    </b-form>
  </div>
</template>

<script>

import Form from '../classes/Form'
 
export default {
    data: () => ({
        form: new Form({
            name: null, 
            phone: null,
            address: null,
            zip: null,
            creditcard_no: null,
            exp: null, 
            ccv: null,
        }),

   }),
 
    methods: {
        confirm(){
            axios.post('/api/checkout')
            this.$router.push("home")
        },
        backToCart(){
            this.$router.push("cart")
        }
    }
}

</script>