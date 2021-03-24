<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>

            <div class="row mb-3">


                <!-- Area Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                            <a class="btn btn-sm btn-info" href="">Add Customer</a>
                        </div>
                        <div class="table-responsive" style="font-size: 14px;">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty.</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="cart in carts" :key="cart.id">
                                    <td>{{cart.pro_name}}</td>
                                    <td><input style="width:15px;" type="text" readonly :value="cart.pro_quantity">
                                        <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success">+
                                        </button>
                                        <button v-if="cart.pro_quantity >= 2" @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger">-
                                        </button>

                                        <button v-else="" disabled=""   class="btn btn-sm btn-danger">-
                                        </button>
                                    </td>


                                    <td>{{cart.pro_price}}</td>
                                    <td>{{cart.subtotal}}</td>
                                    <td><a @click="removeItem(cart.id)"
                                           class="btn btn-sm btn-primary"><strong>X</strong></a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total
                                    Quantity:
                                    <strong>{{qty}}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                                    <strong>{{subtotal}} $</strong>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
                                    <strong>{{vats.vat}} %</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total :
                                    <strong>{{ subtotal *vats.vat / 100 + subtotal}}
                                    </strong>
                                </li>


                            </ul>
                            <br>
                            <form>

                                <label>Customer Name</label>
                                <select class="form-control" v-model="customer_id">
                                    <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                        {{customer.name}}
                                    </option>

                                </select>
                                <br>

                                <label>Pay</label>
                                <input type="text" class="form-control" required v-model="pay">

                                <label>Due</label>
                                <input type="text" class="form-control" required v-model="due">

                                <label>Payment Method:</label>
                                <select class="form-control" v-model="customer_id">
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheques</option>
                                    <option value="gift">Gift Cart</option>

                                </select>
                                <br>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </form>

                        </div>


                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>


                        </div>
                        <!--                        Bootstrap tabs categorize products-->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">All products</a>
                            </li>
                            <li v-for="category in categories" :key="category.id" class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false" @click="subproduct(category.id)">{{category.category_name}}</a>
                            </li>
                        </ul>
                        <!-- end                       Bootstrap tabs categorize products-->

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <input class="form-control" v-model="searchTerm" style="width: 300px;" type="text"
                                           placeholder="Search Product">


                                    <div class="row">
                                        <div v-for="product in filterSearch" :key="product.id"
                                             class="col-lg-3 col-md-3 col-sm-6">
                                            <button class="btn btn-sm btn-info" @click.prevent="AddToCart(product.id)">
                                                <div class="row">
                                                    <div class="card" style="width: 8.5rem; margin-bottom: 5px">
                                                        <img class="card-img-top" :src="product.image" id="pos_photo"
                                                             alt="Card image cap">
                                                        <div class="card-body">
                                                            <h6 class="card-title">{{product.product_name}}</h6>
                                                            <span v-if="product.product_quantity > 10"
                                                                  class="badge badge-success">Available {{product.product_quantity}}</span>

                                                            <span
                                                                v-else-if="product.product_quantity >1 && product.product_quantity < 5"
                                                                class="badge badge-warning">Low</span>
                                                            <span v-else
                                                                  class="badge badge-danger">Stock Out</span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </button>
                                        </div>


                                    </div>


                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input class="form-control" v-model="searchTerm" style="width: 300px;" type="text"
                                       placeholder="Search Product">


                                <div class="row">
                                    <div v-for="subproduct in getfilterSearch" :key="subproduct.id"
                                         class="col-lg-3 col-md-3 col-sm-6">
                                        <a href="#">
                                            <div class="row">
                                                <button class="btn btn-sm btn-info" @click.prevent="AddToCart(subproduct.id)">

                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px">
                                                    <img class="card-img-top" :src="subproduct.image" id="em_photo"
                                                         alt="Card image cap">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{subproduct.product_name}}</h6>
                                                        <span v-if="subproduct.product_quantity > 10"
                                                              class="badge badge-success">Available {{subproduct.product_quantity}}</span>

                                                        <span
                                                            v-else-if="subproduct.product_quantity >1 && subproduct.product_quantity < 5"
                                                            class="badge badge-warning">Low</span>
                                                        <span v-else
                                                              class="badge badge-danger">Stock Out</span>
                                                    </div>
                                                </div>
                                                </button>


                                            </div>
                                        </a>
                                    </div>


                                </div>


                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Invoice Example -->

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
            this.allCategories();
            this.allCustomer();
            this.cartProduct();
            Reload.$on('AfterAdd', () => {
                this.cartProduct();
            })

            this.vat();

        },
        data() {
            return {
                products: [],
                categories: [],
                subproducts: [],
                searchTerm: '',
                customers: '',
                carts: [],
                error: '',
                vats:''

            }

        },
        computed: {
            filterSearch() {
                return this.products.filter(product => {
                    return product.product_name.match(this.searchTerm)

                })
            },
            getfilterSearch() {
                return this.subproducts.filter(subproduct => {
                    return subproduct.product_name.match(this.searchTerm)

                })
            },

            qty(){
                let sum =0;
                for (let i = 0; i<this.carts.length; i++ ){
                    sum+= (parseFloat(this.carts[i].pro_quantity))
                }

                return sum;
            },

            subtotal(){
                let sum =0;
                for (let i = 0; i<this.carts.length; i++ ){
                    sum+= (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].pro_price) )
                }

                return sum;


            }
        },
        methods: {
            allProducts() {
                axios.get('/api/product/')
                    .then(({data}) => (this.products = data))
                    .catch()

            },

            allCategories() {
                axios.get('/api/category/')
                    .then(({data}) => (this.categories = data))
                    .catch()

            },

            subproduct(id) {
                axios.get('/api/sub/product/' + id)
                    .then(({data}) => (this.subproducts = data))
                    .catch()

            },
            allCustomer() {
                axios.get('/api/customer/')
                    .then(({data}) => (this.customers = data))
                    .catch(console.log('error'))
            },
            //    cart Method:
            AddToCart(id) {
                axios.get('/api/addToCart/' + id)
                    .then(() => {
                        //Reload is  globally in app.js
                        Reload.$emit('AfterAdd')
                        Notification.cart_success()


                    })
                    .catch()

            },
            //    end Cart
            cartProduct() {
                axios.get('api/cart/product/')
                    .then(({data}) => this.carts = data)
                    .catch()


            },

            removeItem(id) {
                axios.get('api/remove/cart/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd')
                        Notification.cart_delete()

                    })
            },
            increment(id) {
                axios.get('api/increment/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd');
                        Notification.success()
                    })
                    .catch()


            },
            decrement(id) {
                axios.get('api/decrement/' + id)
                    .then(() => {
                        Reload.$emit('AfterAdd');
                        Notification.success()
                    })
                    .catch()


            },
            vat(){
                axios.get('/api/vats/')
                .then(({data})=> (this.vats = data))
                .catch()
            }


        },


    }


</script>


<style type="text/css" scoped>
    #pos_photo, #em_photo {
        height: 100px;
        width: 134px;
    }

    a.btn.btn-sm {
        color: white;
    }

    #profile > div {
        margin-left: 1rem;
    }

    input {
        margin-bottom: 5px;
        margin-left: 5px;
        margin-top: 5px;
    }


</style>
