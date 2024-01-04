<template>
    <select v-model="address_3"
            class="form-control">
        <option :value="null">-- Please Select --</option>
        <option value="Central and Western">Central and Western</option>
        <option value="Eastern">Eastern</option>
        <option value="Southern">Southern</option>
        <option value="Wan Chai">Wan Chai</option>
        <option value="Sham Shui Po">Sham Shui Po</option>
        <option value="Kowloon City">Kowloon City</option>
        <option value="Kwun Tong">Kwun Tong</option>
        <option value="Wong Tai Sin">Wong Tai Sin</option>
        <option value="Yau Tsim Mong">Yau Tsim Mong</option>
        <option value="Islands">Islands</option>
        <option value="Kwai Tsing">Kwai Tsing</option>
        <option value="North">North</option>
        <option value="Sai Kung">Sai Kung</option>
        <option value="Sha Tin">Sha Tin</option>
        <option value="Tai Po">Tai Po</option>
        <option value="Tsuen Wan">Tsuen Wan</option>
        <option value="Tuen Mun">Tuen Mun</option>
        <option value="Yuen Long">Yuen Long</option>
    </select>
</template>

<script>
export default {
    name: "HKRegionSelect",
    props: {
        value: {
            type: String,
        }
    },
    computed: {
        address_3: {
            get() {
                return this.value
            },
            set(address_3) {
                this.$emit('input', address_3)
            }
        }
    },
    watch: {
        value() {
            this.$emit('input', this.value);
        }
    }
}
</script>

<style scoped>

</style>
