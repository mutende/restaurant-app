<template>
    <div class="row">
        <div class="col-md-12">
            <button class=" btn btn-success btn-sm mb-3 py-2" @click="createHotelModal">Add hotel <i class="fa fa-home"></i></button>

        <!--    modal form    -->
            <form @submit.prevent=" editMode ? updateHotel() : addHotel() " @keydown="form.onKeydown($event)">
                <div class="modal fade" id="hotelModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 v-show="!editMode" class="modal-title">Add Hotel</h4>
                                <h4 v-show="editMode" class="modal-title">Update Hotel</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nameInput" >Name</label>
                                    <input type="text"  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" id="nameInput" v-model="form.name" name="name">
                                    <has-error :form="form" field="name"></has-error>
                                </div>


                                <div class="form-group">

                                    <label for="locationInput">Location</label>
                                    <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('location') }" id="locationInput"  v-model="form.location" name="location">
                                    <has-error :form="form" field="location"></has-error>
                                </div>

<!--                                    <div class="form-group">-->
<!--                                        <label for="exampleInputFile">Hotel Logo</label>-->
<!--                                        <div class="input-group">-->
<!--                                            <div class="custom-file">-->
<!--                                                <input type="file" class="form-control" id="exampleInputFile"  name="logo">-->
<!--                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>-->

<!--                                            </div>-->
<!--                                            <div class="input-group-append">-->
<!--                                                <span class="input-group-text" id="">Upload</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                            </div>
                            <input type="hidden" v-model="form.user" name="user">
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="closeModal">Close</button>
                                <button v-show="!editMode" type="submit" class="btn btn-success btn-sm">Save hotel</button>
                                <button v-show="editMode" type="submit" class="btn btn-primary btn-sm">Update hotel</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            </form>
            <!--end form-->
            <!-- end modal form -->

            <div class="col-md-6 offset-md-3">

            <div class="row mt-1 margin-top">

                            <div class="col-lg-3 col-6" v-for="hotel in hotels" :key="hotel.id">
                                <!-- small box -->
                                <div class="card">
                                    <div class="card-info">
                                        <div class="card-header ">
                                            {{hotel.name}}
                                        </div>
                                        <div class="card-body">
                                            {{ hotel.location }}
                                        </div>
                                        <div class="card-footer">
                                            <a href="#" class="mr-2"  @click="editHotelModal(hotel)"> <i class="fa fa-edit text-info"></i> </a>

                                            <a href="#" @click="deleteHotel(hotel.id)"> <i class="fa fa-trash text-danger"></i></a >
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



            </div>

            </div>


        </div>

</template>

<script>
    export default {
        name: "Home",
        mounted() {
            this.$Progress.start()
            this.$Progress.finish()
        },
        data(){

            return{
                editMode:false,
                hotels:{},
                form: new Form({
                    id:'',
                    name:'',
                    location:'',
                    logo:'',
                    user:this.$userId
                }),

            }
        },
        methods:{
            updateHotel(){
              this.$Progress.start()
              this.form.put('api/hotel/'+this.form.id)
                .then( ()=>{
                    Fire.$emit('AfterAction');
                    $('#hotelModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    Toast.fire({
                        icon: 'success',
                        title: 'Hotel Updated successfully'
                    })
                    this.$Progress.finish()
                }).catch(()=>{
                  this.$Progress.fail()
              })
            },
            createHotelModal(){
                this.editMode = false
                this.form.reset()
                $('#hotelModal').modal('show');
            },
            editHotelModal(hotel){
                this.editMode = true
                this.form.reset()
                $('#hotelModal').modal('show');
                this.form.fill(hotel)
            },

            deleteHotel(id){
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
                        this.form.delete('api/hotel/'+id).then(() => {
                            this.$Progress.finish()
                            swal.fire(
                                'Deleted!',
                                'Record Deleted',
                                'success'
                            )

                            Fire.$emit('AfterAction');
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
            fetchHotels(){
                axios.get('api/hotel')
                    .then(({data})=>(this.hotels= data));

            },
            addHotel(){
               this.$Progress.start()
               this.form.post('api/hotel')
                .then(()=>{
                    Fire.$emit('AfterAction');

                    Toast.fire({
                        icon: 'success',
                        title: 'Hotel created successfully'
                    })
                    $('#hotelModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    this.$Progress.finish()

                })
               .catch()
            }
        },
        created(){
            this.fetchHotels();

            Fire.$on('AfterAction', ()=>{
                this.fetchHotels()
            })
        }
    }
</script>

<style scoped>


</style>
