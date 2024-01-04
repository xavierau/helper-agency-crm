<template>
    <!--    "age_of_adults",-->
    <!--    "age_of_elders",-->
    <!--    "dayoff_arrangement",-->
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

        <!--        <div class="form-group">-->
        <!--            <label>Duties</label>-->
        <!--            <div class="form-group">-->
        <!--                <vSelect multiple v-model="formData.duties" :options="duties" :reduce="d=>d.id"/>-->
        <!--            </div>-->
        <!--        </div>-->

        <!-- Additional Info                        -->

        <div class="form-group row">
            <label for="house_size"
                   class="col-6 col-sm-4 col-form-label">Expected Arrival Date</label>
            <div class="input-group col">
                <input v-model="formData.expected_arrival_date"
                       type="date"
                       min="today"
                       class="form-control"
                       id="expected_arrival_date"
                       name="expected_arrival_date">
            </div>
        </div>
        <div class="form-group row">
            <label for="house_size"
                   class="col-6 col-sm-4 col-form-label">House Size</label>
            <div class="input-group col">
                <input v-model="formData.house_size"
                       type="number"
                       min="0"
                       class="form-control"
                       id="house_size"
                       placeholder="House size eg: 750"
                       name="house_size">
                <div class="input-group-append">
                    <div class="input-group-text">ft<sup>2</sup></div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="number_of_rooms"
                   class="col-6 col-sm-4 col-form-label">Number of rooms</label>
            <div class="input-group col">
                <input v-model="formData.number_of_rooms"
                       type="number"
                       min="0"
                       class="form-control"
                       id="number_of_rooms"
                       placeholder="Number of rooms eg:3"
                       name="garden_size">
            </div>
        </div>


        <div class="form-group row">
            <label for="garden_size"
                   class="col-6 col-sm-4 col-form-label">Garden</label>
            <div class="input-group col">
                <input v-model="formData.garden_size"
                       type="number"
                       min="0"
                       class="form-control"
                       id="garden_size"
                       placeholder="Garden size eg:500"
                       name="garden_size">
                <div class="input-group-append">
                    <div class="input-group-text">ft<sup>2</sup></div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="number_of_cars"
                   class="col-6 col-sm-4 col-form-label">Wash Car</label>
            <div class="col">
                <input v-model="formData.number_of_cars"
                       type="number"
                       min="0"
                       class="form-control"
                       id="number_of_cars"
                       name="garden_size">
            </div>
        </div>

        <div class="form-group row">
            <label for="disabled_personnel"
                   class="col-6 col-sm-4 col-form-label">Disability</label>
            <div class="col">
                <input v-model="formData.disabled_personnel"
                       type="number"
                       min="0"
                       class="form-control"
                       id="disabled_personnel"
                       name="garden_size">
            </div>
        </div>
        <div class="form-group row">
            <label for="disabled_personnel"
                   class="col-6 col-sm-4 col-form-label">Number of expecting babies</label>
            <div class="col">
                <input v-model="formData.number_of_expecting_babies"
                       type="number"
                       min="0"
                       class="form-control"
                       id="number_of_expecting_babies"
                       name="garden_size">
            </div>
        </div>

        <div class="form-group row">
            <label for="number_of_kids"
                   class="col-6 col-sm-4 col-form-label">Number of children (0-5)</label>
            <div class="col-3 col-sm-4">
                <input v-model="formData.number_of_kids"
                       type="number"
                       min="0"
                       placeholder="Number of kids. eg: 2"
                       class="form-control"
                       id="number_of_kids"
                       name="number_of_kids">
            </div>
            <div class="col-3 col-sm-4">
                <input v-model="formData.age_of_kids"
                       type="text"
                       placeholder="Age of kids: 2, 5"
                       class="form-control"
                       id="age_of_kids"
                       name="age_of_kids">
            </div>
        </div>
        <div class="form-group row">
            <label for="number_of_young_adults"
                   class="col-6 col-sm-4 col-form-label">Number of children (6-18)</label>
            <div class="col-3 col-sm-4">
                <input v-model="formData.number_of_young_adults"
                       type="number"
                       min="0"
                       placeholder="Number of kids. eg: 3"
                       class="form-control"
                       id="number_of_young_adults"
                       name="number_of_young_adult">
            </div>
            <div class="col-3 col-sm-4">
                <input v-model="formData.age_of_young_adults"
                       type="text"
                       placeholder="Age of kids: 8, 10, 15"
                       class="form-control"
                       id="age_of_young_adults"
                       name="age_of_young_adult">
            </div>
        </div>

        <div class="form-group row">
            <label for="pets"
                   class="col-3 col-form-label">Pets</label>
            <div class="col">
                <input v-model="formData.pets"
                       type="text"
                       placeholder="1 cats, 2 dogs"
                       class="form-control"
                       id="pets"
                       name="pets">
            </div>
        </div>

        <!-- End Additional Info                        -->

        <div class="form-group">
            <label>Note</label>
            <textarea class="form-control" v-model="formData.note"></textarea>
        </div>
    </section>
</template>

<script>
import client from '@/client'
import endpoints from '@/modules/Client/endpoints'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default {
    name: "PeopleJobOrderForm",
    components: {vSelect},
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            people_types: [
                {label: 'No preference', value: 'no_preference'},
                {label: 'Local', value: 'local'},
                {label: 'Overseas', value: 'overseas'},
            ],
            nationalities: [
                {label: 'Indonesian', value: 'IH'},
                {label: 'Filipino', value: 'FH'},
                {label: 'Bangladeshi', value: 'BH'},
                {label: 'Sri Lankan', value: 'SH'},
                {label: 'Cambodian', value: 'CH'},
            ],
            duties: [],
            selected_duties: [],
        }
    },
    created() {
        client.get(endpoints.duties)
            .then(({data}) => this.duties = data)
            .catch(error => console.log(error))
    },
}
</script>

<style scoped></style>
