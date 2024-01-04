<template>
    <form class="form">
        <div class="form-group">
            <label for="label">Label</label>
            <input id="label" type="text" class="form-control" v-model="formData.name">
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input id="code" type="text" class="form-control" v-model="formData.code">
        </div>
    </form>
</template>

<script>

export default {
    name: "SupplierForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
}
</script>

<style scoped>

</style>

