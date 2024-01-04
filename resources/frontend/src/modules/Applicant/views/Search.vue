<template>
    <div class="container mt-3">
        <h2>Search Applicants</h2>
        <div class="row">
            <div class="col-6 col-md-2 mb-1">
                <button class="py-3 btn btn-block btn-outline-info">
                    菲律賓
                    <span class="badge badge-info">10</span>
                </button>
            </div>
            <div class="col-6 col-md-2 mb-1">
                <button class="py-3 btn btn-block btn-outline-info">
                    印尼
                    <span class="badge badge-info">10</span>
                </button>
            </div>
            <div class="col-6 col-md-2 mb-1">
                <button class="py-3 btn btn-block btn-outline-info">
                    孟加拉
                    <span class="badge badge-info">10</span>
                </button>
            </div>
            <div class="col-6 col-md-2 mb-1">
                <button class="py-3 btn btn-block btn-outline-info">
                    斯里蘭卡
                    <span class="badge badge-info">10</span>
                </button>
            </div>
            <div class="col-6 col-md-2 mb-1">
                <button class="py-3 btn btn-block btn-outline-info">
                    柬埔寨
                    <span class="badge badge-info">10</span>
                </button>
            </div>
            <div class="col-6 col-md-2 mb-1">
                <button class="py-3 btn btn-block btn-outline-info">
                    本地現成
                    <span class="badge badge-info">10</span>
                </button>
            </div>
        </div>
        <form @submit.prevent="searchApplicants">
            <div class="row mt-3">
                <div class="form-group col-4">
                    <select name="nationality" id="nationality" class="form-control">
                        <option value="">-- 選擇國籍 --</option>
                        <option value="Filipino">菲律賓</option>
                        <option value="indonesia">印尼</option>
                        <option value="bangladesh">孟加拉</option>
                        <option value="sri_lanka">斯里蘭卡</option>
                        <option value="cambodia">柬埔寨</option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <select name="age_range" id="age_range" class="form-control">
                        <option value="">-- 選擇年齡 --</option>
                        <option v-for="val in age_ranges"
                                :key="val"
                                :value="val">{{ val }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <select name="overseas_experience"
                            id="overseas_experience"
                            class="form-control">
                        <option value="">-- 選擇海外工作經驗 --</option>


                        <option v-for="country in overseas_countries"
                                :key="country"
                                :value="country">{{ country }}
                        </option>
                    </select>
                </div>
                <div class="form-group col-4">
                    <input name="applicant_ref_number"
                           id="applicant_ref_number"
                           type="text"
                           class="form-control"
                           placeholder="佣工編號"/>
                </div>
                <div class="form-group col-4">
                    <select name="duties"
                            id="duties"
                            class="form-control">
                        <option value="">-- 選擇技能 --</option>
                        <option v-for="duty in duties"
                                :key="duty.id"
                                :value="duty.id">{{ duty.label }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit"
                            class="btn btn-outline-success">Search
                    </button>
                </div>
            </div>
        </form>
        <section v-if="applicantPaginator" class="result row">
            <div class="col-12 mt-3">
                <h2>Applicants <small>(Total: {{ applicantPaginator.meta.total }})</small></h2>
            </div>
            <div class="col-6" v-for="applicant in applicants"
                 :key="applicant.id">
                <ApplicantSearchItem :applicant="applicant"/>
            </div>
        </section>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "@/modules/Applicant/endpoints";
import duty_endpoints from "@/modules/Duty/endpoints";
import ApplicantSearchItem from "@/modules/Applicant/views/partials/ApplicantSearchItem";


export default {
    name: "Search",
    components: {
        ApplicantSearchItem
    },
    data() {
        return {
            applicantPaginator: null,
            availableApplicants: null,
            overseas_countries: [
                'Taiwan',
                'Singapore',
                'Macau',
                'China',
                'Japan'
            ],
            duties: [],
            age_ranges: [
                '18 - 25',
                '26 - 30',
                '31 +',
            ]
        }
    },
    computed: {
        applicants() {
            return this.applicantPaginator?.data || []
        }
    },
    created() {
        this.fetchApplicantCount()
        this.fetchDuties()
    },
    methods: {
        fetchDuties() {
            client.get(duty_endpoints.all)
                .then(({data}) => this.duties = data)
                .catch(error => console.log(error))
        },
        fetchApplicantCount() {
            client.get(endpoints.count_by_current_location)
                .then(({data}) => this.availableApplicants = data)
                .catch(error => console.log(error))
        },
        searchApplicants(e) {

            let formData = new FormData(e.target)

            let queryString = "?"
            let count = 0
            for (let i of formData.keys()) {
                if (count !== 0) {
                    queryString = queryString + '&'
                }
                queryString = queryString + i + '=' + formData.get(i)
                count = count + 1
            }


            client.get(endpoints.public_search_applicants + queryString)
                .then(({data}) => this.applicantPaginator = data)

        }
    },

}
</script>

<style scoped>

</style>
