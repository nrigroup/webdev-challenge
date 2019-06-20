<template>
    <div>
        <div class="alert alert-success" role="alert" v-if="flag.submit">
            Records added! <a href="/">See results.</a>
        </div>
        <hr>
            <input 
                name="file" 
                type="file" 
                id="file" 
                ref="file" 
                v-on:change="handleFileUpload()" 
                v-validate="'required|ext:csv'">
                <span 
                    class="errors" 
                    v-if="errors.has('file')">{{ errors.first('file') }}</span>
            <br>
            <br>
            <button class="btn btn-primary btn-md" v-on:click="submitFile()">Submit</button>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                flag: {
                    submit: false,
                    error: false
                },
                file: ''
            }
        },

        methods: {
            submitFile() {

                this.$validator.validateAll()
                    .then(result => {
                        if (result) {

                            let formData = new FormData();
                            formData.append('file', this.file);

                            axios.post('/api/upload',
                                    formData, {
                                        headers: {
                                            'Content-Type': 'multipart/form-data'
                                        }
                                    }
                                ).then(response => {
                                    console.log(response);
                                    let result = response.data;

                                    if (result.success) {
                                        this.flag.submit = true;
                                        let input = this.$refs.file;
                                        input.type = 'text';
                                        input.type = 'file';
                                    }
                                })
                                .catch(errors => console.log(errors));

                        }
                    });
            },

            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            }
        },

        created: function() {
            this.$validator.localize('en', {
                custom: {
                    file: {
                        required: 'CSV File is required!',
                        ext: 'Please upload file in csv format!'
                    }
                }
            });
        }
    }
</script>


<style scoped lang="scss">
    .errors {
        font-size: 0.9rem;
        color: red;
        font-style: italic;
    }
</style>
