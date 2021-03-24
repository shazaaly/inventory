<template>
    <div>
        <div class="row">
            <router-link to="/store-product" class="btn btn-primary">Add Product</router-link>

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
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Product</th>
                                    <th> Code</th>

                                    <th>Category</th>
                                    <th>Supplier</th>

<!--                                    <th>Root</th>-->
                                    <th style="text-align: center">Buy LE.</th>
                                    <th style="text-align: center">Sell LE.</th>
                                    <th style="text-align: center">Buying Date</th>
                                    <th>Image</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in filterSearch" :key="product.id">
                                    <td>{{product.product_name}}</td>
                                    <td>{{product.product_code}}</td>
                                    <td>{{product.category_name}}</td>
                                    <td>{{product.name}}</td>
<!--                                    <td>{{product.root}}</td>-->
                                    <td>{{product.buying_price}}</td>
                                    <td>{{product.selling_price}}</td>
                                    <td>{{product.buying_date}}</td>
                                    <td><img :src="product.image" id="product_image" style="width: 70px; height: 70px;"></td>
                                    <!--                                    <td><span class="badge badge-success">Delivered</span></td>-->
                                    <td>
                                        <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">Delete</a>

                                        <router-link :to="{name:'edit-product', params:{id:product.id}}"
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

            this.allProducts();

        },
        data() {
            return {
                products: [],
                categories: [],
                suppliers: [],
                searchTerm: ''

            }

        },
        computed: {
            filterSearch() {
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)

                })
            }
        },
        methods: {
            allProducts() {
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()

            },
            deleteProduct(id) {
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
                        axios.delete('/api/product/' + id)
                            .then(() => {
                                this.products = this.products.filter(product => {
                                    return product.id != id;

                                })

                            })
                            .catch(() => {
                                this.$router.push({name: 'product'})
                            })
                        Swal.fire(
                            'Deleted!',
                            ' Product deleted.',
                            'success'
                        )
                    }
                })


            }


        },


    }


</script>


<style type="text/css">
    #em_photo {
        height: 40px;
        width: 40px;
    }

    a.btn.btn-sm {
        color: white;
    }


</style>
