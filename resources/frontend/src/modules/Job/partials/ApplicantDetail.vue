<template>
    <CCard>
        <CCardHeader class="d-flex justify-content-between align-content-center">
            <h5 class="m-0">Applicant Profile </h5>
        </CCardHeader>
        <CCardBody>
            <section class="basic-info">
                <div class="row">
                    <div class="col-sm-4 col-md-3 col-lg-2 ">
                        <img class="img-fluid rounded"
                             :src="applicant.thumbnail"/>
                    </div>
                    <div class="col-sm-8 col-md-9 col-lg-10">
                        <h4>{{ applicant.name }}
                            <span class="badge ml-3"
                                  :class="{'badge-male':applicant.gender==='male',
                                                       'badge-female':applicant.gender==='female'}">
                             {{ applicant.gender }}</span>
                        </h4>
                        <h5>
                            {{ applicant.age }}, {{ applicant.nationality }}
                        </h5>
                        <h5>Available Date: {{ applicant.available_date }}</h5>
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
                                <td>Experience</td>
                                <td>
                                         <span class="badge badge-info p-1 m-1"
                                               v-for="duty in applicant.duties"
                                               :key="duty.id">{{ duty.label }}</span>
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
                <CTab title="Contracts" class="mt-3">
                    <show-contracts :contracts="applicant.contracts"/>
                </CTab>
                <CTab title="Working Experiences" class="mt-3">
                    <show-experience :experiences="applicant.experiences"></show-experience>
                </CTab>
            </CTabs>

        </CCardBody>
    </CCard>
</template>

<script>
import ShowBasicInfo from "@/modules/Applicant/views/partials/ShowBasicInfo.vue"
import ShowExperience from "@/modules/Applicant/views/partials/ShowExperience.vue"
import ShowContracts from "@/modules/Applicant/views/partials/ShowContracts.vue"

export default {
    name: "ApplicantDetail",
    props: {
        applicant: {
            type: Object,
            required: true
        }
    },
    components: {
        ShowBasicInfo,
        ShowExperience,
        ShowContracts
    },
}
</script>

<style scoped>

</style>
