<template>
    <div class="MatchingApplicant">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h5 class="d-inline-block mr-3 mb-0">Applicant Filters</h5>
                    <button @click="showFilters = !showFilters" class="btn btn-info btn-sm">
                        <i class="fas"
                           :class="{'fa-angle-down':showFilters,'fa-angle-up':!showFilters}"></i>
                    </button>
                </div>

                <CCollapse :show="showFilters">
                    <CCard class="mt-3" body-wrapper>
                        <div class="row">
                            <div class="form-group col-6 col-sm-4 col-md-3">
                                <input class="form-control" placeholder="Minimum age"
                                       v-model="filters.min_age"/>
                            </div>
                            <div class="form-group col-6 col-sm-4 col-md-3">
                                <input class="form-control" placeholder="Minimum max"
                                       v-model="filters.max_age"/>
                            </div>
                            <div class="form-group col-6 col-sm-4 col-md-3">
                                <select class="form-control"
                                        v-model="filters.nationality">
                                    <option :value="null">Select Nationality</option>
                                    <option v-for="nationality in nationalities"
                                            :key="nationality.id"
                                            :value="nationality.label">{{ nationality.label }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-6 col-sm-4 col-md-3">
                                <select class="form-control"
                                        placeholder="Gender"
                                        v-model="filters.gender">
                                    <option :value="null">Select Gender</option>
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                </select>
                            </div>

                            <div class="col-4 col-sm-3 col-md-2" v-for="duty in duties"
                                 :key="duty.id">
                                <label>
                                    <input class="mr-1" type="checkbox" :value="duty.id"
                                           v-model="filters.duties">
                                    {{ duty.label }}
                                </label>
                            </div>
                        </div>
                        <button @click="fetchPotentialApplicants()"
                                class="btn btn-info">Filter
                        </button>
                        <button class="btn btn-secondary ml-3">Reset</button>
                    </CCard>
                </CCollapse>
            </div>
        </div>

        <div class=" mt-3 row d-flex">
            <div class="col-md-6 align-self-stretch applicant-list">
                <matching-applicant-list title="Potential Applicants"
                                         :job="job"
                                         v-if="potentialApplicants"
                                         :applicants="potentialApplicants"
                                         :temp-container="tempContainer"
                                         @search="fetchPotentialApplicants"
                                         @selectApplicant="addApplicantToTemp"
                                         @showApplicant="triggerShowApplicant"/>
            </div>
            <div class="col-md-6 align-self-stretch  applicant-list">
                <matching-applicant-list :job="job"
                                         title="Sent Applicant"
                                         show-timestamp
                                         :applicants="filteredAssignedApplicants"
                                         :is-add="false"
                                         show-create-contract
                                         @search="filterAssignedApplicants"
                                         @selectApplicant="removeApplicant"
                                         @showApplicant="triggerShowApplicant"/>
            </div>
            <CModal title="Applicant Detail"
                    size="lg"
                    :show.sync="showApplicantModal">
                <applicant-detail v-if="showApplicant" :applicant="showApplicant"/>
                <template #footer>
                    <button @click="showApplicantModal=false"
                            class="btn btn-secondary btn-sm">Close
                    </button>
                </template>
            </CModal>
        </div>
        <div class="send-container">
            <CCollapse :show="showSendOptions">
                <ul class="list-unstyled">
                    <li class="mb-1">
                        <button @click="sendApplicant('email')"
                                class="btn btn-info"><i class="far fa-envelope"></i></button>
                    </li>
                    <li class="mb-1"><a :href="whatsappContent"
                                        target="_blank"
                                        @click="sendApplicant('whatsapp')"
                                        class="btn btn-success"><i
                        class="fab fa-whatsapp"></i></a></li>
                </ul>
            </CCollapse>
            <CButton @click="showSendOptions = !showSendOptions"
                     transition="bounce"
                     id="applicantTempContainer"
                     v-text="`${tempContainer.length}`">
            </CButton>
        </div>
    </div>
</template>

<script>
import MatchingApplicantList from "@/modules/Job/partials/MatchingApplicantList"
import ApplicantDetail from "@/modules/Job/partials/ApplicantDetail"
import endpoints from "@/modules/Job/endpoints"
import client from "@/client"
import _ from 'lodash'
import 'tippy.js/dist/tippy.css';

import NotificationCenter from "@/NotificationCenter"
import EventNames from "@/modules/Job/EventName"

export default {
    name: "MatchingApplicant",
    props: {
        job: {
            type: Object,
            required: true
        }
    },
    components: {
        MatchingApplicantList,
        ApplicantDetail
    },
    data() {
        return {
            showSendOptions: false,
            showFilters: false,
            showApplicantModal: false,
            showApplicant: null,
            tempContainer: [],
            search: null,
            nationalities: null,
            potentialApplicantPaginator: null,
            assignedApplicants: null,
            filter: null,
            duties: null,
            filters: {
                duties: [],
                min_age: null,
                max_age: null,
                gender: null,
                nationality: null,
            },
        }
    },
    computed: {
        potentialApplicants() {
            return this.potentialApplicantPaginator ? this.potentialApplicantPaginator.data : []
        },
        filteredAssignedApplicants() {
            if (this.assignedApplicants === null) {
                return []
            }
            return this.filter === null ? this.assignedApplicants : _.filter(this.assignedApplicants, a => a.name.indexOf(this.filter) > -1)
        },
        whatsappContent() {
            //return `https://wa.me/85297408847/?text=testing message\n http://google.com`

            if (this.tempContainer.length === 0) {
                return
            }
            let links = this.tempContainer.map(a => {
                return {hash: a.hash, name: a.name}
            })
                .map(o => `${o.name} ${window.location.origin}/core/applicants/profile/${o.hash}`)


            let urlencoded = (links.join(', '))
            return `https://wa.me/85266281556/?text=we suggest the following applicants: ${urlencoded}`
        }
    },
    created() {
        this.fetchDuties()
        this.fetchNationalities()
        this.fetchAllAssignedApplicants()
            .then(() => this.fetchPotentialApplicants())

        NotificationCenter.$on(EventNames.CreateContract, this.createContract)
    },
    methods: {
        fetchNationalities() {
            client.get(endpoints.nationalities)
                .then(({data}) => this.nationalities = data)
                .catch(error => this.$toasted.error(error.message))
        },

        fetchDuties() {
            client.get(endpoints.duties)
                .then(({data}) => this.duties = data)
                .catch(error => this.$toasted.error(error.message))
        },
        fetchPotentialApplicants(search = null) {
            const ids = this.assignedApplicants.map(a => a.id).join(',')
            let query = {
                'filter[search]': _.isObject(search) ? null : search,
                'filter[exclude_ids]': ids,
                'filter[available]': true,
                'include': 'duties,experiences,contracts',
                pageSize: 15
            }

            if (this.filters.max_age && this.filters.min_age) {
                query['filter[between_age]'] = `${this.filters.min_age},${this.filters.max_age}`
            } else if (this.filters.max_age) {
                query['filter[max_age]'] = `${this.filters.max_age}`
            } else if (this.filters.min_age) {
                query['filter[min_age]'] = `${this.filters.min_age}`
            }

            if (this.filters.duties.length > 0) {
                query['filter[duties]'] = this.filters.duties.join(',')
            }
            if (this.filters.nationality) {
                query['filter[nationality]'] = this.filters.nationality
            }
            if (this.filters.gender) {
                query['filter[gender]'] = this.filters.gender
            }

            return client.get(endpoints.potential_applicants, {
                params: query
            })
                .then(({data}) => this.potentialApplicantPaginator = data)
                .catch(error => console.log(error))
        },
        fetchAllAssignedApplicants() {
            return client.get(endpoints.all_assigned_applicants(this.job.id))
                .then(({data}) => this.assignedApplicants = data)
                .catch(error => console.log(error))
        },
        filterAssignedApplicants(search) {
            this.filter = search
        },
        addApplicantToTemp(applicant) {

            let index = _.findIndex(this.tempContainer, {id: applicant.id})
            if (index > -1) {
                this.splice = this.tempContainer.splice(index, 1)
            } else {
                this.tempContainer.push(applicant)
            }

        },
        addApplicant(applicant) {
            client.post(endpoints.assign_applicant(this.job.id), applicant)
                .then(() => this.fetchAllAssignedApplicants().then(() => this.fetchPotentialApplicants()))
                .catch(error => this.$toasted.error("Something wrong! Try again later! " + error.message))
        },
        removeApplicant(applicant) {
            client.delete(endpoints.remove_applicant(this.job.id, applicant.id))
                .then(() => this.fetchAllAssignedApplicants().then(() => this.fetchPotentialApplicants()))
                .catch(error => this.$toasted.error("Something wrong! Try again later! " + error.message))
        },
        triggerShowApplicant(applicant) {
            this.showApplicant = applicant
            this.showApplicantModal = true

        },
        sendToClient() {
            this.$toasted.info('sending email to client...')
            client.post(endpoints.email_applicant(this.job.id), {
                id: this.tempContainer.map(i => i.id),
                channel: 'email'
            })
                .then(() => this.fetchAllAssignedApplicants().then(() => this.fetchPotentialApplicants()))
                .then(() => this.$toasted.success('email sent'))
                .then(() => this.tempContainer = [])
                .then(() => this.showSendOptions = false)
                .catch(error => this.$toasted.error(error.message))
        },
        sendWhatsappClient() {

            let requests = this.tempContainer.map(a => client.post(endpoints.assign_applicant(this.job.id), {
                applicant_id: a.id,
                channel: 'whatsapp',
            }))
            client.all(requests).then(() => {
                this.fetchAllAssignedApplicants().then(() => this.fetchPotentialApplicants())
                this.tempContainer = []
                this.$toasted.success('Applicant added')
                this.showSendOptions = false
            })
                .catch(error => this.$toasted.error("Something wrong! Try again later! " + error.message))
        },
        sendApplicant(channel) {
            if (this.tempContainer.length === 0) {
                this.$toasted.info('No applicant selected!')
            } else {
                switch (channel) {
                    case 'email':
                        this.sendToClient()
                        break;
                    case 'whatsapp':
                        this.sendWhatsappClient()
                        break;
                    default:
                        this.$toasted.error('Invalid channel');
                }
            }
        },
        createContract(applicant) {
            this.$router.push({
                name: 'Create Invoice',
                query: {
                    job_id: this.job.id,
                    client_id: this.job.client_id,
                    client_number: this.job.client.client_number,
                    applicant_id: applicant.id,
                    applicant_ref_number: applicant.ref_number
                }
            })
        }
    }
}
</script>

<style scoped>

.applicant-list {
    height: 750px;
    overflow: scroll
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}

.send-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
}

.send-container li button {
    width: 40px;
    height: 40px;
    border-radius: 20px;
}

#applicantTempContainer {
    width: 50px;
    height: 50px;
    text-align: center;
    border-radius: 25px;
    background-color: yellow;
    box-shadow: 5px 5px 5px grey;
}


.bounce-enter {
    animation: bounce-in .5s;
}

.bounce-leave {
    animation: bounce-out .5s;
}

@keyframes bounce {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.5);
    }
    100% {
        transform: scale(1);
    }
}

</style>

