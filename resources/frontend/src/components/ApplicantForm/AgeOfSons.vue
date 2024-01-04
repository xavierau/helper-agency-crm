<template>
    <div class="form-group" :class="size">
        <label>Age of sons</label>
        <input :name="name"
               type="string"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "AgeOfSons",
    props: {
        name: {
            type: String,
            default: 'age_of_sons'
        },
        value: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'col-6 col-md-3'
        }
    }
}
</script>

<style scoped>

</style>
