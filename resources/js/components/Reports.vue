<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Sales</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                                <table class="table table-head-fixed text-nowrap table-hover">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in products" :key="product.id">
                                        <td>{{product.product_name}}</td>
                                        <td>{{product.category.category}}</td>
                                        <td>{{product.price}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="float-left">
                                        <button class="btn btn-outline-success print-button" > Print </button>
                                </div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                                <table class="table table-head-fixed text-nowrap table-hover">
                                    <thead>
                                    <tr>
                                        <th>RefID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="sale in sales" :key="sale.id">
                                        <td>{{sale.invoice.invoice_no}}</td>
                                        <td>{{sale.product.product_name}}</td>
                                        <td>{{sale.quantity}}</td>
                                        <td>{{sale.price}}</td>
                                        <td>{{sale.total}}</td>
                                        <td>{{sale.created_at}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>

</template>


<script>
    export default {
        name: "Reports",
        data(){
            return {
                products:[],
                sales:[]
            }
        },
        mounted() {
            this.$Progress.start()
            this.$Progress.finish()
        },
        methods:{
            fetchMenu(){
                axios.get('api/report/menu')
                    .then(({data})=>(this.products= data));

            },

            fetchSales(){
                axios.get('api/report/sales')
                    .then(({data})=>(this.sales= data));
            }
        },
        created() {
            this.fetchMenu()
            this.fetchSales()
        }
    }
</script>

<style scoped>
    .print-button{
        width:200px !important;
    }

</style>
