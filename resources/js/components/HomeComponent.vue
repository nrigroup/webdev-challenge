<template>
    <div class="container">
        <div class="content-left">
            <h1>Upload File</h1>
            <p>Please upload a CSV file.</p>
            <label v-if="!isUploading" :for="field">
                <div class="btn">
                    Upload
                </div>
            </label>
            <input v-if="!isUploading" name="csv" style="display: none;" type="file" :id="field"
                   @change="uploadFieldChange">
            <p v-if="!error">{{error}}</p>

            <lottie v-if="isUploading" :options="defaultOptions" :height="100" :width="100"
                    @animCreated="handleAnimation"/>
        </div>
        <img class="content-img" src="/img/upload_bg.png" alt="">


    </div>
</template>

<script>

    import Lottie from './lottie.vue';
    import * as animationData from './upload';

    export default {
        mounted() {
            this.uid = '5da600d874582';
            this.getDashboard();
        },
        components: {
            Lottie
        },
        computed: {
            field() {
                return 'csv';
            },
            token() {
                const token = document.head.querySelector('meta[name="csrf-token"]');
                if (token) {
                    return token.content;
                }
            },

            uri() {
                return `/uploads`;
            },
        },
        data() {
            return {
                defaultOptions: {animationData: animationData.default},

                animationSpeed: 1,

                isUploading: false,

                // Store uploaded file
                attachments: null,

                // Each file will need to be sent as FormData element
                data: new FormData(),

                percentCompleted: 0,

                uid: 0,

                error: null,
            }
        },
        methods: {
            handleAnimation: function (anim) {
                this.anim = anim;
            },

            uploadFieldChange(e) {

                if (!this.isUploading) {
                    const files = e.target.files || e.dataTransfer.files;

                    if (!files.length) {
                        return;
                    }

                    this.attachments = files[0];

                    // Reset the form to avoid copying these files multiple times into this.attachments
                    document.getElementById(this.field).value = [];

                    this.submit();
                }


            },
            prepareFields() {

                this.data.append(this.field, this.attachments);

            },
            submit() {

                if (this.attachments.length === 0) {
                    return false;
                }

                this.isUploading = true;

                this.prepareFields();

                const config = {
                    headers: {'Content-Type': 'multipart/form-data', 'X-CSRF-TOKEN': this.token},
                    onUploadProgress: function (progressEvent) {
                        this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        this.$forceUpdate();
                    }.bind(this)
                };

                // Make HTTP request
                axios.post(this.uri, this.data, config)
                    .then((res) => {
                        this.resetData();
                        this.isUploading = false;
                        this.error = null;

                        // Set upload UID
                        this.uid = res.data.uid;

                        this.getDashboard();

                    })
                    .catch((err) => {
                        this.error = err;
                        this.isUploading = false;
                        this.resetData();
                    });

            },
            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.data = new FormData(); // Reset it completely
                this.attachments = null;
            },
            getDashboard() {
                if (this.uid.length === 0) {
                    return;
                }

                const uri = `/dashboard/${this.uid}`;

            }
        }
    }
</script>
