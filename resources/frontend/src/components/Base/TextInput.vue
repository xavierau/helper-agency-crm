<template>
    <div :class="size">
        <div class="form-group">
            <label>{{ label }}</label>
            <input class="form-control"
                   :value="value"
                   @input="$emit('input', $event.target.value)"
                   :placeholder="placeholder"
                   :required="required"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "TextInput",
    props: {
        label: {
            type: String,
            required: true
        },
        value: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
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
