<template>
    <div class="container">
        <div class="dashboard-contents">
            <div class="dashboard-contents-container" v-for="(items, category, index) in spending" :key="index">
                <div class="dashboard-contents-left">
                    {{category}}
                </div>
                <div class="dashboard-contents-right">
                    <ul>
                        <li v-for="item in items" :key="item.id">
                            <div>
                                <img src="/img/calendar.svg" alt="">
                                <span>{{item.month_year}}</span>
                            </div>
                            <div>
                                <img src="/img/dollar.svg" alt="">
                                <span>
                                    {{item.spending_amount}}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.$route.params.uid && this.$route.params.uid.length > 0) {
                this.fetch();
            }
        },
        computed: {
            uri() {
                return `/api/inventories/${this.uid}`;
            }
        },
        data() {
            return {
                uid: '',
                loading: false,
                spending: []
            }
        },
        methods: {
            fetch() {
                this.uid = this.$route.params.uid;
                this.loading = !this.loading;

                axios.get(this.uri)
                    .then((res) => {
                        this.spending = res.data;
                        this.loading = !this.loading;
                    }).catch((err) => {
                    this.loading = !this.loading;
                    alert(err)
                })
            }
        }
    }
</script>
<style scoped>
    .container {
        width: 100%;
        height: 100%;
    }
</style>
