<template>
    <div>
    <b-form @submit="onSubmit">
      <b-form-group
        id="input-group-1"
        label="Email Promocode:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="promocode"
          type="promocode"
          required
          placeholder="Enter promocode"
        ></b-form-input>
      </b-form-group>
       <label for="expiry-date">Set the expiry date</label>
        <b-form-datepicker id="expiry-date" v-model="expiryDate" class="mb-2"></b-form-datepicker>
        <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
  </div>
</template>

<script>

export default {
    data() {
        return {
            promocode: '',
            expiryDate: ''
        }
    },

    methods: {
        onSubmit() {
            const formData = new FormData();
            formData.append('promocode', this.promocode);
            formData.append('expiredDate', this.expiryDate);
            axios.post(`api/promocodes`, formData)
                .then(response => {
                    alert(response.data.message)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}

</script>