  <template>
        <div class="row mt-2">
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
            axios.get('/api/admin/requests').then(response => this.requests = resonpse.data);
            // axios.get('/api/users').then(response => this.users = response.data)
            // axios.get('/api/orders').then(response => this.orders = response.data)
        }
    }
    </script>

    <style scoped>
    .product-box { border: 1px solid #cccccc; padding: 10px; height: 10vh }
    </style>