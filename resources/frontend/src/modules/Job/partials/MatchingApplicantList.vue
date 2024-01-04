<template>
    <div class="mt-1">
        <h4>{{ title }}</h4>
        <div class="d-absolute" style="top:0">
            <input class="form-control"
                   @change="updateSearch"
                   v-model="search"
                   placeholder="search"/>
        </div>
        <ul class="list-unstyled">
            <li v-for="applicant in applicants" :key="applicant.id">
                <matching-applicant-list-item :applicant="applicant"
                                              :is-add="isAdd"
                                              :show-timestamp="showTimestamp"
                                              :in-temp-container="isInTempContainer(applicant)"
                                              :show-create-contract="showCreateContract"
                                              @selectApplicant="selectApplicant"
                                              @showApplicant="showApplicant"/>
            </li>
        </ul>
    </div>
</template>

<script>
import MatchingApplicantListItem from "@/modules/Job/partials/MatchingApplicantListItem"
import _ from "lodash"

export default {
    name: "MatchingApplicantList",
    props: {
        tempContainer: {
            type: Array,
            default() {
                return []
            }
        },
        title: {
            type: String,
            required: true
        },
        isAdd: {
            type: Boolean,
            default: true
        },
        applicants: {
            type: Array,
            required: true
        },
        showTimestamp: {
            type: Boolean,
            required: false
        },
        showCreateContract: {
            type: Boolean,
            default: false
        }
    },
    components: {
        MatchingApplicantListItem
    },
    data() {
        return {
            search: null
        }
    },
    methods: {
        isInTempContainer(applicant) {
            return !!_.find(this.tempContainer, {id: applicant.id})
        },
        updateSearch() {
            this.$emit('search', this.search)
        },
        selectApplicant(applicant) {
            this.$emit('selectApplicant', applicant)
        },
        showApplicant(applicant) {
            this.$emit('showApplicant', applicant)
        }
    }
}
</script>

<style scoped>

</style>

