<template>
    <div class="form-group" :class="size">
        <label>Highest Education</label>
        <select :name="name" id="highest_education"
                class="form-control"
                @input="$emit('input', $event.target.value)">
            <option :value="null" :selected="!value">--- Please select ---</option>
            <option value="primary" :selected="value==='primary'">Primary</option>
            <option value="secondary" :selected="value==='secondary'">Secondary</option>
            <option value="university" :selected="value==='university'">University</option>
        </select>

    </div>
</template>

<script>
export default {
    name: "HighestEducation",
    props: {
        name: {
            type: String,
            default: 'highest_education'
        },
        value: {
            type: String,
            default: null
        },
        size: {
            type: String,
            default: 'col-12'
        }
    }
}
</script>
