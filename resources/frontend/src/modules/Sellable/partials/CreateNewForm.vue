<template>
    <CCard>
        <CCardBody>
            <form class="form">
                <fieldset>
                    <legend>Basic Info</legend>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Prefix</label>
                                <select class="form-control" v-model="formData.prefix">
                                    <option value="ms">Ms.</option>
                                    <option value="mr">Mr.</option>
                                    <option value="mrs">Mrs.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" v-model="formData.first_name" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" v-model="formData.last_name" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone</label>
                        <input type="text" class="form-control" v-model="formData.mobile" />
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
                                           @inputUpdated="updatePeopleInput" />

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
            </form>
        </CCardBody>
    </CCard>
</template>

<script>
import PeopleJobOrderForm from '@/modules/Client/partials/PeopleJobOrderForm'

export default {
    name      : "CreateNewForm",
    components: {
        PeopleJobOrderForm
    },
    data() {
        return {
            formData     : {
                prefix      : 'ms',
                first_name  : null,
                last_name   : null,
                mobile      : null,
                service_type: 'people',
                people      : {
                    type         : 'no_preference',
                    note         : '',
                    nationality  : null,
                    duties       : [],
                    personalities: []
                },
                other       : {
                    services: [],
                    note    : ''
                },
            },
            service_types: [
                {label: 'People', value: 'people'},
                {label: 'Other', value: 'other'},
            ],
        }
    },
    methods   : {
        updatePeopleInput(payload) {
            this.formData.people[payload.key] = payload.value
        }
    }
}
</script>

<style scoped></style>
