<template>
    <div class="container" :class="{'loading': loading}">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <h1 class="mt-4">Filters</h1>



                <h3 class="mt-2">Categories</h3>
                <div class="form-check" v-for="(category, index) in categories" :key="category.id">
                    <input class="form-check-input" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.categories">
                    <label class="form-check-label" :for="'category' + index">
                        {{ category.title }} ({{ category.products_count }})
                    </label>
                </div>

                <h3 class="mt-2">Manufacturers</h3>
                <div class="form-check" v-for="(manufacturer, index) in manufacturers" :key="manufacturer.id">
                    <input class="form-check-input" type="checkbox" :value="manufacturer.id" :id="'manufacturer'+index" v-model="selected.manufacturers">
                    <label class="form-check-label" :for="'manufacturer' + index">
                        {{ manufacturer.name }} ({{ manufacturer.products_count }})
                    </label>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6 mb-4" v-for="product in products" :key="product.id">
                        <div class="card h-100">
                            <a href="#">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#">{{ product.name }}</a>
                                </h4>

                                <p class="card-text">{{ product.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {

            categories: [],
            manufacturers: [],
            products: [],
            loading: true,
            selected: {

                categories: [],
                manufacturers: []
            }
        }
    },
    mounted() {
        this.loadCategories();
        this.loadManufacturers();

        this.loadProducts();
    },
    watch: {
        selected: {
            handler: function () {
                this.loadCategories();
                this.loadManufacturers();

                this.loadProducts();
            },
            deep: true
        }
    },
    methods: {
        loadCategories: function () {
            axios.get('/api/categories', {
                params: _.omit(this.selected, 'categories')
            })
            .then((response) => {
                this.categories = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        loadProducts: function () {
            axios.get('/api/products', {
                params: this.selected
            })
                .then((response) => {
                    this.products = response.data.data;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadManufacturers: function () {
            axios.get('/api/manufacturers', {
                params: _.omit(this.selected, 'manufacturers')
            })
                .then((response) => {
                    this.manufacturers = response.data.data;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    }
}
</script>