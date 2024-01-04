<template>
    <router-view></router-view>
</template>

<script>
import endpoints from '@/endpoints.js'
import client from '@/client.js'

export default {
    name: 'App',
    created() {
        client.get(endpoints.user)
            .then(({data}) => this.$store.commit('setUser', data))
            .catch(error => console.log(error))
    }
}
</script>

<style lang="scss">
// Import Main styles for this application
@import 'assets/scss/style';
</style>
