<template>
  <div>
    <b-form @submit.prevent="submit" @reset="reset" @keydown="form.errors.clear($event.target.name)">
      <b-form-group
        id="input-group-1"
        label="Product Name:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="form.product_name"
          required
          placeholder="Enter the product name"
        ></b-form-input>
      </b-form-group>

      <b-form-group label="Request Type:" label-for="select1">
        <b-form-select id="select1" v-model="this.form.type" :options="typeOptions" size="sm" class="mt-3"></b-form-select>
      </b-form-group>

      <b-form-group id="input-group-2" label="Description:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.description"
          required
          placeholder="Enter the description of the request"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Subcategory:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.subcategory_title"
          required
          placeholder="Enter the subcategory of the product"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Subcategory Description:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.subcategory_description"
          required
          placeholder="Enter the description of the subcategory"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Category:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.category_title"
          required
          placeholder="Enter the description of the subcategory"
        ></b-form-input>
      </b-form-group>

      <div>
        <label for="demo-sb">Quantity</label>
        <b-form-spinbutton v-model="form.quantity" min="1" max="20"></b-form-spinbutton>
      </div>

      <div>
        <label for="sb-step">Rental Price Per Hour:</label>
        <b-form-spinbutton
          id="sb-step"
          v-model="form.price_per_hour"
          min="0.0"
          max="1000.0"
          step="10.0"
        ></b-form-spinbutton>
      </div>

      <div>
        <label for="sb-step">Selling price:</label>
        <b-form-spinbutton
          id="sb-step"
          v-model="form.price"
          min="0.0"
          max="50000.0"
          step="100.0"
        ></b-form-spinbutton>
      </div>

      <b-form-group>
        <label>Image
          <input type="file" id="file" ref="image" v-on:change="imageUploaded()"/>
        </label>
      </b-form-group>

      <b-form-group>
        <label>Datasheet
          <input type="file" id="file" ref="datasheet" v-on:change="datasheetUploaded()"/>
        </label>
      </b-form-group>

      <b-button :disabled="form.errors.any()" type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>

import Form from '../classes/Form'
 
export default {
    data: () => ({
        form: new Form({
            product_name: null, 
            description: null,
            quantity: null,
            subcategory_title: null,
            subcategory_description: null,
            category_title: null, 
            type: 'loan',
            price: null,
            price_per_hour: null,
            image: null,
            datasheet: null
        }),

        quantity: 1,
        typeOptions: [{ value: 'loan', text:'Loan' },
                      { value: 'sell', text:'Sell' },
                      { value: 'repair', text:'Repair' } ]
   }),
 
    methods: {
        submit() {
          this.form.post('api/requests');
          // axios.post('api/requests', formData)
          //       .then(response => {
          //           console.log('success');
          //           //this.onSuccess(response.data);

          //           // resolve(response.data);
          //       })
          //       .catch(error => {
          //           console.log(error);
          //           // this.onFail(error.response.data);

          //           // reject(error.response.data);
          //       });
          //   //this.form.post('/api/requests');
        },

        reset() {
            this.form.reset();
        },

        imageUploaded() {
          this.form.image = this.$refs.image.files[0];
        },

        datasheetUploaded() {
          this.form.datasheet = this.$refs.datasheet.files[0];
        }
    }
}

</script>

<style>

</style>