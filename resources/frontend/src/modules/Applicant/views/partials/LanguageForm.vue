<template>
    <section class="LanguageForm row">
        <h5 class="col-12">Language</h5>

            <SimpleSelect label="English"
                          v-model="formData.english"
                          :options="[
                {value:'Native',label:'Native'},
            {value:'Good',label:'Good'},
            {value:'Fair',label:'Fair'},
            {value:'Poor',label:'Poor'},
            ]"/>

            <SimpleSelect label="Cantonese"
                          v-model="formData.cantonese"
                          :options="[
                {value:'Native',label:'Native'},
            {value:'Good',label:'Good'},
            {value:'Fair',label:'Fair'},
            {value:'Poor',label:'Poor'},
            ]"/>

            <SimpleSelect label="Mandarin"
                          v-model="formData.mandarin"
                          :options="[
                {value:'Native',label:'Native'},
            {value:'Good',label:'Good'},
            {value:'Fair',label:'Fair'},
            {value:'Poor',label:'Poor'},
            ]"/>

        <div class="form-group col-12">
            <label>Other Language</label>
            <textarea class="form-control"
                      name="other_language"
                      v-model="formData.other_language"></textarea>
        </div>

        <!--        End Language -->

    </section>
</template>

<script>
import SimpleSelect from "@/components/Base/SimpleSelect.vue";

export default {
    name: "LanguageForm",
    components: {
        SimpleSelect
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
