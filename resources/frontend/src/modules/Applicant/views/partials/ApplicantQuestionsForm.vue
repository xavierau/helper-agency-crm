<template>
    <section class="HolidayArrangementForm row">
        <h5 class="col-12">Other Questions</h5>
        <Checkbox size="col-6 col-md-4 col-lg-3" name="eat_pork" v-model="formData.eat_pork"> Eat pork</Checkbox>
        <Checkbox size="col-6 col-md-4 col-lg-3" name="eat_pork" v-model="formData.smoke_and_drink"> Smoke and drink</Checkbox>
        <Checkbox size="col-6 col-md-4 col-lg-3" name="eat_pork" v-model="formData.afraid_of_dog"> Afraid of dog</Checkbox>

        <Checkbox size="col-12" name="change_name" v-model="formData.change_name"> No, I do not change name before
        </Checkbox>
        <div class="col-12 mb-3">
            <label for="">If yes, what is the reason for changing name.</label>
            <input type="text" class="form-control" :disabled="formData.change_name ===true"
                   v-model="formData.change_name_info"/>
        </div>


        <Checkbox size="col-12" name="has_been_deport" v-model="formData.has_been_deport"> No, I do not being deported
            before
        </Checkbox>
        <div class="col-12 mb-3">
            <label for="">If yes, what is the reason for being deported.</label>
            <input type="text" class="form-control" :disabled="formData.has_been_deport ===true"
                   v-model="formData.has_been_deport_info"/>
        </div>


        <Checkbox size="col-12 " name="reject_visa" v-model="formData.reject_visa"> No, I do not rejected for applying
            the visa.
        </Checkbox>
        <div class="col-12">
            <label for="">If yes, what is the reason for being rejected.</label>
            <input type="text" class="form-control" :disabled="formData.reject_visa ===true"
                   v-model="formData.reject_visa_info"/>
        </div>

    </section>
</template>

<script>
import Checkbox from "@/components/Base/Checkbox.vue";

export default {
    name: "ApplicantQuestionsForm",
    components: {
        Checkbox
    },
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
}
</script>

<style scoped>

</style>
