<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>Order id</td>
                    <td>Customer id</td>
                    <td>Cost</td>
                    <td>Status</td>
                    <td>Details</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order,index) in orders" @key="index" :key="order.id">
                    <td>{{index+1}}</td>
                    <td v-html="order.product.name"></td>
                    <td>{{order.quantity}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders : []
        }
    },
    beforeMount(){
        axios.get('/api/admin/orders').then(response => this.orders = response.data)
    },
    methods: {
    }
}
</script>
