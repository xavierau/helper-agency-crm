<template>
    <CRow class="mb-2">
        <CCol md="8">
            <slot name="left">Default left item content</slot>
        </CCol>
        <CCol md="4">
            <slot>Default right description</slot>
        </CCol>
    </CRow>
</template>

<script>
export default {
    name: "DescriptionItem"
}
</script>

<style scoped>

</style>
