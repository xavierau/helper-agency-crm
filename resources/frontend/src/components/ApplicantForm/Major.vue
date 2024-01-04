<template>
    <div class="form-group" :class="size">
        <label>Major</label>
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
    name: "Major",
    props: {
        name: {
            type: String,
            default: 'major'
        },
        value: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'col-12 col-md-6'
        }
    }
}
</script>
