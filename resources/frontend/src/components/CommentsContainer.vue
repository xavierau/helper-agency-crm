<template>
    <div class="CommentsContainer">
        <h4>Comments
            <button @click="show = true" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>
            </button>
        </h4>

        <section v-if="commentPaginator">
            <CommentItem :comment="c"
                         v-for="c in comments"
                         :key="c.id"/>
        </section>

        <CModal :show.sync="show"
                title="Add Comment">

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" v-model="comment"></textarea>
            </div>

            <template #footer>
                <button class="btn btn-secondary" @click="show = false">Close</button>
                <button class="btn btn-success" @click="submit">Success</button>
            </template>

        </CModal>
    </div>
</template>

<script>
import client from "@/client";
import CommentItem from "@/components/Comment";

export default {
    name: "CommentsContainer",
    components: {CommentItem},
    props: {
        url: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            show: false,
            commentPaginator: null,
            comment: null
        }
    },
    computed: {
        comments() {
            return this.commentPaginator.data
        }
    },
    created() {
        this.fetchComments()
    },
    methods: {
        fetchComments() {
            client.get(this.url)
                .then(({data}) => this.commentPaginator = data)
                .catch(error => console.log(error.message))
        },
        submit() {
            client.post(this.url, {content: this.comment})
                .then(() => this.fetchComments())
                .then(() => this.show = false)
                .then(() => this.comment = null)
                .catch(error => console.log(error.message))
        }
    }
}
</script>

<style scoped>
.CommentsContainer {
    max-height: 800px;
    overflow-y: scroll
}

</style>
