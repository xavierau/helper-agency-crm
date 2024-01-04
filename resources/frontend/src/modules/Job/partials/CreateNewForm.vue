<template>
    <CCard>
        <CCardBody>
            <form class="form" @submit.prevent="submit">
                <fieldset>
                    <legend>Basic Info</legend>
                    <div class="row">
                        <SimpleSelect label="Prefix"
                                      size="col-3 col-md-2"
                                      :options="prefixOptions"
                                      v-model="formData.prefix"
                        ></SimpleSelect>

                        <TextInput size="col-md-5"
                                   v-model="formData.first_name"
                                   label="First Name"/>

                        <TextInput size="col-md-5"
                                   v-model="formData.last_name"
                                   label="Last Name"/>

                        <TextInput label="Mobile Number" v-model="formData.mobile" required/>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Job Info</legend>
                    <div class="form-group">
                        <label>Request service</label>
                        <div class="row">
                            <div class="btn-group btn-group-toggle btn-group-justified col-12"
                                 data-toggle="buttons">
                                <label class="btn btn-outline-info"
                                       :class="{active:service.value === formData.service_type }"
                                       v-for="service in service_types"
                                       :key="service.value">
                                    <input type="radio" :value="service.value"
                                           v-model="formData.service_type"> {{ service.label }}
                                </label>
                            </div>
                        </div>

                    </div>

                    <people-job-order-form v-if="formData.service_type === 'people'"
                                           :form-data.sync="formData.people"
                                           @inputUpdated="updatePeopleInput"/>

                    <section v-if="formData.service_type === 'other'">

                        <div class="form-group">
                            <label>Other Services</label>
                            <select class="form-control" multiple v-model="formData.other.services">
                                <option>Insurance</option>
                                <option>Ticket</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea v-model="formData.other.note" class="form-control"></textarea>
                        </div>
                    </section>
                </fieldset>

                <button type="subimt" class="btn btn-success">Submit</button>
            </form>
        </CCardBody>
    </CCard>
</template>

<script>
import PeopleJobOrderForm from '@/modules/Client/partials/PeopleJobOrderForm'
import TextInput from "@/components/Base/TextInput.vue";
import SimpleSelect from "@/components/Base/SimpleSelect.vue";
import client from "@/client";
import endpoints from "../endpoints";

export default {
    name: "CreateNewForm",
    components: {
        PeopleJobOrderForm,
        TextInput,
        SimpleSelect
    },
    data() {
        return {
            formData: {
                prefix: 'ms',
                first_name: null,
                last_name: null,
                mobile: null,
                service_type: 'people',
                people: {
                    type: 'no_preference',
                    note: '',
                    nationality: null,
                    duties: [],
                    personalities: []
                },
                other: {
                    services: [],
                    note: ''
                },
            },
            service_types: [
                {label: 'People', value: 'people'},
                {label: 'Other', value: 'other'},
            ],
            prefixOptions: [
                {label: 'Mr.', value: 'mr'},
                {label: 'Ms.', value: 'ms'},
                {label: 'Mrs.', value: 'mrs'},
            ]
        }
    },
    methods: {
        updatePeopleInput(payload) {
            this.formData.people[payload.key] = payload.value
        },
        submit() {

            // console.log(this.formData)
            // return
            client.post(endpoints.list, this.formData)
                .then(() => {
                    this.$toasted.success('Job created successfully')
                    this.$router.push({name: 'Jobs'})
                })
                .catch(err => {
                    this.$toasted.error(err.message)
                })
        }
    }
}
</script>

<style scoped></style>
