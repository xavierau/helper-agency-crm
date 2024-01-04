<template>
    <div class="form-group" :class="size">
        <label>Marital Status</label>
        <select :name="name" class="form-control"
                :value="value"
                @input="$emit('input',$event.target.value)">
            <option value="single">Single</option>
            <option value="married">Married</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "ApplicantMaritalStatus",
    props: {
        name: {
            type: String,
            default: 'marital_status'
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
