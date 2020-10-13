<template>
    <div>
    <b-card :header="user.name" no-body>
        <b-tabs card>

        <b-tab title="Customer Info">
            <b-card-title>Email: <code>{{ user.email }}</code></b-card-title>
            <b-card-title>Address: <code>{{ customerInfo.address }}</code></b-card-title>
            <b-card-title>Wallet Credit: <code>${{ customerInfo.credit }}</code></b-card-title>
        </b-tab>

        <b-tab title="Seller/Loaner Info">
            <b-card-title>Email: <code>{{ user.email }}</code></b-card-title>
            <b-card-title>Percentage gain: <code>{{ sellerInfo.percentage }}%</code></b-card-title>
            <b-card-title>Total Profit: <code>${{ sellerInfo.profit }}</code></b-card-title>
            <b-card-title>Rating: <code>{{ sellerInfo.rating }}</code></b-card-title>
        </b-tab>

        </b-tabs>
    </b-card>
    </div>
</template>

<script>

export default {
    data() {
        return {
            user: {},
            customerInfo: {},
            sellerInfo: {}
        }
    },

    beforeMount() {
        axios.get('/api/profile').then(response => {
            this.user = response.data
            this.customerInfo = response.data.customer_info
            this.sellerInfo = response.data.manufacturer_info
        })
    }
}
</script>
