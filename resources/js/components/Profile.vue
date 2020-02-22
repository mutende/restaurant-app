<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{form.name}}</h3>
                    <h5 class="widget-user-desc">{{form.email}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="dist/img/user2-160x160.jpg" alt="User icon">
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center mt-5">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="name" :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.name" class="form-control" id="inputName" placeholder="Name">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" :class="{ 'is-invalid': form.errors.has('email') }" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label text-sm" style="font-size: 13px !important;">Password</label>
                                    <div class="col-md-9">
                                        <input type="password"  :class="{ 'is-invalid': form.errors.has('password') }" v-model="form.password" name="password" class="form-control" id="inputPassword" placeholder="Blank is unchanged">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" @click.prevent="updateProfile" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                    <!-- /.row -->
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){

            return{

                form: new Form({
                    name:'',
                    email:'',
                    password:''
                }),

            }
        },
        mounted() {

            this.$Progress.start()
            this.$Progress.finish()

        },
        created(){
            axios.get('api/profile')
                .then(({data}) => (this.form.fill(data)));
        },
        methods:{
            updateProfile(){
                this.$Progress.start()
                this.form.put('api/profile')
                .then(() => {
                    swal.fire(
                        'Updated!',
                        'Profile Details Updated',
                        'success'
                    )
                    this.$Progress.finish()
                })
                .catch( ()=> {
                    this.$Progress.fail()
                })
            }
        }
    }
</script>
