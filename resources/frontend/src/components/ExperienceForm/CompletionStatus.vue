<template>
    <div class="form-group" :class="size">
        <label>Status</label>

        <select @input="$emit('input', $event.target.value)"
                :name="name"
                class="form-control"
                required>
            <option value="finished" :selected="value==='finished'">Finished</option>
            <option value="terminated" :selected="value==='terminated'">Terminated</option>
        </select>

    </div>
</template>

<script>
export default {
    name: "CompletionStatus",
    props: {
        name: {
            type: String,
            default: 'status'
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

<style scoped>

</style>
