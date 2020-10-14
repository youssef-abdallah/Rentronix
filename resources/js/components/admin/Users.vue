<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td>User id</td>
                    <td>Name</td>
                    <td>Details</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users" @key="index" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>
                        <div>
                        <b-button id="show-btn" @click="$bvModal.show('more-details'); setCurrentUser(index)">More details</b-button>
                        </div>
                    </td>
                </tr>
                <div>
                    <b-modal id="more-details" hide-footer v-show="currentUser !== null">
                        <template v-slot:modal-title>
                        <code>User {{ currentUser.id }}</code>
                        </template>
                        <div class="d-block" v-show="currentUser !== null">
                        <div v-if="currentUser !== null">
                            <strong>User</strong>: {{ currentUser.id }} <br>
                            <strong>Name</strong>: {{ currentUser.name }} <br>
                            <strong>Email</strong>: {{ currentUser.email }} <br>
                            <strong>Phone number</strong>: {{ currentUser.phone_no }} <br>
                            <strong>Facebook ID</strong>: {{ currentUser.facebook_id }} <br>
                            <strong>Google ID</strong>: {{ currentUser.google_id }} <br>
                            <div v-show="currentUser.customer_info">
                                <strong>Address</strong> {{ currentUser.customer_info.address }} <br>
                                <strong>Credit</strong>: ${{ currentUser.customer_info.credit }}<br>
                            </div>
                            <div v-show="currentUser.manufacturer_info">
                                <strong>Total Profit</strong>: ${{ currentUser.manufacturer_info.profit }} <br>
                                <strong>Rating</strong>: {{ currentUser.manufacturer_info.rating }} <br>
                                <b-form-spinbutton
                                id="sb-step"
                                v-model="currentUser.manufacturer_info.percentage"
                                min="0.0"
                                max="1.0"
                                step="0.05"
                                ></b-form-spinbutton>
                                <strong>Rentronix percentage gain</strong>: {{ currentUser.manufacturer_info.percentage }}%
                                <b-button @click="updateGain">Update Percentage Gain</b-button>
                            </div>
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
            currentUser: null,
            users : []
        }
    },
    beforeMount(){
        axios.get('/api/admin/users').then(response => this.users = response.data)
    },
    methods: {
        setCurrentUser(index) {
            this.currentUser = this.users[index];
        },

        updateGain() {
            axios.put(`/api/users/${this.currentUser.id}`, null, { params: this.currentUser})
            .then(response => {
                alert('percentage updated successfully.')
            })
            .catch(err => console.warn(err));
        }
    }
}
</script>
