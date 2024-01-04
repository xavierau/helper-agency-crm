<template>
    <div class="form-group">
        <label>Add Resident</label>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" v-model="new_resident.first_name" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" v-model="new_resident.last_name" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" v-model="new_resident.mobile" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>HK ID</label>
                    <input type="text" class="form-control" v-model="new_resident.hk_id" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" class="form-control" v-model="new_resident.date_of_birth" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Relation</label>
                    <input type="text" class="form-control" v-model="new_resident.relation" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Gender</label>

                    <select type="text" class="form-control" v-model="new_resident.is_male" required>
                        <option :value="true">Male</option>
                        <option :value="false">female</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateResident",
    props: {
        new_resident: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
