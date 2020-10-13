<template>
  <div>
    <b-form @submit.prevent="submit" @reset="reset" @keydown="form.errors.clear($event.target.name)">
      <b-form-group
        id="input-group-1"
        label="Complaint description"
        label-for="input-1"
      >
        <b-form-textarea
        id="textarea"
        v-model="form.content"
        placeholder="Enter your complaint"
        rows="3"
        max-rows="6"
        ></b-form-textarea>
      </b-form-group>

      <b-button :disabled="form.errors.any()" type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </div>
</template>

<script>

import Form from '../../classes/Form'
 
export default {
    data: () => ({
        form: new Form({
            content: null
        }),
   }),
 
    methods: {
        submit() {
          this.form.post('api/complaints');
        },

        reset() {
            this.form.reset();
        },
    }
}

</script>

<style>

</style>