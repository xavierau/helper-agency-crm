<template>
    <CHeader fixed with-subheader light>
        <CToggler
            in-header
            class="ml-3 d-lg-none"
            @click="$store.commit('toggleSidebarMobile')"
        />
        <CToggler
            in-header
            class="ml-3 d-md-down-none"
            @click="$store.commit('toggleSidebarDesktop')"
        />
        <CHeaderBrand class="mx-auto d-lg-none" to="/">
            <h4>Sincere System</h4>
        </CHeaderBrand>
        <CHeaderNav class="d-md-down-none mr-auto">
            <CHeaderNavItem class="px-3">
                <CHeaderNavLink to="/dashboard">
                    Dashboard
                </CHeaderNavLink>
            </CHeaderNavItem>
            <CHeaderNavItem class="px-3">
                <CHeaderNavLink to="/users" exact>
                    Users
                </CHeaderNavLink>
            </CHeaderNavItem>
            <CHeaderNavItem class="px-3">
                <CDropdown
                    toggler-text="Settings"
                    class="m-2">
                    <CHeaderNavLink :to="{name:'Suppliers'}">Supplier</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Duties'}">Duties</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Products'}">Products</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Variants'}">Product Variants</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Workflows'}">Workflow</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Contract Dates'}">Contract Date</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Contract Documents'}">Contract Documents</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Templates'}">Templates</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Contract Types'}">Contract Types</CHeaderNavLink>
                    <CHeaderNavLink :to="{name:'Organizations'}">Organization
                    </CHeaderNavLink>
                    <CHeaderNavLink>Permissions</CHeaderNavLink>
                </CDropdown>
            </CHeaderNavItem>
        </CHeaderNav>
        <CHeaderNav class="mr-4">
            <GlobalSearch/>

            <CHeaderNavItem class="d-md-down-none mx-2">
                <CHeaderNavLink>
                    <CIcon name="cil-bell"/>
                </CHeaderNavLink>
            </CHeaderNavItem>
            <CHeaderNavItem class="d-md-down-none mx-2">
                <CHeaderNavLink>
                    <CIcon name="cil-list"/>
                </CHeaderNavLink>
            </CHeaderNavItem>
            <CHeaderNavItem class="d-md-down-none mx-2">
                <CHeaderNavLink>
                    <CIcon name="cil-envelope-open"/>
                </CHeaderNavLink>
            </CHeaderNavItem>
            <TheHeaderDropdownAccnt/>
        </CHeaderNav>
        <CSubheader class="px-3">
            <CBreadcrumbRouter class="border-0 mb-0"/>
        </CSubheader>
    </CHeader>
</template>

<script>
import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt'
import GlobalSearch from "@/components/GlobalSearch";

export default {
    name: 'TheHeader',
    components: {
        GlobalSearch,
        TheHeaderDropdownAccnt
    }
}
</script>
