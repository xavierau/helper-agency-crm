<template>
    <div class="form-group" :class="size">
        <label>Spouse Occupation</label>
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
    name: "SpouseOccupation",
    props: {
        name: {
            type: String,
            default: 'spouse_occupation'
        },
        value: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'col-12 col-md-4'
        }
    }
}
</script>

<style scoped>

</style>
