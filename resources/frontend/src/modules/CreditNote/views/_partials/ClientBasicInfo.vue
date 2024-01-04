<template>
    <div class="ClientBasicInfo">
        <div>
            Client Name: <strong>{{ client.prefix }}
            {{ client.full_name }}</strong>
        </div>
        <div>
            Mobile: <strong>{{ client.mobile }}</strong>
        </div>
        <div>
            <router-link :to="{name:'Client',params:{id:client.id}}"
                         class="btn btn-info bnt-sm">Detail
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "ClientBasicInfo",
    props: {
        client: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
