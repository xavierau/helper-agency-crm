<template>
    <button @click="trigger"
            class="btn btn-danger btn-sm">
        <i class="fas fa-trash-alt"></i>
    </button>
</template>

<script>
export default {
    name: "DeleteButton",
    props: {
        click: {
            type: Function
        }
    },
    methods: {
        trigger() {
            if (this.click) {
                this.click()
            }
        }
    }
}
</script>

<style scoped>

</style>
