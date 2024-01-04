<template>
    <div class="form-group" :class="size">
        <label>Weight</label>
        <div class="input-group">
            <input :name="name"
                   type="number"
                   min="0"
                   step="0.1"
                   class="form-control"
                   :value="value"
                   @input="$emit('input', $event.target.value)"/>
            <div class="input-group-append">
                <span class="input-group-text">kg</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicantWeight",
    props: {
        name: {
            type: String,
            default: 'weight'
        },
        value: {
            type: Number,
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
