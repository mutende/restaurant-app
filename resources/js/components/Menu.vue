<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item"><a class="nav-link active" href="#menu-config" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="menu-config">
                            <div class="col-12">

                                <button class=" btn btn-success btn-sm mb-3 py-2" data-toggle="modal" data-target="#addMenu">Add Item <i class="fa fa-list-alt"></i></button>

                                <!-- Modal -->
                                <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <label for="nameInput" >Item Name</label>
                                                    <input type="text"  class="form-control"  id="nameInput"  name="name">
                                                    <has-error :form="form" field="name"></has-error>

                                                    <label for="categoryInput" >Category</label>
                                                    <input type="text"  class="form-control"  id="categoryInput"  name="category">
                                                    <has-error :form="form" field="category"></has-error>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cansel</button>
                                                <button type="button" class="btn btn-success">Add Item</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Menu Items</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Rate</th>
                                                <th>Available</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Tea</td>
                                                <td>Beverage</td>
                                                <td>70%</td>
                                                <td><span class="tag tag-success"><i class="fa fa-check text-success"></i></span></td>

                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Mangoes</td>
                                                <td>Fruits</td>
                                                <td>90%</td>
                                                <td><span class="tag tag-success"><i class="fa fa-times text-danger"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Chicken</td>
                                                <td>Beverage</td>
                                                <td>60%</td>
                                                <td><span class="tag tag-success"><i class="fa fa-times text-danger"></i></span></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Soda</td>
                                                <td>Drinks</td>
                                                <td>95%</td>
                                                <td><span class="tag tag-success"><i class="fa fa-check text-success"></i></span></td>
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
                        <div class="tab-pane" id="timeline">
                            <!--  -->
                            Tab 2
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                           Tab 3
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
        }
    }
</script>

<style scoped>

</style>
