<template>
    <div class="NewClientForm">

        <div class="form-group">
            <label>Prefix</label>
            <select class="form-control" v-model="formData.prefix">
                <option value="ms">Ms.</option>
                <option value="mr">Mr.</option>
                <option value="mrs">Mrs.</option>
            </select>
        </div>

        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" v-model="formData.first_name">
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" v-model="formData.last_name">
        </div>

        <div class="form-group">
            <label>Chinese First Name</label>
            <input type="text" class="form-control" v-model="formData.chinese_first_name">
        </div>

        <div class="form-group">
            <label>Chinese Last Name</label>
            <input type="text" class="form-control" v-model="formData.chinese_last_name">
        </div>

        <div class="form-group">
            <label>Occupation</label>
            <input type="text" class="form-control" v-model="formData.occupation">
        </div>

        <div class="form-group">
            <label>Date of birth</label>
            <input type="date" class="form-control" v-model="formData.date_of_birth">
        </div>
        <div class="form-group">
            <label>Place of birth</label>
            <input type="text" class="form-control" v-model="formData.place_of_birth">
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" v-model="formData.is_male">
                <option :value="null">Pls select</option>
                <option :value="true">Male</option>
                <option :value="false">Female</option>
            </select>
        </div>


        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" v-model="formData.email">
        </div>
        <div class="form-group">
            <label>Telephone</label>
            <input type="tel" class="form-control" v-model="formData.tel">
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="tel" class="form-control" v-model="formData.mobile">
        </div>


        <div class="form-group">
            <label>Company Name</label>
            <input type="text" class="form-control" v-model="formData.company_name">
        </div>
        <div class="form-group">
            <label>Marital Status</label>
            <select class="form-control" v-model="formData.marital_status">
                <option value="single">Single</option>
                <option value="married">Married</option>
            </select>
        </div>
        <div class="form-group">
            <label>HK ID</label>
            <input type="text" class="form-control" v-model="formData.hk_id">
        </div>

        <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" v-model="formData.nationality">
        </div>

        <div class="form-group">
            <label>Client Number</label>
            <input type="text" class="form-control" v-model="formData.client_number">
        </div>

    </div>
</template>

<script>
export default {
    name: "NewClientForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
