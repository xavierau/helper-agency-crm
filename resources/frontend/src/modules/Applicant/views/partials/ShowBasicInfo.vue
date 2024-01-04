<template>
    <div class="ShowApplicantBasicInfo">
        <TabContentHeader title="Basic Info"
                          :link="{label:'Edit', route:{
                              name:RouteName.EditApplicantBasicInfo,
                              params:{id:this.applicant.id}
                          }}"/>

        <table class="table">
            <tbody>
            <tr>
                <td>Date of Birth</td>
                <td>{{ applicant.date_of_birth | formatDate('D/M/Y') }}</td>
            </tr>
            <tr>
                <td>Marital Status</td>
                <td>{{ applicant.marital_status }}</td>
            </tr>
            <tr>
                <td>Education</td>
                <td>
                    <table class="w-100">
                        <tr>
                            <td>Highest Education</td>
                            <td>{{ applicant.education.school_name }}
                                <small>({{ applicant.education.highest_education }})</small></td>
                        </tr>
                        <tr>
                            <td>Graduation Year</td>
                            <td>{{ applicant.education.graduation_year }}</td>
                        </tr>
                        <tr>
                            <td>Major</td>
                            <td>{{ applicant.education.major }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {formatDate} from "@/filters/common"
import TabContentHeader from "@/components/Base/TabContentHeader.vue";
import {RouteName} from "@/modules/Applicant/route";

export default {
    name: "ShowBasicInfo",
    computed: {
        RouteName() {
            return RouteName
        }
    },
    components: {
        TabContentHeader
    },
    filters: {
        formatDate
    },
    props: {
        applicant: {
            type: Object,
            required: true
        }
    }
}
</script>
