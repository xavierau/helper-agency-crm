import client from "@/client"
import {isArray} from "lodash";

/**
 * Created by A & A Creation Co. on 25/8/2020.
 */

const mixin = {
    data() {
        return {
            fields: [],
            columnFilters: {},
            sorter: null,
            pageSize: 15,
            paginator: null,
            search: null,
            external_url: null
        }
    },
    computed: {
        items() {
            return this.paginator ? this.paginator.data : null;
        },
        paginationObject() {
            return {
                pages: this.paginator?.meta?.last_page || (this.paginator?.last_page || 0),
                activePage: this.paginator?.meta?.current_page || (this.paginator?.current_page || 0),
            }
        }
    },
    created() {
        this.fetchItems()
    },
    methods: {
        fetchItems(params = {}) {
            this.columnFilters = this.$route.query
            const columns = Object.keys(this.columnFilters).reduce((carry, key) => {
                if (this.columnFilters[key] && isArray(this.columnFilters[key])) {
                    carry[`filter[${key}]`] = [this.columnFilters[key]?.join(',')]
                } else {
                    carry[`filter[${key}]`] = this.columnFilters[key]
                }

                return carry
            }, {})

            let basic_params = {
                params: {
                    'filter[search]': this.search,
                    pageSize: this.pageSize,
                    sort: this.sorter,
                    ...columns,
                    ...params,
                }
            }

            client.get(this.external_url, basic_params)
                .then(({data}) => this.paginator = data)
                .catch(error => console.log(error))
                .finally(() => this.isLoading = false)
        },
        updateTableFilter(keyword) {
            this.search = keyword
            this.fetchItems()
        },
        updateColumnFilter(value) {
            if (value.type !== 'change') {
                this.columnFilters = Object.assign(this.columnFilters, value)
            }

            this.fetchItems()
        },
        updateSorter(value) {
            this.sorter = value.asc ? value.column : `-${value.column}`
            this.fetchItems()
        },
        updatePerPageItems(value) {
            this.pageSize = value
            this.fetchItems()
        },
        updateActivePage(active_page) {
            this.fetchItems({page: active_page})
        }
    }
}
export default mixin
