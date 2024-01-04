<template>
    <div class="my-1">
        <button @click="confirm" v-if="isAdd && !inTempContainer" class="btn btn-success btn-sm"><i
            class="fa fa-check"></i></button>
        <button @click="confirm" v-else class="btn btn-warning btn-sm"><i
            class="fa fa-minus"></i></button>
        <div class="d-inline-block ml-1" @click.prevent="emitShowApplicant">
            <div class="d-inline-block" style="vertical-align: top">
                <img class="rounded"
                     :src="applicant.thumbnail"
                     alt="">
            </div>
            <div class="d-inline-block">
                <p class="mt-1 pl-3">
                    Name: {{ applicant.name }} <br>
                    Nationality: {{ applicant.nationality }} <br>
                    Gender: {{ applicant.gender | capitalize }} <br>
                    Age: {{ applicant.age }} <br>
                    <small v-if="showTimestamp">({{
                            applicant.pivot.channel | capitalize
                        }}) ({{ applicant.pivot.created_at | formatDate('D/MM/Y HH:mm') }})</small>

                </p>


            </div>

        </div>
        <button @click="createContract" v-if="showCreateContract"
                class="btn btn-sm btn-success float-right"><i
            class="far fa-file-alt"></i></button>
    </div>
</template>

<script>

import {capitalize, formatDate} from "@/filters/common"
import NotificationCenter from "@/NotificationCenter"
import EventNames from "@/modules/Job/EventName"

export default {
    name: "MatchingApplicantListItem",
    props: {
        applicant: {
            type: Object,
            required: true
        },
        isAdd: {
            type: Boolean,
            default: true
        },
        inTempContainer: {
            type: Boolean,
            default: false
        },
        showTimestamp: {
            type: Boolean,
            default: false
        },
        showCreateContract: {
            type: Boolean,
            default: false
        }
    },
    filters: {formatDate, capitalize},
    methods: {
        emitShowApplicant() {
            this.$emit('showApplicant', this.applicant)
        },
        confirm() {
            this.$emit('selectApplicant', this.applicant)
        },
        createContract() {
            NotificationCenter.$emit(EventNames.CreateContract, this.applicant)
        }

    }
}
</script>

<style scoped>
span {
    cursor: pointer;
}

</style>

