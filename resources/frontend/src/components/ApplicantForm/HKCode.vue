<template>
    <div class="form-group" :class="size">
        <label>HK Code</label>
        <input :value="value"
               @input="$emit('input', $event.target.value)"
               :name="name"
               type="text"
               class="form-control"/>
    </div>
</template>

<script>
export default {
    name: "ApplicantHKCode",
    props: {
        name: {
            type: String,
            default: 'hk_code'
        },
        value: {
            type: String,
            default: null
        },
        size: {
            type: String,
            default: 'col-12'
        }
    }
}
</script>

<style scoped>

</style>
