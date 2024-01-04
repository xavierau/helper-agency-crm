<template>
    <div class="form-group" :class="size">
        <label>Nationality</label>
        <select name="nationality" class="form-control"
                :value="value"
                @input="$emit('input', $event.target.value)">
            <option v-for="nationality in nationalities"
                    :key="nationality.code"
                    :value="nationality.code"
                    v-text="nationality.label"></option>
        </select>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "@/modules/Applicant/endpoints";

export default {
    name: "ApplicantNationality",
    props: {
        name: {
            type: String,
            default: 'gender'
        },
        value: {
            type: String,
            default: null
        },
        size: {
            type: String,
            default: 'col-12 col-md-6'
        }
    },
    data(){
        return {
            nationalities:[]
        }
    },
    created() {
        client.get(endpoints.nationalities)
            .then(({data}) => this.nationalities = data)
            .catch(error => console.log(error))
    }
}
</script>

<style scoped>

</style>
