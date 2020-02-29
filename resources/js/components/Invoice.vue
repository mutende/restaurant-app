    <template>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="text-center py-3">Add Items</h4>
                            <form @submit.prevent="addOrder() " @keydown="form.onKeydown($event)">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="orderRef">Order Ref No.</label>
                                    <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('order_ref_no') }" id="orderRef" v-model="form.order_ref_no"  name="order_ref_no" placeholder="Order Ref No">
                                    <has-error :form="form" field="order_ref_no"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="itemInput">Item</label>
                                    <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('item') }" id="itemInput" v-model="form.item" name="item" placeholder="Item">
                                    <has-error :form="form" field="item"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="quantityInput">Quantity</label>
                                    <input type="number" class="form-control" :class="{ 'is-invalid': form.errors.has('quantity') }" id="quantityInput" v-model="form.quantity" name="quantity" placeholder="Quantity">
                                    <has-error :form="form" field="quantity"></has-error>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-8">

                            <h4 class="text-center py-3">Order List</h4>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Order Ref Number</h3>

                                        <div class="card-tools">
                                            <form class="form-inline" @submit.prevent="updateReceived()">

                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="refID" class="mr-2">Select Order Ref Number</label>
                                                    <select class="form-control select" :class="{ 'is-invalid': form2.errors.has('ref_id') }" name="ref_id" v-model="form2.ref_id" id="refID">
                                                        <option v-for="order in oders">{{order.order_ref_no}}</option>
                                                    </select>
                                                    <has-error :form="form2" field="ref_id"></has-error>
                                                </div>
                                                <button type="submit" class="btn btn-primary mb-2">Confirm Received Items</button>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-head-fixed text-nowrap table-hover">
                                            <thead>
                                            <tr>
                                                <th>Ref ID</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Received</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="order in oders" :key="(order.id)">
                                                <td>{{ order.order_ref_no}}</td>
                                                <td>{{ order.item}}</td>
                                                <td>{{ order.quantity}}</td>
                                                <td><i  v-if="order.received" class="fa fa-check text-success" aria-hidden="true"></i><i  v-else class="fa fa-times text-danger" aria-hidden="true"></i></td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </template>


<script>
    export default {
        name: "Invoice",
        mounted() {
            this.$Progress.start()
            this.$Progress.finish()
        },
        data(){

            return{
                oders:{},
                form: new Form({
                    id:'',
                    order_ref_no:'',
                    item:'',
                    quantity:'',
                    received:'',
                }),
                form2: new Form({
                    ref_id:''
                })

            }
        },
        methods: {
            updateReceived(){
                    this.$Progress.start()
                    this.form2.put('api/order/'+this.form2.ref_id)
                        .then( ()=>{
                            Fire.$emit('AfterAction');
                            Toast.fire({
                                icon: 'success',
                                title: 'Orders Updated successfully'
                            })
                            this.$Progress.finish()
                        }).catch(()=>{
                        this.$Progress.fail()
                    })


            },
            addOrder() {
                this.$Progress.start()
                this.form.post('api/order')
                    .then(() => {
                        Fire.$emit('AfterAction');
                        Toast.fire({
                            icon: 'success',
                            title: 'Order created successfully'
                        })
                        this.$Progress.finish()
                        this.form.reset()
                    })
                    .catch()
            },
            fetchOrders() {
                axios.get('api/order')
                    .then(({data}) => (this.oders = data));

            }
        },
            created(){
                this.fetchOrders();
                this.form.reset();
                Fire.$on('AfterAction', ()=>{
                    this.fetchOrders()
                })
            }

    }
</script>

<style scoped>
    .select{
        width:200px !important;
    }

</style>
