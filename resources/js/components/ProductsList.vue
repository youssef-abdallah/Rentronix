
<template>
    <table>
        <thead>
        <th>Name</th>
        <th>Price</th>
<!--        <th>image</th>-->
        <th></th>

        </thead>

        <tbody>
        <tr v-for="item in items" :key="item.id">
            <td v-text="item.title"></td>

            <td>${{ item.price.toFixed(2) }}</td>
<!--           <td>${{item.image}}</td>-->

            <td>
                <button class="button is-success" style="background-color: orangered"
                        @click="addToCart(item)"><strong>Add to Cart</strong></button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>

export default {
    // mounted() {
    //    this.fetchProducts()
    // },
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
            items: [
                {
                    id: 1,
                    title: 'product 1',
                    price: 9.99,

                },
                {
                    id: 2,
                    title: 'product 2',
                    price: 6.66
                },
                {
                    id: 3,
                    title: 'product 3',
                    price: 15.99
                },
                {
                    id: 4,
                    title: 'product 4',
                    price: 14.00
                },
                {
                    id: 5,
                    title: 'product 5',
                    price: 1.20
                },
                {
                    id: 6,
                    title: 'product 6',
                    price: 10.00
                },
                {
                    id: 7,
                    title: 'product 7',
                    price: 7.80
                },
                {
                    id: 8,
                    title: 'product 8',
                    price: 11.30
                },
                {
                    id: 9,
                    title: 'product 9',
                    price: 5.55
                },
                {
                    id: 10,
                    title: 'product 10',
                    price: 6.00
                },
            ]
        };
    },

    methods: {
        addToCart(item) {
            this.$store.commit('addToCart', item);
        },
        // fetchProducts() {
        //     axios.get('/products').then(response => {
        //         console.log(response.data)
        //         // this.items = response.data
        //     })
        // }

    },

}
</script>
