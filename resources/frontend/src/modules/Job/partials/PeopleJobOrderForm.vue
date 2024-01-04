<template>
    <section>
        <div class="form-group">
            <label>Type</label>
            <div class="row">
                <div class="btn-group btn-group-toggle btn-group-justified col-12"
                     data-toggle="buttons">
                  <label class="btn btn-outline-info"
                         v-for="type in people_types"
                         :class="{active:type.value === formData.type }"
                         :key="type.value">
                    <input type="radio" :value="type.value"
                           name="type"
                           v-model="formData.type"> {{ type.label }}
                  </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Nationality</label>
            <select class="form-control" v-model="formData.nationality">
                <option :value="null">No preference</option>
                <option v-for="nationality in nationalities"
                        :key="nationality.value"
                        :value="nationality.value"
                        v-text="nationality.label"></option>

            </select>
        </div>

        <div class="form-group">
            <label>Personalities
                <button class="btn btn-info btn-sm" type="button"
                        @click="personality_collapse = !personality_collapse">
                    <i class="fa"
                       :class="{'fa-minus':personality_collapse,'fa-plus':!personality_collapse}"></i>
                </button>
            </label>
            <CCollapse :show="personality_collapse">
                <div class="row">
                    <div class="col-md-4 col-lg-3" v-for="personality in personalities"
                         :key="personality.id">
                        <label>
                            <input type="checkbox"
                                   :value="personality.id"
                                   v-model="formData.personalities" /> {{ personality.label }}
                        </label>
                    </div>
                </div>
            </CCollapse>
        </div>
        <div class="form-group">
            <label>Duties
                <button class="btn btn-info btn-sm" type="button"
                        @click="duty_collapse = !duty_collapse">
                    <i class="fa"
                       :class="{'fa-minus':duty_collapse,'fa-plus':!duty_collapse}"></i>
                </button>
            </label>
            <CCollapse :show="duty_collapse">
                <div class="row">
                    <div class="col-md-4 col-lg-3" v-for="duty in duties"
                         :key="duty.id">
                        <label>
                            <input type="checkbox"
                                   :value="duty.id"
                                   v-model="formData.duties" /> {{ duty.label }}
                        </label>
                    </div>
                </div>
            </CCollapse>
        </div>
        <div class="form-group">
            <label>Note</label>
            <textarea class="form-control" v-model="formData.note"></textarea>
        </div>
    </section>
</template>

<script>
import client from '@/client'
import endpoints from '@/modules/Client/endpoints'

export default {
    name   : "PeopleJobOrderForm",
    props  : {
        formData: {
            type    : Object,
            required: true
        }
    },
    data() {
        return {
            people_types          : [
                {label: 'No preference', value: 'no_preference'},
                {label: 'Local', value: 'local'},
                {label: 'Overseas', value: 'overseas'},
            ],
            nationalities         : [
                {label: 'Indonesian', value: 'IH'},
                {label: 'Filipino', value: 'FH'},
                {label: 'Bangladeshi', value: 'BH'},
                {label: 'Sri Lankan', value: 'SH'},
                {label: 'Cambodian', value: 'CH'},
            ],
            duties                : [],
            personalities         : [],
            personality_collapse  : false,
            duty_collapse         : false,
            selected_duties       : [],
            selected_personalities: [],
        }
    },
    created() {
        client.get(endpoints.duties.list)
              .then(({data}) => this.duties = data)
              .catch(error => console.log(error))
        client.get(endpoints.personalities.list)
              .then(({data}) => this.personalities = data)
              .catch(error => console.log(error))
    },
    methods: {
        //updateInput(e) {
        //    this.$emit('inputUpdated', {
        //        key  : e.target.name,
        //        value: e.target.value,
        //    })
        //}
    }
}
</script>

<style scoped></style>
