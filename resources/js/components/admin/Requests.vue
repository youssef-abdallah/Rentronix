 <template>
        <div class="mt-4">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>Request</td>
                        <td>User</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Description</td>
                        <td>Action</td>
                        <td>Selling Price</td>
                        <td>Price per hour</td>
                        <td>Subcategory</td>
                        <td>Category</td>
                        <td>Image</td>
                        <td>Datasheet</td>
                        <td>Approved</td>
                        <td>Approve button</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(request,index) in requests" @key="index" :key="request.id">
                        <td>{{ request.id }}</td>
                        <td>{{ request.user_id }}</td>
                        <td>{{ request.product_name }}</td>
                        <td>{{ request.description }}</td>
                        <td>{{ request.type }}</td>
                        <td>{{ request.price }}</td>
                        <td>{{ request.price_per_hour }}</td>
                        <td>{{ request.subcategory_title }}</td>
                        <td>{{ request.category_title }}</td>
                        <td>{{ request.category_title }}</td>
                        <td><img src="request.image"></td>
                        <td><a href="request.datasheet">datasheet</a></td>
                        <td>{{request.approved == 1 ? "Yes" : "No"}}</td>
                        <td v-if="request.approved == 0"><button class="btn btn-success" @click="approve(index)">Approve</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                requests : []
            }
        },
        beforeMount(){
            axios.get('/api/admin/requests/').then(response => this.requests = response.data)
        },
        methods: {
            approve(index) {
                let request = this.requests[index]
                /*axios.put(`/api/orders/${order.id}/deliver`).then(response => {
                    this.orders[index].is_delivered = 1
                    this.$forceUpdate()
                })*/
            }
        }
    }
    </script>

<style lang="css">
    td {
        white-space: nowrap;
        overflow: hidden;
        width: 10px;
        height: 25px;
        border: 1px solid black;
    }

    table{
        table-layout:fixed; 
        width: 40px;
    }
</style>