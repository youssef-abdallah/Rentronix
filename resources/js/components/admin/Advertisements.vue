<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>Advertisement</td>
                    <td>Product ID</td>
                    <td>Details</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(advertisement,index) in advertisements" @key="index" :key="advertisement.id">
                    <td>{{ advertisement.id }}</td>
                    <td>{{ advertisement.product_id }}</td>

                    <td>
                        <div>
                            <b-button id="show-btn" @click="$bvModal.show('more-details'); setCurrentAdvertisement(index)">More details</b-button>
                        </div>
                    </td>
                </tr>
                <div>
                    <b-modal id="more-details" hide-footer v-show="currentAdvertisement !== null">
                        <template v-slot:modal-title>
                        <code>Advertisement {{ currentAdvertisement.id }}</code>
                        </template>
                        <div class="d-block" v-show="currentAdvertisement !== null">
                        <div v-if="currentAdvertisement !== null">
                            <strong>Advertisement</strong>: {{ currentAdvertisement.id }} <br>
                            <strong>Product ID</strong>: {{ currentAdvertisement.product_id }} <br>
                            <img style="width:30vw; height=40vh" :src="currentAdvertisement.image"> <br>
                            <button class="btn btn-danger" @click="destroy(currentAdvertisement)">Delete</button>
                        </div>
                        </div>
                    </b-modal>
                </div>
            </tbody>
        </table>
        <b-button @click="$router.push('/admin/advertisements/upload')">Add New Advertisement</b-button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentAdvertisement : null,
            advertisements : []
        }
    },
    beforeMount(){
        axios.get('/api/advertisements').then(response => this.advertisements = response.data)
    },
    methods: {
        setCurrentAdvertisement(index) {
            this.currentAdvertisement = this.advertisements[index];
        },

        destroy(advertisement) {
            axios.delete(`/api/advertisements/${advertisement.id}`).then(response => {
                this.$router.go(0);
            })
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
