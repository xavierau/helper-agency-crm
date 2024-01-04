<template>
    <div class="EditCommonContent">
        <CCard v-if="content">
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Edit Common Content: {{ content.key }}</h5>
            </CCardHeader>
            <CCardBody>

                <form class="form" @submit.prevent="submit">
                    <div class="form-group">
                        <input name="content"
                               class="form-control form-control-sm"
                               v-model="content.content"/>
                    </div>
                    <button type="submit"
                            class="btn btn-sm btn-success">Update
                    </button>
                </form>
            </CCardBody>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Cms/endpoints"
import client from "@/client"


export default {
    name: "EditCommonContent",
    data() {
        return {
            content: null
        }
    },

    created() {
        client.get(endpoints.common_content(this.$route.params.key))
            .then(({data}) => this.content = data)
    },

    methods: {
        submit() {
            client.put(endpoints.update_common_content(this.$route.params.key), this.content)
                .then(() => this.$toasted.success('Content Updated'))
                .then(error => this.$toasted.error(error.message))
        }
    }
}
</script>

<style scoped>
.EditCommonContent .card {
    margin-bottom: 0;
}

</style>
