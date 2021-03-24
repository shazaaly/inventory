<template>
    <div>
        <div class="row">
            <router-link to="/employee" class="btn btn-primary">All Employee</router-link>

        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                                    </div>
                                    <form class="user" @submit.prevent="employeeInsert" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="Full Name" v-model="form.name">
                                                    <small class="text-danger"
                                                           v-if="errors.name">{{errors.name[0]}}</small>

                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control"
                                                           placeholder=" Email" v-model="form.email">
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
                                                           placeholder="Sallery" v-model="form.sallery">
                                                    <small class="text-danger" v-if="errors.sallery">{{errors.sallery[0]}}</small>


                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control"
                                                           placeholder="Joining Date" v-model="form.joining_date">
                                                    <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</small>


                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="Title" v-model="form.nid">
                                                    <small class="text-danger"
                                                           v-if="errors.nid">{{errors.nid[0]}}</small>


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
                                                    <img :src="form.photo" style="height: 40px; width: 40px;">
                                                    <small class="text-danger"
                                                           v-if="errors.photo">{{errors.photo[0]}}</small>


                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
        },
        data() {

            return {
                form: {
                    name: null,
                    email: null,
                    phone: null,
                    address: null,
                    sallery: null,
                    photo: null,
                    nid: null,
                    joining_date: null,
                },
                errors: {}
            }

        },
        methods: {
            employeeInsert() {
                axios.post('/api/employee', this.form)
                    .then(() => {
                        this.$router.push({name: 'employee'})
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
                        this.form.photo = event.target.result
                        console.log(event.target.result);

                    };
                    reader.readAsDataURL(file);
                }

            }
        }

    }


</script>


<style type="text/css">


</style>
