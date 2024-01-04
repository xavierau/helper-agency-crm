<template>
    <div>
        <div class="form-group">
            <label>Label</label>
            <input type="text" class="form-control" v-model="formData.label"/>
        </div>
    </div>

</template>

<script>
export default {
    name: "ContractDocForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
