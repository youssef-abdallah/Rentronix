 <template>
        <div class="mt-4">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td>Complaint</td>
                        <td>User</td>
                        <td>Details</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(complaint,index) in complaints" @key="index" :key="complaint.id">
                        <td>{{ complaint.id }}</td>
                        <td>{{ complaint.user_id }}</td>

                        <td>
                            <div>
                            <b-button id="show-btn" @click="$bvModal.show('more-details'); setCurrentComplaint(index)">More details</b-button>
                            </div>
                        </td>
                    </tr>
                    <div>
                        <b-modal id="more-details" hide-footer v-show="currentComplaint !== null">
                                <template v-slot:modal-title>
                                <code>Complaint {{ currentComplaint.id }}</code>
                                </template>
                                <div class="d-block" v-show="currentComplaint !== null">
                                <div v-if="currentComplaint !== null">
                                    <strong>Complaint</strong>: {{ currentComplaint.id }} <br>
                                    <strong>User</strong>: {{ currentComplaint.user_id }} <br>
                                    <strong>Content</strong>: {{ currentComplaint.content }} <br>
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
                currentComplaint : null,
                complaints : []
            }
        },
        beforeMount(){
            axios.get('/api/complaints').then(response => this.complaints = response.data)
        },
        methods: {
            setCurrentComplaint(index) {
                this.currentComplaint = this.complaints[index];
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