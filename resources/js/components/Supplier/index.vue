<template>
    <div>
        <div class="row">
            <router-link to="/store-supplier" class="btn btn-primary">Add Supplier</router-link>

        </div>
        <br>
        <input class="form-control" v-model="searchTerm" style="width: 300px;" type="text" placeholder="Search Here">

        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">

            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Suppliers</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Phone No.</th>
                                    <th>Distributer</th>
                                    <th>Address</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="supplier in filterSearch" :key="supplier.id">
                                    <td>{{supplier.name}}</td>

                                    <td><img :src="supplier.photo" id="supp_photo"></td>
                                    <td>{{supplier.phone}}</td>
                                    <td>{{supplier.shop_name}}</td>
                                    <td>{{supplier.address}}</td>
                                    <!--                                    <td><span class="badge badge-success">Delivered</span></td>-->
                                    <td>
                                        <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
                                        <router-link :to="{name:'edit-supplier', params:{id:supplier.id}}"
                                                     class="btn btn-sm btn-info">Edit
                                        </router-link>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>


    </div>
</template>


<script type="text/javascript">

    export default {

        created() {
            if (!User.loggedIn()) {
                this.$router.push('home')
            }

            this.allSuppliers();

        },
        data() {
            return {
                suppliers: [],
                searchTerm: ''

            }

        },
        computed: {
            filterSearch() {
                return this.suppliers.filter(supplier => {
                    return supplier.name.match(this.searchTerm)

                })
            }
        },
        methods: {
            allSuppliers() {
                axios.get('/api/supplier/')
                    .then(({data}) => (this.suppliers = data))
                    .catch()

            },
            deleteSupplier(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete('/api/supplier/' + id)
                            .then(() => {
                                this.suppliers = this.suppliers.filter(supplier => {
                                    return supplier.id != id;

                                })

                            })
                            .catch(() => {
                                this.$router.push({name: 'supplier'})
                            })
                        Swal.fire(
                            'Deleted!',
                            ' Employee deleted.',
                            'success'
                        )
                    }
                })


            }


        },


    }


</script>


<style type="text/css">
    #supp_photo {
        height: 40px;
        width: 40px;
    }

    a.btn.btn-sm {
        color: white;
    }


</style>
