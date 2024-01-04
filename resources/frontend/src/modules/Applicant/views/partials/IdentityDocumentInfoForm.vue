<template>
    <section class="IdentityDocumentInfoForm row">
        <h5 class="col-12">Visa Info</h5>

        <div class="form-group col-6">
            <label>Passport</label>
            <input name="passport" type="text" class="form-control" v-model="formData.passport"/>
        </div>
        <div class="form-group col-6">
            <label>HK ID</label>
            <input name="hk_id" type="text" class="form-control" v-model="formData.hk_id"/>
        </div>
        <div class="form-group col-6">
            <label>Visa Expiry Date</label>
            <input name="visa_expiry_date" type="date" class="form-control" v-model="formData.visa_expiry_date"/>
        </div>
        <div class="form-group col-6">
            <label>HK ID Expiry Date</label>
            <input name="hk_id" type="date" class="form-control" v-model="formData.hk_id_expiry_date"/>
        </div>

    </section>
</template>

<script>
import endpoints from "@/modules/Applicant/endpoints"
import client from "@/client"

export default {
    name: "IdentityDocumentInfoForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            current_country: null,
            nationalities: []
        }
    },
    computed: {
        states() {
            return {
                hong_kong: [
                    "Central and Western",
                    "Eastern",
                    "Southern",
                    "Wan Chai",
                    "Sham Shui Po",
                    "Kowloon City",
                    "Kwun Tong",
                    "Wong Tai Sin",
                    "Yau Tsim Mong",
                    "Islands",
                    "Kwai Tsing",
                    "North",
                    "Sai Kung",
                    "Sha Tin",
                    "Tai Po",
                    "Tsuen Wan",
                    "Tuen Mun",
                    "Yuen Long"
                ],
                indonesia: [
                    "Aceh",
                    "Bali",
                    "Bangka Belitung Islands",
                    "Banten",
                    "Bengkulu",
                    "Central Java",
                    "Central Kalimantan",
                    "Central Sulawesi",
                    "East Java",
                    "East Kalimantan",
                    "East Nusa Tenggara",
                    "Gorontalo",
                    "Special Capital Region of Jakarta",
                    "Jambi",
                    "Lampung",
                    "Maluku",
                    "North Kalimantan",
                    "North Maluku",
                    "North Sulawesi",
                    "North Sumatra",
                    "Papua",
                    "Riau",
                    "Riau Islands",
                    "Southeast Sulawesi",
                    "South Kalimantan",
                    "South Sulawesi",
                    "South Sumatra",
                    "West Java",
                    "West Kalimantan",
                    "West Nusa Tenggara",
                    "West Papua",
                    "West Sulawesi",
                    "West Sumatra",
                    "Special Region of Yogyakarta"
                ]
            }
        }
    },
    created() {
        this.fetchNationalities()
    },
    methods: {
        fetchNationalities() {
            client.get(endpoints.nationalities)
                .then(({data}) => this.nationalities = data)
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>
