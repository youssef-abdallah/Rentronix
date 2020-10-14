<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Promocode</td>
                    <td>Expiry Date</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(promocode,index) in promocodes" @key="index" :key="promocode.id">
                    <td>{{ promocode.id }}</td>
                    <td>{{ promocode.promocode }}</td>
                    <td>{{ promocode.expiredDate }}</td>
                    <td>
                        <b-button variant="danger" @click="destroy(promocode)">Remove</b-button>
                    </td>
                </tr>
            </tbody>
        </table>
        <b-button @click="$router.push('/admin/promocode/add')">Add New Promocode</b-button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currentPromocode : null,
            promocodes : []
        }
    },
    beforeMount(){
        axios.get('/api/promocodes').then(response => this.promocodes = response.data)
    },
    methods: {
        setCurrentPromocode(index) {
            this.currentPromocode = this.promocodes[index];
        },

        destroy(promocode) {
            axios.delete(`/api/promocodes/${promocode.id}`).then(response => {
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
