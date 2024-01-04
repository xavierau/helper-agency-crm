<template>
    <div class="Comment card">
        <div class="card-body">
            <div>{{ comment.content }}</div>
        </div>
        <div class="card-footer text-right">
            <small>
                {{ comment.author.name }} <br>
                {{ comment.created_at | formatDate("d/M/Y H:mm") }}
            </small>
        </div>
    </div>
</template>

<script>
import {formatDate} from '@/filters/common'

export default {
    name: "Comment",
    props: {
        comment: {
            type: Object,
            required: true
        }
    },
    filters: {formatDate}
}
</script>

<style scoped>
</style>
