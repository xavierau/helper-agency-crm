<template>
    <div :id="`dropzone_${_uid}`" class="rounded dropzone">
    </div>
</template>

<script>
import Dropzone from 'dropzone'
import 'dropzone/dist/dropzone.css'
import client from "@/client"

export default {
    name: "Dropzone",
    props: {
        url: {
            type: String,
            required: true
        },
        options: {
            type: Object
        },
    },
    data() {
        return {
            dropzone: null,
            token: null
        }
    },
    mounted() {
        client.get('/sanctum/csrf-cookie')
            .then(response => console.log(response))
            .then(() => {
                let options = Object.assign({}, this.options || {})
                options.headers = Object.assign({
                    'X-XSRF-TOKEN': document.cookie
                        .split(';')
                        .reduce((carry, part) => {
                            let partArray = part.split('=')
                            carry[partArray[0]] = decodeURIComponent(partArray[1])

                            return carry
                        }, {})['XSRF-TOKEN']
                }, this.options?.headers || {})
                options.url = this.url

                let vm = this
                options.init = function () {
                    this.on('success', function () {
                        vm.$emit('success')
                    })
                    this.on('error', function () {
                        vm.$emit('error')
                    })
                }
                this.dropzone = new Dropzone(`div#dropzone_${this._uid}`, options);
            })

    },

}
</script>

<style scoped>

</style>
