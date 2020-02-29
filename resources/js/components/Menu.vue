<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item"><a class="nav-link active" href="#categories" data-toggle="tab">Meal Categories</a></li>
                        <li class="nav-item"><a class="nav-link" href="#menu" data-toggle="tab">Menu Items</a></li>
                        <!-- <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">Settings</a></li> -->
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="categories">
                          <div class="col-12">

                              <button class=" btn btn-success btn-sm mb-3 py-2" data-toggle="modal" data-target="#categoryModal">Add Category <i class="fa fa-list-alt"></i></button>

                              <!-- Modal -->
                              <form @submit.prevent=" editCategoryMode ? updateCategory() : addCategory() " @keydown="category.onKeydown($event)">
                                <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="categoryInput1" >Category</label>
                                                    <input type="text"  class="form-control" :class="{ 'is-invalid': category.errors.has('category') }" id="categoryInput1" v-model="category.category" name="name">
                                                    <has-error :form="form" field="category"></has-error>



                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                                                <button v-show="!editCategoryMode" type="submit" class="btn btn-success btn-sm">Save category</button>
                                                <button v-show="editCategoryMode" type="submit" class="btn btn-primary btn-sm">Update category</button>                                            </div>
                                        </div>
                                    </div>
                                </div>

                              </form>



                              <div class="card">
                                  <div class="card-header">
                                      <h3 class="card-title">Categories</h3>

                                      <div class="card-tools">
                                          <div class="input-group input-group-sm" style="width: 150px;">
                                              <input type="text" v-model="category_search" name="table_search" class="form-control float-right" placeholder="Search" @keyup="catgorySearch">

                                              <div class="input-group-append">
                                                  <button @click="catgorySearch" type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0">
                                      <table class="table table-hover text-nowrap">
                                          <thead>
                                          <tr>

                                              <th>Category</th>
                                              <th>Action</th>

                                          </tr>
                                          </thead>
                                          <tbody>
                                          <tr v-for="c in categories" :key="(c.id)">

                                              <td>{{c.category}}</td>
                                              <td>
                                                <a href="#" class="mr-2"  @click="editCategoryModal(c)"> <i class="fa fa-edit text-info"></i> </a>

                                                <a href="#" @click="deleteCategory(c.id)"> <i class="fa fa-trash text-danger"></i></a >
                                              </td>

                                          </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->

                              </div>
                              <!-- /.card -->
                          </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="menu">
                          <div class="col-12">
                              <button class=" btn btn-success btn-sm mb-3 py-2" data-toggle="modal" data-target="#menuModal">Add Item <i class="fa fa-list-alt"></i></button>
                              <form @submit.prevent=" editMode ? updateMenu() : addMenu() " @keydown="form.onKeydown($event)">
                                <div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 v-show="!editMode" class="modal-title">Add Menu</h4>
                                              <h4 v-show="editMode" class="modal-title">Update Menu</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="productInput" >Product Name</label>
                                                    <input type="text"  class="form-control" :class="{ 'is-invalid': form.errors.has('product_name') }" id="productInput" v-model="form.product_name" name="product_name">
                                                    <has-error :form="form" field="product_name"></has-error>

                                                    <label for="categoryInput" >Category</label>
                                                    <select class="form-control" :class="{ 'is-invalid': form.errors.has('category') }" id="categoryInput"  v-model="form.category" name="category" >
                                                      <option value="">Choose category</option>
                                                       <option v-for="(c, index) in categories" :value="c.id">{{ c.category }}</option>
                                                    </select>
                                                    <has-error :form="form" field="category"></has-error>

                                                    <label for="priceInput" >Price</label>
                                                    <input type="number"  class="form-control" :class="{ 'is-invalid': form.errors.has('price') }" id="priceInput" v-model="form.price" name="price">
                                                    <has-error :form="form" field="price"></has-error>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                <button v-show="!editMode" type="submit" class="btn btn-success btn-sm">Save menu</button>
                                                <button v-show="editMode" type="submit" class="btn btn-primary btn-sm">Update menu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              </form>
                              <!-- Modal -->



                              <div class="card">
                                  <div class="card-header">
                                      <h3 class="card-title">Menu Items</h3>

                                      <div class="card-tools">
                                          <div class="input-group input-group-sm" style="width: 150px;">
                                              <input type="text" v-model = "menu_search" name="table_search" class="form-control float-right" placeholder="Search" @keyup="menuSearch">

                                              <div class="input-group-append">
                                                  <button @submit="menuSearch" type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0">
                                      <table class="table table-hover text-nowrap">
                                          <thead>
                                          <tr>

                                              <th>Name</th>
                                              <th>Category</th>
                                              <th>Price</th>
                                              <th>Action</th>

                                          </tr>
                                          </thead>
                                          <tbody>
                                          <tr v-for="p in products.data" :key="(p.id)">

                                              <td>{{p.product_name}}</td>
                                              <td>{{p.category.category}}</td>
                                              <td>{{p.price}}</td>

                                              <!-- <td><span class="tag tag-success"><i class="fa fa-check text-success"></i></span></td> -->
                                              <td>

                                                <a href="#" class="mr-2"  @click="editmenuModal(p)"> <i class="fa fa-edit text-info"></i> </a>

                                                <a href="#" @click="deleteMenu(p.id)"> <i class="fa fa-trash text-danger"></i></a >
                                              </td>
                                          </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->
                                  <div class="card-footer">
                                      <div class="card-tools py-1 float-right">
                                          <pagination :data="products" @pagination-change-page="getProducts"></pagination>
                                      </div>

                                  </div>
                              </div>
                              <!-- /.card -->
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
        name: "Menu",
        mounted() {
            this.$Progress.start()
            this.$Progress.finish()
        },
        data(){
          return{
            editCategoryMode:false,
            editMode:false,
            products:{},
            categories:[],
            category: new Form({
                id:'',
              category:''
            }),
            form: new Form({
                id:'',
                product_name:'',
                price:'',
                category_id:'',


            }),
              category_search:'',
              menu_search:'',
          }
        },
        methods:{
            catgorySearch: _.debounce(()=> {
                Fire.$emit('searchCategory')
            },1000),
            menuSearch: _.debounce(()=> {
                Fire.$emit('searchMenu')
            },1000),
            getProducts(page = 1) {
                axios.get('api/menu?page=' + page)
                    .then(data => {
                        this.products = data.data;
                    });
            },
            updateMenu(){
              this.$Progress.start()
              this.form.put('api/menu/'+this.form.id)
                .then( ()=>{
                    Fire.$emit('AfterMenuAction');
                    $('#menuModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    Toast.fire({
                        icon: 'success',
                        title: 'Menu Updated successfully'
                    })

                    this.form.reset()
                    this.$Progress.finish()
                    this.editMode = false
                }).catch(()=>{
                  this.$Progress.fail()
              })
            },
            updateCategory(){
              this.$Progress.start()
              this.category.put('api/category/'+this.category.id)
                .then( ()=>{
                    Fire.$emit('AfterMenuCategoryAction');
                    $('#categoryModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    Toast.fire({
                        icon: 'success',
                        title: 'Category Updated successfully'
                    })
                    this.category.reset()
                    this.editCategoryMode = false
                    this.$Progress.finish()
                }).catch(()=>{
                  this.$Progress.fail()
              })
            },
            createmenuModal(){
                this.editMode = false
                this.form.reset()
                $('#menuModal').modal('show');
            },
            createcategoryModal(){
                this.editCategoryMode = false
                this.category.reset()
                $('#categoryModal').modal('show');
            },
            editmenuModal(menu){
                this.editMode = true
                this.form.reset()
                $('#menuModal').modal('show');
                this.form.fill(menu)
            },
            editCategoryModal(category){
                this.editCategoryMode = true
                this.category.reset()
                $('#categoryModal').modal('show');
                this.category.fill(category)
            },

            deleteMenu(id){
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if(result.value) {
                        this.$Progress.start()
                        this.form.delete('api/menu/'+id).then(() => {
                            this.$Progress.finish()
                            swal.fire(
                                'Deleted!',
                                'Record Deleted',
                                'success'
                            )

                            Fire.$emit('AfterMenuAction');
                        }).catch(() => {
                            this.$Progress.fail()
                            swal.fire(
                                'Failed!',
                                'Something went wrong',
                                'warning'
                            )
                        })
                    }


                })

            },
            deleteCategory(id){
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if(result.value) {
                        this.$Progress.start()
                        this.category.delete('api/category/'+id).then(() => {
                            this.$Progress.finish()
                            swal.fire(
                                'Deleted!',
                                'Record Deleted',
                                'success'
                            )

                            Fire.$emit('AfterMenuCategoryAction');
                        }).catch(() => {
                            this.$Progress.fail()
                            swal.fire(
                                'Failed!',
                                'Something went wrong',
                                'warning'
                            )
                        })
                    }


                })

            },
            fetchMenu(){
                axios.get('api/menu')
                    .then(({data})=>(this.products= data));

            },
            fetchCategory(){
                axios.get('api/category')
                    .then(({data})=>(this.categories= data));

            },
            addMenu(){
               this.$Progress.start()
               this.form.post('api/menu')
                .then(()=>{
                    Fire.$emit('AfterMenuAction');

                    Toast.fire({
                        icon: 'success',
                        title: 'Menu created successfully'
                    })
                    $('#menuModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    // this.fetchMenu()
                    this.$Progress.finish()

                })
               .catch()
            },
            addCategory(){
               this.$Progress.start()
               this.category.post('api/category')
                .then(()=>{
                    Fire.$emit('AfterMenuCategoryAction');

                    Toast.fire({
                        icon: 'success',
                        title: 'Category created successfully'
                    })
                    $('#categoryModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.form.reset()
                    this.$Progress.finish()

                })
               .catch()
            },
        },
        created(){
            this.fetchMenu();
            this.fetchCategory();
            Fire.$on('searchCategory', ()=>{
                let query = this.category_search;

                axios.get('api/searchcategory?q='+ query)
                .then( (data)=> {
                    this.categories = data.data
                })
                .catch(() => {
                    this.$Progress.fail()
                    swal.fire(
                        'Failed!',
                        'Something went wrong',
                        'warning'
                    )
                })
            })

            Fire.$on('searchMenu', ()=>{
                let query = this.menu_search;

                axios.get('api/searchmenu?q='+ query)
                    .then( (data)=> {
                        this.products = data.data
                    })
                    .catch(() => {
                        this.$Progress.fail()
                        swal.fire(
                            'Failed!',
                            'Something went wrong',
                            'warning'
                        )
                    })
            })
            Fire.$on('AfterMenuAction', ()=>{
                this.fetchMenu()
            })

            Fire.$on('AfterMenuCategoryAction', ()=>{
                this.fetchCategory()
            })
        }
    }
</script>

<style scoped>

</style>
