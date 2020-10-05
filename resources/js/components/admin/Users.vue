<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>User</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users" @key="index" :key="user.id">
                    <td>{{ user.id }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users : []
        }
    },
    beforeMount(){
        axios.get('/api/admin/users').then(response => this.users = response.data)
    },
    methods: {
    }
}
</script>
