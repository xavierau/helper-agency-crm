<template>
    <div class="form-group" :class="size">
        <label>Height</label>
        <div class="input-group">
            <input :name="name"
                   type="number"
                   min="0"
                   step="0.1"
                   class="form-control"
                   :value="value"
                   @input="$emit('input', $event.target.value)"/>
            <div class="input-group-append">
                <span class="input-group-text">cm</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicantHeight",
    props: {
        name: {
            type: String,
            default: 'height'
        },
        value: {
            type: Number,
            default: 0
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
