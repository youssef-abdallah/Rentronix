 <template>
        <div class="mt-4">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>Request</td>
                        <td>User</td>
                        <td>Product Name</td>
                        <td>Subcategory</td>
                        <td>Category</td>
                        <td>Details</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(request,index) in requests" @key="index" :key="request.id">
                        <td>{{ request.id }}</td>
                        <td>{{ request.user_id }}</td>
                        <td>{{ request.product_name }}</td>
                        <td>{{ request.subcategory_title }}</td>
                        <td>{{ request.category_title }}</td>
                        <!-- <td>{{ request.description }}</td>
                        <td>{{ request.type }}</td>
                        <td>{{ request.price }}</td>
                        <td>{{ request.price_per_hour }}</td>
                        <td>{{ request.category_title }}</td>
                        <td><img src="request.image"></td>
                        <td><a href="request.datasheet">datasheet</a></td>
                        <td>{{request.approved == 1 ? "Yes" : "No"}}</td>
                        <td v-if="request.approved == 0"><button class="btn btn-success" @click="approve(index)">Approve</button></td> -->
                        <td>
                            <div>
                            <b-button id="show-btn" @click="$bvModal.show('more-details'); setCurrentRequest(index)">More details</b-button>

                            <b-modal id="more-details" hide-footer v-show="currentRequest != null">
                                <template v-slot:modal-title>
                                <code>Request {{ currentRequest.id }}</code>
                                </template>
                                <div class="d-block" v-show="currentRequest != null">
                                <div v-if="currentRequest !== null">
                                    <strong>Request</strong>: {{ currentRequest.id }} <br>
                                    <strong>User</strong>: {{ currentRequest.user_id }} <br>
                                    <strong>Product</strong>: {{ currentRequest.product_name }} <br>
                                    <strong>Subcategory</strong>: {{ currentRequest.subcategory_title }} <br>
                                    <strong>Category</strong>: {{ currentRequest.category_title }} <br>
                                    <strong>Type</strong>: {{ currentRequest.type }} <br>
                                    <strong>Price</strong>: {{ currentRequest.price }} <br>
                                    <strong>Price Per Hour</strong>: {{ currentRequest.price_per_hour }} <br>
                                    <strong>Datasheet</strong>: <a href="currentRequest.datasheet">datasheet</a> <br>
                                    <strong>Image</strong>: <img src="currentRequest.image"> <br>
                                    <strong v-if="currentRequest.approved == 0"><button class="btn btn-success" @click="approve(currentRequest)">Approve</button></strong>
                                    <button class="btn btn-danger" @click="destroy(currentRequest)">Delete</button>
                                    
                                </div>
                                </div>
                            </b-modal>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                currentRequest : null,
                requests : []
            }
        },
        beforeMount(){
            axios.get('/api/admin/requests/').then(response => this.requests = response.data)
        },
        methods: {
            setCurrentRequest(index) {
                this.currentRequest = this.requests[index];
            },
            approve(request) {
                axios.put(`/api/admin/requests/${request.id}/approve`).then(response => {
                })
                this.$router.go(0);
            },
            destroy(request) {
                axios.delete(`/api/admin/requests/${request.id}`).then(response => {
                })
                this.$router.push('/admin/dashboard');
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