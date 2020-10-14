<template>
    <div>
    <b-form @submit.prevent="onSubmit">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="email"
          type="email"
          required
          placeholder="Enter email"
        ></b-form-input>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
  </div>
</template>

<script>

export default {
    data() {
        return {
            email: ''
        }
    },

    methods: {
        onSubmit() {
            const formData = new FormData();
            formData.append('email', this.email);
            axios.post(`api/subscriptions`, formData)
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