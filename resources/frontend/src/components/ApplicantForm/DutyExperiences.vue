<template>
    <div class="form-group" :class="size">
        <label>Duty Experiences</label>
        <v-select :options="duties"
                  :value="value"
                  label="label"
                  :reduce="i=>i.id"
                  @input="onChange"
                  multiple>
            <template v-slot:option="option">
                <div class="py-1 px-2 rounded"
                     :class="{'bg-light':isSelected(option.id)}">
                    {{ option.label }}
                </div>
            </template>
        </v-select>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "@/modules/Applicant/endpoints";
import vSelect from "vue-select";

export default {
    name: "DutyExperiences",
    components: {
        vSelect
    },
    props: {
        name: {
            type: String,
            default: 'available_date'
        },
        value: {
            type: Array,
            default: () => []
        },
        size: {
            type: String,
            default: 'col-12 col-md-6'
        }
    },
    data() {
        return {
            duties: []
        }
    },
    created() {
        this.fetchDuties()
    },
    methods: {
        fetchDuties() {
            client.get(endpoints.duties)
                .then(({data}) => this.duties = data)
                .catch(error => console.log(error))
        },
        isSelected(duty) {
            return this.value.indexOf(duty.id) > -1
        },
        onChange(id) {
            if (!this.isSelected(id)) {
                this.$emit('input', id)
            }

        }
    }
}
</script>

<style scoped>

</style>
