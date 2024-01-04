<template>
    <div class="PageContent">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Edit Page Content</h5>
            </CCardHeader>
            <CCardBody v-if="page">
                <CCard v-for="key in keys" :key="key">
                    <CCardHeader @click.prevent="selectCard(key)">{{ key }}
                    </CCardHeader>
                    <CCardBody v-show="isSelectedCard(key)">
                        <form class="form" @submit.prevent="updateContent($event, key)">
                            <CTabs variant="pills" :active-tab="0">
                                <CTab title="English" class="mb-1">
                                    <div class="form-group">
                                        <input name="en_content"
                                               class="form-control form-control-sm"
                                               :value="getContentValue(key, 'en')"/>
                                    </div>


                                </CTab>
                                <CTab title="中文">
                                    <div class="form-group">
                                        <input name="zh_content"
                                               class="form-control form-control-sm"
                                               :value="getContentValue(key, 'zh')"/>
                                    </div>
                                </CTab>
                            </CTabs>
                            <button type="submit"
                                    class="btn btn-sm btn-success">Update
                            </button>
                        </form>
                    </CCardBody>
                </CCard>
            </CCardBody>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Cms/endpoints"
import client from "@/client"


export default {
    name: "PageContent",
    data() {
        return {
            selectedCard: null,
            page: null
        }
    },
    computed: {
        keys() {
            return this.page ? this.page.contents.reduce((carry, i) => {
                    if (carry.indexOf(i.key) === -1) {
                        carry.push(i.key)
                    }
                    return carry
                }, []) :
                []
        }
    },

    created() {
        client.get(endpoints.get_page_content(this.$route.params.id))
            .then(({data}) => this.page = data)
    },

    methods: {
        updateContent(e, key) {

            const data = {
                zh_content: e.target.zh_content.value,
                en_content: e.target.en_content.value,
            }
            console.log(data)

            client.put(endpoints.update_page_content(this.$route.params.id, key), data)
                .then(() => this.$toasted.success('Content Updated'))
                .then(error => this.$toasted.error(error.message))

        },
        getContentValue(key, language) {
            const content = this.page.contents.find(i => i.key === key && i.language === language)
            if (content) {
                return content.content
            }
            return null
        },
        selectCard(key) {
            console.log('trigger')
            if (this.selectedCard === key) {
                this.selectedCard = null
            } else {
                this.selectedCard = key
            }
        },
        isSelectedCard(key) {
            return this.selectedCard === key
        },
        submit() {
            client.get(endpoints.get_page_content(this.$route.params.id))
                .then(({data}) => this.$router.push({name: 'Contract', params: {id: data.contract_id}}))
                .then(() => this.$toasted.success('New Invoice Created'))
                .catch(error => this.$toasted.error('Something wrong, ' + error.message))
        }
    }
}
</script>

<style scoped>
.PageContent .card {
    margin-bottom: 0;
}

</style>
