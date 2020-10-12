
<template>
    <table class=" table is-striped is-narrow is-hoverable is-fullwidth" >
        <thead>
            <th class="tbhead" style="color:brown">Name</th>
            <th class="tbhead" style="color:brown">Price</th>
            <th></th>
            <th class="tbhead" style="color:brown">Image</th>
            <th class="tbhead" style="color:brown">Overview</th>
            <th></th>
        </thead>

        <tbody>
        <tr v-for="item in items" :key="item.id" >
            <td v-text="item.name" class="tbelement">
            </td>

            <td class="tbelement">{{ item.selling_price.toFixed(2) }}
                <span style="font-size:20px ; color: red;">
                    $
                </span>
            </td>

            <td>
            </td>

            <td class="tbelement">
                <img src="https://lorempixel.com/640/480/?82477" style="width: 70%; height: 20%;">
            </td>

            <td v-text="item.product_overview" class="tbelement">
            </td>

            <td class="tbelement">
                <button id="addtocard" title="add to cart" class="button is-success" style="background-color: orangered ; margin-top: 30px"
                        @click="addToCart(item)"><strong>Add to Cart</strong></button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>

export default {
    beforeMount() {

            axios.get('/api/allproducts').then(response => {
                console.log(response)
                this.items = response.data
            })
        },
    // created() {
    //     // this.fetchProducts()
    //     const { data } = this.$axios
    //         .get("{subcategory}/products")
    //         .then((res) => {
    //             console.log(res);
    //         })
    //         .catch((err) => {
    //             console.log(err);
    //         });
    // },
    data() {
        return {
            items: []
        };
    },

    methods: {
        addToCart(item) {
            this.$store.commit('addToCart', item);
        },

    },

}
</script>

<style>
.tbelement{
    font-size: 17px;
    font-family: "Nunito", sans-serif;

}
.tbhead{
    font-size:22px;
    font-weight: bolder;

}
</style>
