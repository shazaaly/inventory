<template>
    <div>
        <div class="row">
            <router-link to="/supplier" class="btn btn-primary">All Suppliers</router-link>

        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update Employee</h1>
                                    </div>
                                    <form class="user" @submit.prevent="supplierUpdate" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter Full Name" v-model="form.name">
                                                    <small class="text-danger"
                                                           v-if="errors.name">{{errors.name[0]}}</small>

                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control"
                                                           placeholder="Enter Your Email" v-model="form.email">
                                                    <small class="text-danger"
                                                           v-if="errors.email">{{errors.email[0]}}</small>


                                                </div>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter Address" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>


                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter Shop name" v-model="form.shop_name">
                                                    <small class="text-danger" v-if="errors.shop_name">{{errors.shop_name[0]}}</small>


                                                </div>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="Enter Phone Number" v-model="form.phone">
                                                    <small class="text-danger"
                                                           v-if="errors.phone">{{errors.phone[0]}}</small>


                                                </div>


                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">

                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                           @change="onFileSelected">

                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>

                                                </div>

                                                <div class="col-md-6">
<!--                                                    <img :src="form.photo" style="height: 40px; width: 40px;">-->
                                                    <img :src="'http://127.0.0.1:8000/' + form.photo" style="height: 40px; width: 40px;">

                                                    <small class="text-danger"
                                                           v-if="errors.photo">{{errors.photo[0]}}</small>


                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>


<script type="text/javascript">

    export default {

        created() {
            if (!User.loggedIn()) {
                this.$router.push('home')

            }
            //    get id :
            let id = this.$route.params.id;
            axios.get('/api/supplier/' + id)
                .then(({data}) => (this.form = data))
                .catch(console.log('error'))
        },
        data() {

            return {
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                    shop_name: '',
                    photo: '',
                },
                errors: {}
            }

        },
        methods: {
            supplierUpdate() {
                let id = this.$route.params.id;
                axios.patch('/api/supplier/' + id, this.form)
                    .then(() => {
                        this.$router.push({name: 'supplier'})
                        Notification.success()
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },

            onFileSelected(event) {
                let file = event.target.files[0]
                if (file.size > 1048770) {
                    Notification.image_validation()
                } else {
                    let reader = new FileReader();
                    reader.onload = event => {
                        this.form.newphoto = event.target.result

                    };
                    reader.readAsDataURL(file);
                }

            }
        }

    }


</script>


<style type="text/css">


</style>
