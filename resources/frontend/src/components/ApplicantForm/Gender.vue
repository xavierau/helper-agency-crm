<template>
    <div class="form-group" :class="size">
        <label>Gender</label>
        <select
            :name="name"
            class="form-control"
            :value="value"
            @input="$emit('input', $event.target.value)">
            <option value="female">Female</option>
            <option value="male">Male</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "ApplicantGender",
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
    }
}
</script>

<style scoped>

</style>
