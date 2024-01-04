<template>
    <div class="ApplicantShow">
        <CCard v-if="isLoading === false">
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">{{ applicant.name }}
                    <span class="badge"
                          :class="{'badge-male':applicant.gender==='male',
                                                       'badge-female':applicant.gender==='female'}">
                             {{ applicant.gender }} </span>
                </h5>
                <div class="float-right text-right">
                    <a :href='`/core/applicants/profile/${applicant.hash}`'
                       target="_blank"
                       class="btn btn-success btn-sm mx-1 text-white">Print Profile
                    </a>
                    <button v-if="applicant.is_approved === false"
                            @click="approveApplicant"
                            class="btn btn-success btn-sm mx-1">Approve
                    </button>

                    <button @click="onPickFile('thumbnail')" class="btn btn-info btn-sm mx-1">Upload Thumbnail Photo
                    </button>
                    <button @click="onPickFile('full_body')" class="btn btn-info btn-sm mx-1">Upload Full Body Photo
                    </button>
                    <button class="btn btn-success btn-sm d-inline-block"
                            @click="show_upload_documents = true">Uploaded Document
                    </button>
                    <form ref="imageForm" enctype="multipart/form-data">
                        <input
                            type="file"
                            name="file"
                            style="display: none"
                            ref="fileInput"
                            accept="image/*"
                            @change="onFilePicked"/>
                    </form>
                </div>
            </CCardHeader>
            <CCardBody>
                <section class="basic-info">
                    <div class="row">
                        <div class="col-sm-4 col-md-3 col-lg-2 ">
                            <img class="img-fluid rounded"
                                 :src="applicant.thumbnail"/>
                        </div>
                        <div class="col-sm-8 col-md-9 col-lg-10">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>
                                        {{ applicant.age }} yrs, {{ applicant.nationality }}
                                    </h5>
                                    <h5>Available Date: {{ applicant.available_date }}</h5>
                                </div>
                                <div>
                                    <router-link
                                        :to="{name:RouteName.EditApplicantPersonalInfo, params:{id:applicant.id}}"
                                        class="btn btn-sm btn-outline-dark">Edit Personal Info
                                    </router-link>
                                </div>

                            </div>

                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Height</td>
                                    <td>{{ applicant.height }}cm</td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td>{{ applicant.weight }}kg</td>
                                </tr>
                                <tr>
                                    <td>Job experiences</td>
                                    <td>
                                         <span v-for="duty in applicantExperienceDuties" :key="duty"
                                               class="badge-primary badge p-1 m-1">{{
                                                 duty
                                             }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <CTabs variant="pills" :active-tab="0">
                    <CTab title="Basic Info" class="mt-3">
                        <show-basic-info :applicant="applicant"/>
                    </CTab>
                    <CTab title="Contract" class="mt-3">
                        <show-contracts :contracts="applicant.contracts"/>
                    </CTab>
                    <CTab title="Working Experience" class="mt-3">
                        <show-experience :experiences="applicant.experiences || []"></show-experience>
                    </CTab>
                </CTabs>
            </CCardBody>
        </CCard>
        <CCard v-else>
            <CCardBody>Loading...</CCardBody>
        </CCard>

        <CModal :show.sync="show_upload_documents"
                title="Uploaded Documents"
                size="lg">
            <ApplicantUploadedDocuments
                :applicant-id="parseInt($route.params.id)"/>
            <template #footer>
                <div></div>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Applicant/endpoints"
import client from "@/client"
import ShowBasicInfo from "./partials/ShowBasicInfo"
import ShowExperience from "./partials/ShowExperience"
import ShowContracts from "./partials/ShowContracts"
import ApplicantUploadedDocuments from "./partials/ApplicantUploadedDocuments"
import {RouteName} from "@/modules/Applicant/route";
import _ from "lodash"

export default {
    name: "ShowApplicant",
    computed: {
        RouteName() {
            return RouteName
        },
        applicantExperienceDuties() {
            return _.uniq(this.applicant.experiences?.map(experience => experience.duties.map(d => d.label)).flat())
        }
    },
    components: {
        ShowContracts,
        ShowBasicInfo,
        ShowExperience,
        ApplicantUploadedDocuments
    },
    data() {
        return {
            isLoading: true,
            applicant: null,
            imageCollection: null,
            show_upload_documents: false
        }
    },
    created() {
        this.fetchApplicant()
    },
    methods: {
        fetchApplicant() {
            client.get(endpoints.show(this.$route.params.id))
                .then(({data}) => this.applicant = data)
                .catch(error => console.error(error))
                .finally(() => this.isLoading = false)

        },
        onPickFile(collection) {
            this.imageCollection = collection
            this.$refs.fileInput.click()
        },
        getApiEndpoint: function (collection) {
            return collection === 'thumbnail' ?
                endpoints.upload_thumbnail(this.applicant.id) :
                endpoints.upload_full_body(this.applicant.id);
        },
        onFilePicked() {
            let url = this.getApiEndpoint(this.imageCollection),
                formData = new FormData(this.$refs.imageForm)

            this.$toasted.info("File uploading...")

            client.post(url, formData)
                .then(({data}) => this.applicant.thumbnail = data)
                .then(() => this.$toasted.success('File upload completed'))
                .catch(err => {
                    this.$toasted.error("Something wrong. Try again later")
                    console.error(err.message, err)
                })
                .finally(() => {
                    this.imageCollection = null
                })


        },
        approveApplicant() {
            client.post(endpoints.approve(this.applicant.id))
                .then(({data}) => this.applicant = data)
                .then(() => this.$toasted.success('Applicant being approved'))
                .catch(error => this.$toasted.error(error.response.message))
        }
    }
}
</script>

<style scoped lang="scss">

.ApplicantShow {
    .badge-male {
        background-color: blue;
        color: white
    }

    .badge-female {
        background-color: pink;
        color: white
    }
}

</style>
