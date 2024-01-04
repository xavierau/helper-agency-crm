<template>
    <CCard class="Documentation">
        <CCardHeader>Documentation</CCardHeader>
        <CCardBody>
            <CTabs variant="pills" :active-tab="0"
                   :vertical="{ navs: 'col-md-2', content: 'col-md-10' }">
                <CTab title="Product">
                    <CCard>
                        <CButton
                            block
                            color="link"
                            class="text-left shadow-none card-header"
                            @click="accordion = accordion === 0 ? false : 0"
                        >
                        <h5 class="m-0">Product</h5>
                      </CButton>
                        <CCollapse :show="accordion === 0">
                            <CCardBody>
                                <description-item>
                                    <template #left>
                                        <img class="img-fluid"
                                             src="https://i.ytimg.com/vi/Ib_5LQmNVGk/maxresdefault.jpg" />
                                    </template>
                                </description-item>
                                <description-item>
                                    <template #left>
                                        <img class="img-fluid"
                                             src="https://i.ytimg.com/vi/U3r62Np_pxY/maxresdefault.jpg" />
                                    </template>
                                    how to work on this
                                </description-item>
                            </CCardBody>
                        </CCollapse>
                        <CButton
                            block
                            color="link"
                            class="text-left shadow-none card-header"
                            @click="accordion = accordion === 1 ? false : 1"
                        >
                        <h5 class="m-0">Variant</h5>
                      </CButton>
                        <CCollapse :show="accordion === 1">
                        <CCardBody>
                          1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non
                          cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                          on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                          nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                          beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven''t heard of them accusamus labore sustainable VHS.
                        </CCardBody>
                      </CCollapse>
                    </CCard>

                </CTab>
                <CTab title="Profile">
                  2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                  et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                  dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                  officia deserunt mollit anim id est laborum.
                </CTab>
                <CTab title="Disabled" disabled>
                  Text will not be shown.
                </CTab>
              </CTabs>
        </CCardBody>
    </CCard>
</template>

<script>
import DescriptionItem from '@/components/Documentation/DescriptionItem'

export default {
    name      : "Documentation",
    components: {
        DescriptionItem
    },
    data() {
        return {
            accordion: 0
        }
    }
}
</script>

<style scoped>

</style>
