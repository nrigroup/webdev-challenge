<template>
    <div>
        <h2>Auction Data</h2>
        <a href="/upload" class="btn btn-primary btn-sm my-3">Upload Records</a>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Lot Title</th>
                        <th>Lot Location</th>
                        <th>Lot Condition</th>
                        <th>Pre Tax Amount</th>
                        <th>Tax Name</th>
                        <th>Tax Amount</th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-for="(record, index) in records" :key="index">
                        <td v-html="index + 1"></td>
                        <td v-html="record.date"></td>
                        <td v-html="record.category"></td>
                        <td v-html="record.lot_title"></td>
                        <td v-html="record.lot_location"></td>
                        <td v-html="record.lot_condition"></td>
                        <td v-html="record.pre_tax_amount"></td>
                        <td v-html="record.tax_name"></td>
                        <td v-html="record.tax_amount"></td>
                    </tr>
                </tbody>
            </table>

            <paginate 
                :pageCount="10"
                :containerClass="'pagination'"
                :clickHandler="clickCallback">
            </paginate>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['records'],

        components: {},

        data: function () {
            return {
                flag: {
                    submit: false,
                },

                form: {
                    input: {
                        fields: {

                        },

                        errors: {
                            fields: {

                            },

                            messages: {

                            },
                        },
                    }
                },
            }
        },

        computed: {},

        created: function () {},

        methods: {
            clickCallback: function(page) {
                console.log(page)
            }
        },

        mounted: function () {
            console.log(this.records);
        }
    }
</script>

<style scoped lang="scss">
    table {
        font-size: 0.6rem;
    }
</style>
