<template>
    <div class="ShowExperience">
        <TabContentHeader title="Applicant Experience">
            <router-link :to="{name:RouteName.AddApplicantExperience, params:{id:$route.params.id}}"
                         class="btn btn-sm btn-outline-dark"><i class="fa fa-plus"></i> Add
            </router-link>
        </TabContentHeader>

        <section v-for="experience in experiences" :key="experience.id">
            <div class="d-flex justify-content-between align-baseline">

                <h5>{{ experience.position }} ({{
                        experience.from | formatDate('Y')
                    }} - {{ experience.to | formatDate('Y') }})</h5>

                <router-link :to="{name:'Edit Applicant Experience', params:{id:experience.id}}"
                             class="btn btn-sm btn-outline-dark"><i class="fa fa-edit"></i> Edit
                </router-link>

            </div>

            <table class="table">
                <tbody>
                <tr>
                    <td>Location</td>
                    <td>{{ experience.location }}</td>
                </tr>
                <tr>
                    <td>House Size</td>
                    <td>{{ experience.house_size }}</td>
                </tr>
                <tr>
                    <td>Number of adult</td>
                    <td>{{ experience.number_of_adult }}</td>
                </tr>
                <tr>
                    <td>Age of adult</td>
                    <td>{{ experience.age_of_adult }}</td>
                </tr>
                <tr>
                    <td>Number of children</td>
                    <td>{{ experience.number_of_children }}</td>
                </tr>
                <tr>
                    <td>Age of children</td>
                    <td>{{ experience.age_of_children }}</td>
                </tr>
                <tr>
                    <td>Number of elderly</td>
                    <td>{{ experience.number_of_elderly }}</td>
                </tr>
                <tr>
                    <td>Age of elderly</td>
                    <td>{{ experience.age_of_elderly }}</td>
                </tr>
                <tr>
                    <td>Duties</td>
                    <td>
                        <span class="badge badge-primary p-2 m-1"
                              v-for="duty in experience.duties"
                              :key="duty.id"
                        > {{ duty.label }}</span>
                    </td>
                </tr>
                <tr>
                    <td>Note</td>
                    <td>
                        {{ experience.description }}
                    </td>
                </tr>
                </tbody>
            </table>
        </section>

    </div>
</template>

<script>
import {formatDate} from "@/filters/common"
import TabContentHeader from "@/components/Base/TabContentHeader.vue";
import {RouteName} from "@/modules/Applicant/route";

export default {
    name: "ShowExperience",
    computed: {
        RouteName() {
            return RouteName
        }
    },
    components: {
        TabContentHeader
    },
    props: {
        experiences: {
            type: Array,
            required: true
        }
    },
    filters: {formatDate},
    methods: {
        getDuties(experience) {
            return experience.duties?.map()
        }
    }
}
</script>

<style scoped>

</style>
