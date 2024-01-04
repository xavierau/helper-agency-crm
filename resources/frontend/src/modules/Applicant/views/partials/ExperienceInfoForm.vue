<template>
    <section class="BasicInform row">
        <div class="col-12">
            <h4>
                Working Experience Record
                <button @click="$emit('add-experience',getExperienceObject())"
                        type="button"
                        class="btn btn-success btn-sm">Add Experience Record
                </button>
            </h4>
            <fieldset class="col-12" v-for="(exp, index) in formData"
                      :key="exp.uuid">
                <legend>Working Experience {{ index + 1 }}
                    <button @click="$emit('remove-experience',exp.uuid)"
                            type="button"
                            class="btn btn-sm btn-danger">
                        <i class="fa fa-minus"></i>
                    </button>
                </legend>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Location</label>
                        <SelectCountry :form-data="exp" form-data-key="location" required/>
                    </div>
                    <Position v-model="exp.position"/>

                    <FromDate v-model="exp.from"/>
                    <ToDate v-model="exp.from"/>

                    <CompletionStatus v-model="exp.status"/>
                    <HouseSize v-model.number="exp.house_size"/>

                    <NumberOfAdult v-model.number="exp.number_of_adult"/>
                    <AgeOfAdults v-model="exp.age_of_adult"/>

                    <NumberOfChildren v-model.number="exp.number_of_children"/>
                    <AgeOfChildren v-model="exp.age_of_children"/>

                    <NumberOfElderly v-model.number="exp.number_of_elderly"/>
                    <AgeOfElderly v-model="exp.age_of_elderly"/>

                    <Description v-model="exp.description"/>
                    <DutyExperiences size="col-12" v-model="exp.duties"/>
                </div>
            </fieldset>
        </div>
    </section>
</template>

<script>
import {v4 as uuid} from "uuid"
import SelectCountry from "@/components/Base/SelectCountry";
import Position from "@/components/ExperienceForm/Position.vue";
import FromDate from "@/components/ExperienceForm/FromDate.vue";
import ToDate from "@/components/ExperienceForm/ToDate.vue";
import CompletionStatus from "@/components/ExperienceForm/CompletionStatus.vue";
import HouseSize from "@/components/ExperienceForm/HouseSize.vue";
import NumberOfAdult from "@/components/ExperienceForm/NumberOfAdult.vue";
import AgeOfAdults from "@/components/ExperienceForm/AgeOfAdults.vue";
import NumberOfChildren from "@/components/ExperienceForm/NumberOfChildren.vue";
import AgeOfChildren from "@/components/ExperienceForm/AgeOfChildren.vue";
import NumberOfElderly from "@/components/ExperienceForm/NumberOfElderly.vue";
import AgeOfElderly from "@/components/ExperienceForm/AgeOfElderly.vue";
import Description from "@/components/ExperienceForm/Description.vue";
import DutyExperiences from "@/components/ApplicantForm/DutyExperiences.vue";

export default {
    name: "ExperienceInfoForm",
    components: {
        DutyExperiences,
        Description,
        SelectCountry,
        Position,
        FromDate,
        ToDate,
        CompletionStatus,
        HouseSize,
        NumberOfAdult,
        AgeOfAdults,
        NumberOfChildren,
        AgeOfChildren,
        NumberOfElderly,
        AgeOfElderly,
    },
    props: {
        formData: {
            type: Array,
        }
    },
    data() {
        return {
            duties: []
        }
    },
    created() {
        this.formData?.push(this.getExperienceObject())
    },
    methods: {
        getExperienceObject() {
            return {
                uuid: uuid(),
                location: null,
                from: null,
                to: null,
                position: null,
                house_size: null,
                number_of_adult: null,
                age_of_adult: null,
                number_of_children: null,
                age_of_children: null,
                number_of_elderly: null,
                age_of_elderly: null,
                duties: [],
                status: 'finished'
            }
        },
    }
}
</script>

<style scoped>

fieldset {
    border: 1px solid navy;
    border-radius: 5px
}
</style>
