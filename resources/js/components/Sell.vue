<template>
  <div class="row">

    <!-- /.col -->
    <div class="col-md-7">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <input class="form-control form-control-sm" type="text" v-model='search' placeholder="Search item">

          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">


                <!-- items here -->
                <div class="row">
                  <div v-for="p in filteredProduct" class="col-md-4">
                    <h3 class="text-center">{{p.product_name}} - {{p.price}}/=</h3>
                  <button type="button" class="btn btn-info btn-sm btn-block" @click="addToCart(p)">Add To Cart</button>
                  <br>
                  <hr>
                  </div>

                </div>






        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    <div class="col-md-5">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="row">

              <table class="table table-hover table-sm table-striped">
                  <thead>
                      <tr>
                          <th style="width:25%">Product</th>
                          <th style="width:10%">Price</th>
                          <th style="width:8%">Quantity</th>
                          <th style="width:22%" class="text-center">Subtotal</th>
                          <th style="width:10%"></th>
                      </tr>
                  </thead>
                  <tbody>
                      <!-- <p v-if="total==0">Your cart is empty</p> -->

                      <tr v-for="item in cart">
                          <td data-th="Product">

                              <h6 class="nomargin">{{item.product.product_name}}</h6>
                          </td>
                          <td data-th="Price">{{item.product.price}}</td>



                          <!--<td>	<button class="btn btn-info btn-xs"><i class="typcn typcn-plus"></i></button></td>-->
                          <td data-th="Quantity"> <input type="number" class="form-control text-center" name="quantity[]" v-model="item.quantity"></td>
                          <!-- <td>	<button class="btn btn-info btn-xs"><i class="typcn typcn-minus"></i></button></td> -->

                          <td data-th="Subtotal" class="text-center">{{item.product.price * item.quantity}} /=</td>
                          <td class="actions" data-th="">
                              <button class="btn btn-app btn-danger btn-xs" @click="removeFromCart(item)"><i class="fas fa-trash"></i></button>
                          </td>
                      </tr>
                  </tbody>

              </table>

          </div>

                   </div>
                   <div class="card-footer">
                     <div class="table-responsive col-sm-12 totalTab">
                         <table class="table">
                             <tbody>
                                 <tr>
                                     <td class="active" width="40%">Grand Total</td>
                                     <td class="whiteBg" width="60%"><span id="Subtot">{{ cartTotal }} </span> KSH
                                         <span class="float-right"><b id="ItemsNum"><span>{{cartQuantity}}</span> items</b></span>
                                     </td>
                                 </tr>

                             </tbody>
                         </table>

                         <button type="button" @click.prevent="checkout()" class="btn btn-success btn-sm btn-block">
                             <h5 class="text-bold">Pay</h5>
                         </button>
                                 <button type="button" @click="cancel()" class="btn btn-danger btn-sm btn-block">
                                     <h5 class="text-bold">Cancel</h5>
                                 </button>

                     </div>

                   </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
    </div>
    <div v-if="checkoutModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Checkout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <!-- <span aria-hidden="true" @click="closeModal">&times;</span> -->
                                </button>
                            </div>
                            <div class="modal-body">
                                <h2>Walk in Customer</h2>
                                <h3>{{cartQuantity}} items</h3>
                                <h2>Total: Ksh. {{cartTotal}}</h2>

                                <div class="form-group">
                                    <label for="Paid">Amount Paid</label>
                                    <input type="text" value="0" v-model="form.amount" name="paid" class="form-control paidk" id="Paid" placeholder="Paid">
                                </div>

                                <h2 v-if="cartAmount < 0">Change: Ksh. <p style="color:red;">{{cartAmount}} </p>
                                </h2>
                                <h2 v-else>Change: Ksh. <p style="color:blue;">{{cartAmount}}</p>
                                </h2>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>
                                <button type="button" v-if="this.form.amount.length == 0" disabled @click.prevent="submit" class="btn btn-warning">Submit</button>
                                <button type="button" v-else-if="cartAmount<0" disabled @click.prevent="submit" class="btn btn-warning">Submit</button>
                                <button type="button" v-else @click.prevent="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </transition>
    </div>
  </div>

</template>

