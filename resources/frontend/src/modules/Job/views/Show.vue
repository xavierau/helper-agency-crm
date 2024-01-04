<template>
    <div class="showJob">
        <CCard>
            <CCardHeader class="d-flex justify-content-between">
                <h4>Job Detail</h4>
            </CCardHeader>
            <CCardBody v-if="job">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Client</td>
                        <td>
                            <router-link
                                :to="{name:'Client',params:{id:job.client.id}}">
                                {{ job.client.full_name }}
                            </router-link>
                        </td>
                    </tr>
                    <tr>
                        <td>Service require</td>
                        <td v-text="job.service_type === 'people'? 'Find People':'Others'">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <section class="basic-requirements">
                    <div class="row d-flex align-content-stretch flex-wrap">
                        <div class="col-7">
                            <RequirementInfo :url="updateRequirementUrl"
                                             :requirement="job.requirement"
                                             @update-requirement="updateRequirement"/>
                        </div>
                        <div class="col-5">
                            <CommentsContainer :url="jobCommentUrl"/>
                        </div>
                    </div>
                </section>
                <section class="tabs">
                    <CTabs class="col-12" variant="pills" :active-tab="0">
                        <CTab class="mt-2" v-if="job.service_type === 'people'" title="People">
                            <matching-applicant :job="job"/>
                        </CTab>
                        <CTab class="mt-2" title="Contacts">
                            Other contacts
                        </CTab>
                    </CTabs>
                </section>
            </CCardBody>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Job/endpoints"
import client from "@/client"
import MatchingApplicant from "@/modules/Job/partials/MatchingApplicant"
import {join} from "@/filters/common"
import RequirementInfo from "@/components/Requirement"
import CommentsContainer from "@/components/CommentsContainer";

export default {
    name: "ShowJob",
    components: {
        MatchingApplicant,
        RequirementInfo,
        CommentsContainer
    },
    filters: {join},
    data() {
        return {
            job: null
        }
    },
    computed: {
        updateRequirementUrl() {
            return endpoints.update_requirement(this.job.id)
        },
        jobCommentUrl() {
            return endpoints.comments(this.$route.params.id)
        }
    },
    created() {
        client.get(endpoints.show(this.$route.params.id))
            .then(({data}) => this.job = data)
            .catch(error => console.log(error))
    },
    methods:{
        updateRequirement(payload){
            this.job.requirement = payload

        }
    }

}
</script>

<style scoped>

</style>
