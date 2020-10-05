  <template>
        <div class="row mt-4">
            <div class="d-flex flex-row bd-highlight">
                <div class="bd-highlight">
                    <a href='/admin/requests' class="product-box">Requests ({{requests.length}})</a>
                </div>
                <div class="bd-highlight">
                    <a href='/admin/orders' class="product-box">Orders ({{orders.length}})</a>
                </div>
                <div class="bd-highlight">
                     <a href='/admin/products' class="product-box">Products ({{products.length}})</a>
                </div>
                <div class="bd-highlight">
                     <a href='/admin/users' class="product-box">Users ({{users.length}})</a>
                </div>
            </div>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                user : null,
                orders : [],
                products : [],
                users : [],
                requests : []
            }
        },
        mounted() {
            axios.defaults.headers.common['Accept'] = 'application/json'
            axios.get('/api/admin/requests').then(response => this.requests = response.data);
            axios.get('/api/admin/users').then(response => this.users = response.data)
            axios.get('/api/admin/orders').then(response => this.orders = response.data)
            axios.get('/api/admin/products').then(response => this.products = response.data)
        }
    }
    </script>

    <style scoped>
    .product-box { border: 1px solid #cccccc; padding: 10px; height: 10vh }
    </style>