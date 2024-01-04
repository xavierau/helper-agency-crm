<template>
    <div class="RequirementInfo" :class="{'is-dirty':isDirty}">
        <h4>Job Requirements</h4>

        <div class="form-group">
            <label> Expected Arrival Date</label>
            <input type="date" v-model="requirement.expected_arrival_date" class="form-control"
                   :disabled="isDisabled('expected_arrival_date')">
        </div>
<!--        <div class="form-group" v-if="isShown('number_of_bedrooms')">-->
<!--            <label> Family members</label>-->
<!--            <input type="number" v-model="requirement.number_of_bedrooms" class="form-control"-->
<!--                   :disabled="isDisabled('number_of_bedrooms')">-->
<!--        </div>-->

        <div class="form-group" v-if="isShown('house_size')">
            <label> Residential Area</label>
            <input type="number" v-model="requirement.house_size" class="form-control"
                   :disabled="isDisabled('house_size')">
        </div>

        <div class="form-group" v-if="isShown('number_of_rooms')">
            <label> Number of rooms</label>
            <input type="number" v-model="requirement.number_of_rooms" class="form-control"
                   :disabled="isDisabled('number_of_rooms')">
        </div>
        <div class="form-group" v-if="isShown('number_of_adults')">
            <label> Number of adults</label>
            <div class="row">
                <div class="col-4 ">
                    <input type="number" v-model="requirement.number_of_adults" class="form-control"
                           :disabled="isDisabled('number_of_adults')">
                </div>
                <div class="col-8">
                    <input type="text" v-model="requirement.age_of_adults" class="form-control"
                           :disabled="isDisabled('number_of_adults')">
                </div>
            </div>
        </div>
        <div class="form-group" v-if="isShown('number_of_elders')">
            <label> Number of elders</label>
            <div class="row">
                <div class="col-4 ">
                    <input type="number" v-model="requirement.number_of_elders" class="form-control"
                           :disabled="isDisabled('number_of_elders')">
                </div>
                <div class="col-8">
                    <input type="text" v-model="requirement.age_of_elders" class="form-control"
                           :disabled="isDisabled('age_of_elders')">
                </div>
            </div>
        </div>

        <div class="form-group" v-if="isShown('number_of_kids')">
            <label> Number of children (0-5)</label>
            <div class="row">
                <div class="col-4 ">
                    <input type="number"
                           placeholder="Number of Children"
                           v-model="requirement.number_of_kids" class="form-control"
                           :disabled="isDisabled('number_of_kids')">
                </div>
                <div class="col-8">
                    <input type="text"
                           placeholder="Age of Children"
                           v-model="requirement.age_of_kids" class="form-control"
                           :disabled="isDisabled('age_of_kids')">
                </div>
            </div>
        </div>
        <div class="form-group" v-if="isShown('number_of_young_adults')">
            <label> Number of children (6-18)</label>
            <div class="row">
                <div class="col-4 ">
                    <input type="number"
                           placeholder="Number of Children"
                           v-model="requirement.number_of_young_adults" class="form-control"
                           :disabled="isDisabled('number_of_young_adults')">
                </div>
                <div class="col-8">
                    <input type="text"
                           placeholder="Age of Children"
                           v-model="requirement.age_of_young_adults" class="form-control"
                           :disabled="isDisabled('age_of_young_adults')">

                </div>
            </div>
        </div>


        <div class="form-group" v-if="isShown('number_of_expecting_babies')">
            <label> Number of expecting babies</label>
            <input type="number" v-model="requirement.number_of_expecting_babies" class="form-control"
                   :disabled="isDisabled('number_of_expecting_babies')">
        </div>
        <div class="form-group" v-if="isShown('disabled_personnel')">
            <label> Number of constant care</label>
            <input type="number" v-model="requirement.disabled_personnel" class="form-control"
                   :disabled="isDisabled('disabled_personnel')">
        </div>

        <div class="form-group" v-if="isShown('accommodation_type')">
            <label> Accommodation </label>
            <div class="row">
                <div class="col-4 ">
                    <select type="number" v-model="requirement.accommodation_type" class="form-control"
                            :disabled="isDisabled('accommodation_type')">
                        <option value="alone">Own Room</option>
                        <option value="shared">Shared Room</option>
                    </select>
                </div>
                <div class="col-8">
                    <input type="text" v-model="requirement.accommodation_value" class="form-control"
                           :disabled="isDisabled('accommodation_value')">
                </div>
            </div>
        </div>


        <div class="form-group" v-if="isShown('special_duties')">
            <label> Special Duties</label>
            <input type="text" v-model="requirement.special_duties" class="form-control"
                   :disabled="isDisabled('special_duties')">
        </div>
        <div class="form-group" v-if="isShown('note')">
            <label> Note</label>
            <textarea v-model="requirement.note" class="form-control"
                      :disabled="isDisabled('note')"></textarea>
        </div>

        <button @click="update" type="button" class="btn btn-success">Update Requirements</button>

    </div>

</template>

<script>
import client from "@/client";
import _ from 'lodash'

export default {
    name: "RequirementInfo",
    props: {
        url: {
            type: String,
            required: true
        },
        requirement: {
            type: Object,
            required: true
        },
        hiddenInputs: {
            type: Array,
            default() {
                return []
            }
        },
        disabledInputs: {
            type: Array,
            default() {
                return []
            }
        }
    },
    data() {
        return {
            original: null
        }
    },
    created() {
        this.original = _.cloneDeep(this.requirement)
    },
    computed: {
        isDirty() {
            return !_.isEqual(this.original, this.requirement)
        }
    },
    methods: {
        isHidden(value) {
            return this.hiddenInputs.indexOf(value) > -1
        },
        isShown(value) {
            return !this.isHidden(value)
        },
        isDisabled(value) {
            return this.disabledInputs.indexOf(value) > -1
        },
        update() {
            client.post(this.url, this.requirement)
                .then(({data}) => this.$emit('update-requirement',data) )
                .then(() => this.original = _.cloneDeep(this.requirement))
                .then(() => this.$toasted.success('Requirement Updated'))
                .catch(error => this.$toasted.error(error.response.message))
        }
    }
}
</script>

<style scoped>
.is-dirty {
    background-color: #fddaca;
}
</style>
