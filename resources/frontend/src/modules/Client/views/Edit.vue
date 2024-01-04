<template>
    <div class="ClientEdit">
        <CCard v-if="client">
            <CCardHeader>
                <h4>{{ client.full_name }}</h4>
            </CCardHeader>
            <CCardBody>
                <NewClientForm :form-data.sync="client"/>
            </CCardBOdy>
            <CCardFooter class="d-flex justify-content-between">
                <router-link :to="{name:'Client',params:{id:client.id}}"
                             class="btn btn-info">Back
                </router-link>
                <button @click="update" class="btn btn-success">Update</button>
            </CCardFooter>
        </CCard>
        <CCard v-else>
            <CCardBody class="text-center">Loading...</CCardBody>
        </CCard>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "../endpoints"
import NewClientForm from "../partials/NewClientForm";

export default {
    name: "ClientEdit",
    components: {NewClientForm},
    data() {
        return {
            client: null
        }
    },
    created() {
        client.get(endpoints.show(this.$route.params.id))
            .then(({data}) => this.client = data)
    },
    methods: {
        update() {
            client.put(endpoints.show(this.client.id), this.client)
                .then(({data}) => this.client = data)
                .then(() => this.$toasted.success('Client info updated'))
        }
    }

}
</script>

<style scoped>

</style>
