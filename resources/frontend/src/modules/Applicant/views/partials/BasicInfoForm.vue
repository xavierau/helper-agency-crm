<template>
    <section class="BasicInform row">

        <div class="col-12">
            <h5>Current Location</h5>
            <div class="row">
                <div class="form-group col-3 ">
                    <label>Country</label>
                    <SelectCountry :form-data.sync="formData"
                                   required
                                   form-data-key="current_country"/>
                </div>

                <div class="form-group col-3">
                    <label>Region/State</label>
                    <SelectCountryRegion :form-data.sync="formData"
                                         form-data-key="current_state"
                                         country-key="current_country"/>
                </div>
                <div class="form-group col-6" v-if="formData.current_country ==='hong_kong'">
                    <label>Address</label>
                    <input name="living_place" type="text" class="form-control" v-model="formData.living_place"/>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <ApplicantHKCode size="col" v-model="formData.hk_code"/>
                <ApplicantSupplier size="col" v-model.number="formData.supplier_id"/>
                <ApplicantPTCode size="col" v-model="formData.pt_code"/>
            </div>
        </div>
        <h5 class="col-12">Personal Info</h5>
        <div class="form-group col-12">
            <label>Name</label>
            <input v-model="formData.name"
                   name="name"
                   type="text"
                   class="form-control"/>
        </div>

        <div class="form-group col-12">
            <label>Date for birth</label>
            <input v-model="formData.date_of_birth" name="date_of_birth"
                   type="date"
                   class="form-control"/>
        </div>

        <ApplicantGender v-model="formData.gender"/>

        <div class="form-group col-12 col-md-6">
            <label>Phone number</label>
            <input name="phone" type="text" class="form-control" v-model="formData.phone"/>
        </div>

        <ApplicantNationality v-model="formData.nationality"/>
        <ApplicantMaritalStatus v-model="formData.marital_status"/>
        <ApplicantHeight v-model.number="formData.height"/>
        <ApplicantWeight v-model.number="formData.weight"/>

        <div class="form-group col-12">
            <label>Religion</label>
            <select name="religion" class="form-control"
                    v-model="formData.religion">
                <option value="Christian">Christian</option>
                <option value="Islam">Islam</option>
                <option value="Buddhists">Buddhists</option>
                <option value="Unaffiliated">Unaffiliated</option>
            </select>

        </div>

        <!--        Language -->
        <div class="col-12">
            <LanguageForm :form-data.sync="formData"></LanguageForm>
        </div>

        <h5 class="col-12">Communication</h5>
        <div class="form-group col-12 col-md-6">
            <label>Email</label>
            <input name="email"
                   type="email" class="form-control"
                   v-model="formData.email"/>
        </div>
        <div class="form-group col-12 col-md-6">
            <label>Facebook</label>
            <input name="facebook"
                   type="text"
                   class="form-control"
                   v-model="formData.facebook"/>
        </div>


    </section>
</template>

<script>
import SelectCountry from "@/components/Base/SelectCountry";
import SelectCountryRegion from "@/components/Base/SelectCountryRegion";
import ApplicantHeight from "@/components/ApplicantForm/Height.vue"
import ApplicantWeight from "@/components/ApplicantForm/Weight.vue"
import ApplicantGender from "@/components/ApplicantForm/Gender.vue"
import ApplicantNationality from "@/components/ApplicantForm/Nationality.vue";
import ApplicantMaritalStatus from "@/components/ApplicantForm/MaritalStatus.vue";
import ApplicantHKCode from "@/components/ApplicantForm/HKCode.vue";
import ApplicantPTCode from "@/components/ApplicantForm/PTCode.vue";
import ApplicantSupplier from "@/components/ApplicantForm/Supplier.vue";
import LanguageForm from "@/modules/Applicant/views/partials/LanguageForm";

export default {
    name: "BasicInfoForm",
    components: {
        ApplicantMaritalStatus,
        ApplicantNationality,
        SelectCountry,
        SelectCountryRegion,
        ApplicantHeight,
        ApplicantWeight,
        ApplicantGender,
        ApplicantHKCode,
        ApplicantPTCode,
        ApplicantSupplier,
        LanguageForm,

    },
    props: {
        formData: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