<script>
    export default {
        name: "Sell",
        data(){
          return{
            checkoutModal: false,
            menu:[],
            cart:[],
            form:{
              quantity:'',
              due:'',
              amount:'',
              total:''
            },
            search:''
          }
        },
        computed:{
          cartTotal: function() {
              var total = 0;
              this.cart.forEach(function(item) {
                  total += item.quantity * item.product.price;

              });
              this.form.total = total;
              return total;

          },
          cartQuantity: function() {
              var quantity = 0;
              this.cart.forEach(function(item) {
                  quantity += item.quantity;
              });
              this.form.quantity = quantity;
              return quantity;
          },
          cartAmount: function() {
              var amount = this.form.amount;
              var due;
              var total = 0;
              this.cart.forEach(function(item) {
                  total += item.quantity * item.product.price;

              });
              due = amount - total;
              this.form.due = due;
              return due;

          },
          filteredProduct: function() { // filter search
              var search = this.search;

              return this.menu.filter(product => {
                  return product.product_name.toLowerCase().includes(search.toLowerCase())
              })

          },
        },
        mounted() {

            this.$Progress.start()
            this.$Progress.finish()
        },
        methods:{
          fetchProducts(){
              axios.get('api/items')
                  .then(({data})=>(this.menu= data));

          },
          addToCart: function(product) {
              var cartItem = this.getCartItem(product);

              if (cartItem != null) {
                  cartItem.quantity++;
              } else {
                  this.cart.push({
                      product: product,
                      quantity: 1,

                  });

              }
              product.quantity--;

          },
          getCartItem: function(product) {
              for (var i = 0; i < this.cart.length; i++) {
                  if (this.cart[i].product.id === product.id) {
                      return this.cart[i];
                  }
              }

              return null;
          },
          removeFromCart: function(cartItem) {
              // this.cart.forEach(function(item){
              //   item.product.quantity+= item.quantity;
              // });
              cartItem.product.quantity += cartItem.quantity;
              var index = this.cart.indexOf(cartItem);

              this.cart.splice(index, 1);

              product.quantity++;


          },

          cancel: function() {
              this.cart = [];
          },
          checkout: function() {
              if (this.cart == 0) {

                  swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Cannot make payment if cart is empty!',
                      //footer: '<a href>Why do I have this issue?</a>'
                  })
              } else{
                this.checkoutModal = true
              }
          },
          closeModal: function() {
              this.checkoutModal = false;
              this.cart = [];
              this.form.total = '';
              this.form.quantity = '';
              this.form.due = '';
              this.form.amount = '';
          },

          submit: function() {

              let details = {
                  form: this.form
              }

              let data = {
                  cart: this.cart
              }

              axios.post('/api/invoice', {
                  data,
                  details,

              }).then(res => {

                  this.checkoutModal = false;

                   this.cart = [];
                   this.form.total = '';
                   this.form.quantity = '';
                   this.form.due = '';
                   this.form.amount = '';
              }).catch(e => {
                  console.log(e);
              })
          },
        },

        created(){
          this.fetchProducts()
        },
    }
</script>


<style lang="css" scoped>
.table>tbody>tr>td, .table>tfoot>tr>td{
vertical-align: middle;
}
@media screen and (max-width: 600px) {
table#cart tbody td .form-control{
width:20%;
display: inline !important;
}
.actions .btn{
width:36%;
margin:1.5em 0;
}

.actions .btn-info{
float:left;
}
.actions .btn-danger{
float:right;
}

table#cart thead { display: none; }
table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
table#cart tbody tr td:first-child { background: #333; color: #fff; }
table#cart tbody td:before {
content: attr(data-th); font-weight: bold;
display: inline-block; width: 8rem;




}
}



table#cart tfoot td{display:block; }
table#cart tfoot td .btn{display:block;}
.messageVide {
    font-size: 25px;
    width: 100%;
    background-color: #c2dae8;
    padding: 1.5em 0;
    border-radius: 5px;
    font-weight: lighter;
    display: inline-block;
    text-align: center;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-header {
    background-color: #34373d;
}
.modal-title {
    color: #fff;
}
.close {
    color: #fff;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
#card-details {
  max-height: calc(100vh - 210px);
    overflow-y: auto;
}
#product-details {
  max-height: calc(100vh - 210px);
    overflow-y: auto;
}
</style>
