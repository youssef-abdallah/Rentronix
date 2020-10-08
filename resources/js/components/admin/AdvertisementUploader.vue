<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <h1>Upload product advertisement</h1>
      <label>File
        <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/>
      </label>
      <label>Product ID
        <input v-model="productId" type="number" id="id"/>
      </label>
        <button v-on:click="submitForm()">Upload</button>
    </div>
  </div>
</template>
  
<script>
  export default {
    data(){
      return {
        file: '',
        productId: ''
      }
    },
  
    methods: {
      submitForm(){
            let formData = new FormData();
            formData.append('image', this.file);
            formData.append('product_id', this.productId);
  
            axios.post('http://localhost:8000/api/advertisements',
                formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': "Bearer " + localStorage.getItem('token')
                }
              }
            ).then(function(data){
              console.log(data.data);
            })
            .catch(function(){
              console.log('FAILURE!!');
            });
      },
  
      onChangeFileUpload(){
        this.file = this.$refs.file.files[0];
      }
    }
  }
</script>