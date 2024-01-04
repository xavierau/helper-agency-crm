<template>
    <div class="form-group" :class="size">
        <label>Supplier</label>
        <select :name="name"
                class="form-control"
                @input="$emit('input', $event.target.value)">
            <option v-for="item in suppliers" :value="item.id" :key="item.id" :selected="value === item.id">{{ item.name
                }}({{ item.code }})
            </option>
        </select>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "@/modules/Supplier/endpoints";

export default {
    name: "ApplicantSupplier",
    props: {
        name: {
            type: String,
            default: 'supplier_id'
        },
        value: {
            type: Number,
            default: null
        },
        size: {
            type: String,
            default: 'col-12'
        }
    },
    data() {
        return {
            suppliers: []
        }
    },

    created() {
        client.get(endpoints.list)
            .then(({data}) => this.suppliers = data)
    }
}
</script>

<style scoped>

</style>
