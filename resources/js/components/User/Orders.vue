<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>Order id</td>
                    <td>Cost</td>
                    <td>Status</td>
                    <td>Details</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order,index) in orders" @key="index" :key="order.id">
                    <td>{{ order.id }}</td>
                    <td>{{ order.total_cost }}</td>
                    <td>{{ order.shipping_status }}</td>
                    <td>
                        <div>
                        <b-button id="show-btn" @click="$bvModal.show('more-details'); setCurrentOrder(index)">Order details</b-button>
                        </div>
                    </td>
                </tr>
                <div>
                    <b-modal id="more-details" hide-footer v-show="currentOrder !== null">
                        <template v-slot:modal-title>
                        <code>Order {{ currentOrder.id }}</code>
                        </template>
                        <div class="d-block" v-show="currentOrder !== null">
                        <div v-if="currentOrder !== null">
                            <b-list-group v-for="(product,index) in currentOrder.products" @key="index" :key="product.id">
                                <b-list-group-item><strong>Product name: </strong>{{ product.name }} 
                                    <b-list-group>
                                        <b-list-group-item><strong>Action: </strong>{{ product.pivot.type }} </b-list-group-item>
                                        <b-list-group-item><strong>Quantity: </strong>{{ product.pivot.quantity }} </b-list-group-item>
                                        <b-list-group-item><strong>Product cost: </strong>{{ product.pivot.quantity * product.selling_price }} </b-list-group-item>
                                        <b-list-group-item><strong>Due Date: </strong>{{ product.pivot.due_date }} </b-list-group-item>
                                    </b-list-group>
                                </b-list-group-item>
                            </b-list-group>
                            <strong>Total Cost: </strong>{{ currentOrder.total_cost }} <br>
                            <strong>Shipping Status: </strong>{{ currentOrder.shipping_status }} <br>
                            <button class="btn btn-danger" @click="destroy(currentOrder)">Cancel Order</button>
                        </div>
                        </div>
                    </b-modal>
                </div>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentOrder: null,
            orders : []
        }
    },
    beforeMount(){
        axios.get('/api/orders').then(response => this.orders = response.data)
    },
    methods: {
        setCurrentOrder(index) {
            this.currentOrder = this.orders[index];
        },
        destroy(order) {
            axios.delete(`/api/orders/${order.id}`).then(response => {
                this.$router.go(0);
            })
        }
    }
}
</script>