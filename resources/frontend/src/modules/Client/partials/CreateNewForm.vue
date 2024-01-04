<template>
    <CCard>
        <CCardBody>
            <form class="form">
                <fieldset>
                    <legend>Basic Info</legend>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Prefix</label>
                                <select name="prefix" class="form-control" v-model="formData.prefix">
                                    <option value="ms">Ms.</option>
                                    <option value="mr">Mr.</option>
                                    <option value="mrs">Mrs.</option>
                                </select>
                            </div>
                        </div>
                        <!--                        <div class="col-md-5">-->
                        <!--                            <div class="form-group">-->
                        <!--                                <label>First Name</label>-->
                        <!--                                <input name="first_name" class="form-control" v-model="formData.first_name"/>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <div class="col">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="last_name" class="form-control" v-model="formData.last_name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mobile Phone</label>
                        <input name="mobile" type="text" class="form-control" v-model="formData.mobile"/>
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <HKRegionSelect name="address_1" id="address_3" v-model="formData.address_3"/>
                        <!--                        <select name="address_1" id="address_3" class="form-control">-->
                        <!--                            <option value="">&#45;&#45; Please Select &#45;&#45;</option>-->
                        <!--                            <option value="Central and Western">Central and Western</option>-->
                        <!--                            <option value="Eastern">Eastern</option>-->
                        <!--                            <option value="Southern">Southern</option>-->
                        <!--                            <option value="Wan Chai">Wan Chai</option>-->
                        <!--                            <option value="Sham Shui Po">Sham Shui Po</option>-->
                        <!--                            <option value="Kowloon City">Kowloon City</option>-->
                        <!--                            <option value="Kwun Tong">Kwun Tong</option>-->
                        <!--                            <option value="Wong Tai Sin">Wong Tai Sin</option>-->
                        <!--                            <option value="Yau Tsim Mong">Yau Tsim Mong</option>-->
                        <!--                            <option value="Islands">Islands</option>-->
                        <!--                            <option value="Kwai Tsing">Kwai Tsing</option>-->
                        <!--                            <option value="North">North</option>-->
                        <!--                            <option value="Sai Kung">Sai Kung</option>-->
                        <!--                            <option value="Sha Tin">Sha Tin</option>-->
                        <!--                            <option value="Tai Po">Tai Po</option>-->
                        <!--                            <option value="Tsuen Wan">Tsuen Wan</option>-->
                        <!--                            <option value="Tuen Mun">Tuen Mun</option>-->
                        <!--                            <option value="Yuen Long">Yuen Long</option>-->
                        <!--                        </select>-->
                        <!--                        <input name="address_3" type="text" class="form-control" v-model="formData.address_3"/>-->
                    </div>
                    <!--                    <div class="form-group">-->
                    <!--                        <label>Street</label>-->
                    <!--                        <input name="address_2" type="text" class="form-control" v-model="formData.address_2"/>-->
                    <!--                    </div>-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label>Room</label>-->
                    <!--                        <input name="address_1" type="text" class="form-control" v-model="formData.address_1"/>-->
                    <!--                    </div>-->
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
                                    <input name="service_type" type="radio" :value="service.value"
                                           v-model="formData.service_type"> {{ service.label }}
                                </label>
                            </div>
                        </div>

                    </div>

                    <people-job-order-form
                        er-form v-if="formData.service_type === 'people'"
                        :form-data.sync="formData.people"
                        @inputUpdated="updatePeopleInput"/>

                    <section v-if="formData.service_type === 'other'">
                        <div class="form-group">
                            <label>Other Services</label>
                            <select name="other.services" class="form-control" multiple
                                    v-model="formData.other.services">
                                <option>Insurance</option>
                                <option>Ticket</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Note</label>
                            <textarea name="other.note" v-model="formData.other.note" class="form-control"></textarea>
                        </div>
                    </section>
                </fieldset>
            </form>
        </CCardBody>
    </CCard>
</template>

<script>
import PeopleJobOrderForm from '@/modules/Client/partials/PeopleJobOrderForm'
import HKRegionSelect from "@/components/HKRegionSelect";

export default {
    name: "CreateNewForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    components: {
        PeopleJobOrderForm,
        HKRegionSelect
    },
    data() {
        return {
            service_types: [
                {label: 'People', value: 'people'},
                {label: 'Other', value: 'other'},
            ],
        }
    },
    methods: {
        updatePeopleInput(payload) {
            this.formData.people[payload.key] = payload.value
        }
    }
}
</script>

<style scoped></style>
