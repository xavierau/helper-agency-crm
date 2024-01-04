<template>
    <section class="HolidayArrangementForm row">
        <h5 class="col-12">Holiday Arrangement</h5>
        <Checkbox name="sunday" v-model="formData.sunday"> Sunday</Checkbox>
        <Checkbox name="weekday" v-model="formData.weekday"> Weekday</Checkbox>
        <Checkbox name="alternative" v-model="formData.alternative"> Alternative</Checkbox>
        <Checkbox name="no_holidays" v-model="formData.no_holidays"> No holidays</Checkbox>
        <Checkbox name="once_a_month" v-model="formData.once_a_month"> Once a month</Checkbox>
    </section>
</template>

<script>
import Checkbox from "@/components/Base/Checkbox.vue";

export default {
    name: "HolidayArrangementForm",
    components: {
        Checkbox
    },
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
