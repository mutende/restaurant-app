<template>
<div class="col-md-12">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 v-if="hotels > 9">{{ hotels }}</h3>
                    <h3 v-else> 0{{ hotels }}</h3>
                    <p v-if="hotels > 1">Number of Hotels</p>
                    <p v-else>Hotel</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <router-link to="/hotels" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 v-if="categories > 9">{{categories}}</h3>
                    <h3 v-else> 0{{categories}}</h3>

                    <p v-if="categories > 1">Different Meal Categories</p>
                    <p v-else> Meal Category</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <router-link to="/menu" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 v-if="menu > 9">{{ menu }}</h3>
                    <h3 v-else>0{{ menu}}</h3>

                    <p>Menu Items</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <router-link to="/menu" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 v-if="staff > 9">{{ staff }}</h3>
                    <h3 v-else>0{{ staff}}</h3>

                    <p v-if="staff > 1">Staff Members</p>
                    <p v-else>Staff Member</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <router-link to="/profile" class="small-box-footer">Manage Your  Profile <i class="fas fa-arrow-circle-right"></i></router-link>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="text-center"> <strong> Daily Sales Report Summery</strong></h3>
            <line-chart :chart-data="dataCollection"></line-chart>
        </div>
        <div class="col-md-6">
            <h3 class="text-center"> <strong>Menu Items Comparison</strong></h3>
            <line-chart :chart-data="dataCollection2"></line-chart>
        </div>
    </div>
</div>
</template>

<script>
    import LineChart from './LineChart.js'

    export default {
        name: "Dashboard",
        components: {
            LineChart
        },
        data(){
            return {
                allData:{},
                staff :'',
                menu:'',
                categories:'',
                hotels:'',
                salesReport:null,
                dataCollection: null,
                dataCollection2:null,
                productRating:null,

        }
        },
        mounted() {
            this.$Progress.start()
            this.$Progress.finish()

        },
        methods:{
            getEverything() {
                axios.get('api/dashboard')
                    .then(({data}) => (this.allData = data))
                    .then(() => this.categories = this.allData.categories)
                    .then(() => this.hotels = this.allData.hotels)
                    .then(() => this.staff = this.allData.users)
                    .then(() => this.menu = this.allData.menu.length)
                    .then(() => this.salesReport = this.allData.sales)
                    .then(() => {
                        let mydata = this.salesReport
                        let values = []
                        let mylables = []
                        for(let i = 0; i<mydata.length; i++){
                            values.push(mydata[i].total)
                            mylables.push(mydata[i].created_at)
                        }

                        this.dataCollection = {
                            labels:mylables,
                            datasets: [
                                {
                                    label: 'Daily Sales Report',
                                    backgroundColor: '#f87979',
                                    data: values
                                }
                            ]
                        }

                    })
                    .then(() => this.productRating = this.allData.menu)
                    .then(() => {
                        let mydata =  this.productRating
                        let values = []
                        let mylables = []
                        for(let i = 0; i<mydata.length; i++){
                            values.push(mydata[i].price)
                            mylables.push(mydata[i].product_name)
                        }

                        this.dataCollection2 = {
                            labels:mylables,
                            datasets: [
                                {
                                    label: 'Prducts Prices Compared',
                                    backgroundColor: '#228B22',
                                    data: values
                                }
                            ]
                        }

                    })
                    .catch(() => {
                        swal.fire(
                            'Warning!',
                            'No data to draw charts currently',
                            'warning'
                        )
                    })

            }},
        created() {
            this.getEverything()
            // this.fetchSales()
            // this.fillData()

        }
    }
</script>

<style scoped>

    .chart{
        max-height: 600px;
    }

</style>
