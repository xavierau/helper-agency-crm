<template>
    <div>
        <CForm inline @submit.prevent="search">
            <CInput
                class="mr-sm-2"
                placeholder="Search"
                size="sm"
                v-model="keyword"
            />
            <CButton
                color="secondary"
                size="sm"
                class="my-2 my-sm-0"
                type="submit"
            >
                Search
            </CButton>
        </CForm>
        <CModal :show.sync="show"
                size="lg"
                title="Search Result">
            <p class="text-center" v-if="loading">Loading...</p>
            <div v-else>
                <span v-if="results.length ===0">No result found</span>
                <div v-else>
                    <router-link class="d-block mb-1"
                                 @click.native="show=false"
                                 :to="getLink(item)"
                                 v-for="item in results"
                                 :key="`${item.type}_${item.entity_id}`">{{ item.label }}
                        <span class="badge p-1"
                              :class="showBadgeClass(item)">{{
                                showBadge(item)
                            }}</span>
                    </router-link>
                </div>

            </div>

            <template #footer>
                <button class="btn btn-secondary" @click="show=false">Close</button>
            </template>

        </CModal>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "@/endpoints";

export default {
    name: "GlobalSearch",
    data() {
        return {
            keyword: null,
            show: false,
            loading: false,
            results: []
        }
    },
    methods: {
        search() {
            this.loading = true
            this.results = []
            client.get(endpoints.search, {params: {keyword: this.keyword}})
                .then(({data}) => this.results = data)
                .then(() => this.loading = false)
                .catch(error => console.log(error.response.messsage))
            this.show = true


        },
        showBadge(item) {
            switch (item.type) {
                case 'Contract':
                    return 'Contract'
                case 'Applicant':
                    return 'Applicant'
                case 'Client':
                    return 'Client'
            }
        },
        showBadgeClass(item) {
            switch (item.type) {
                case 'Contract':
                    return 'badge-success'
                case 'Applicant':
                    return 'badge-primary'
                case 'Client':
                    return 'badge-info'
            }
        },
        getLink(item) {
            switch (item.type) {
                case 'Contract':
                    return {name: 'Contract', params: {id: item.entity_id}}
                case 'Applicant':
                    return {name: 'Applicant', params: {id: item.entity_id}}
                case 'Client':
                    return {name: 'Client', params: {id: item.entity_id}}
            }
        }
    }
}
</script>

<style scoped>

</style>
