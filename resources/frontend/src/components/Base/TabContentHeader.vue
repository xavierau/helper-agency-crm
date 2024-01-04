<template>
    <div class="tab-content-header mb-2 d-flex justify-content-between align-items-baseline">
        <h4 class="tab-title">{{ title }}</h4>
        <slot>
            <router-link v-if="link"
                         :to="getRouterTo()"
                         class="btn btn-sm btn-outline-dark">
                {{ link.label || "Link" }}
            </router-link>
        </slot>
    </div>
</template>

<script>

export default {
    name: "TabContentHeader",
    props: {
        title: {
            type: String,
            required: true
        },
        link: {
            type: Object,
        },
    },
    methods: {
        getRouterTo() {
            if (this.link?.route) {
                return this.link.route
            } else if (this.link?.url) {
                return this.link.url
            }

            return "/dashboard"
        }

    }
}
</script>

<style scoped>

</style>
