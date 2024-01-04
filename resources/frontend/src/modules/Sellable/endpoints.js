/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    all: '/api/agencycore/sellables/all',
    list: '/api/agencycore/sellables',
    show: sellable_id => `/api/agencycore/sellables/${sellable_id}`,
    update: sellable_id => `/api/agencycore/sellables/${sellable_id}`,
    variant_index: '/api/agencycore/variants',
    add_variant: '/api/agencycore/variants',
    variants: '/api/agencycore/variants/all',
    add_product_variants: sellable_id => `/api/agencycore/sellables/${sellable_id}/variants/`,
    show_product_variants: (sellable_id, variant_id) => `/api/agencycore/sellables/${sellable_id}/variants/${variant_id}`,
    update_variants: (sellable_id, variant_id) => `/api/agencycore/sellables/${sellable_id}/variants/${variant_id}`,
    remove_variants: (sellable_id, variant_id) => `/api/agencycore/sellables/${sellable_id}/variants/${variant_id}`,
    add_template: sellable_id => `/api/agencytemplate/templates/sellables/${sellable_id}`,
    load_variant_template: (sellable_id, variant_id) => `/api/agencytemplate/templates/sellables/${sellable_id}/variants/${variant_id}`,
    load_sellable_template: sellable_id => `/api/agencytemplate/templates/sellables/${sellable_id}`,
}


export default endpoints
