<template>
    <div>
        <div class="row">
            <router-link to="/store-expense" class="btn btn-primary">Add Expenses</router-link>

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
                            <h6 class="m-0 font-weight-bold text-primary">Expenses</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="expense in filterSearch" :key="expense.id">
                                    <td>{{expense.details}}</td>

                                    <td>{{expense.amount}}</td>
                                    <td>{{expense.expense_date}}</td>
                                    <!--                                    <td><span class="badge badge-success">Delivered</span></td>-->
                                    <td>
                                        <a @click="deleteExpence(expense.id)" class="btn btn-sm btn-danger">Delete</a>

                                        <router-link :to="{name:'edit-expense', params:{id:expense.id}}"
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

            this.allExpenses();

        },
        data() {
            return {
                expenses:[],
                searchTerm: ''

            }

        },
        computed: {
            filterSearch() {
                return this.expenses.filter(expense => {
                    return expense.details.match(this.searchTerm)

                })
            }
        },
        methods: {
            allExpenses() {
                axios.get('/api/expense/')
                    .then(({data}) => (this.expenses = data))
                    .catch()

            },
            deleteExpence(id) {
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
                        axios.delete('/api/expense/' + id)
                            .then(() => {
                                this.expenses = this.expenses.filter(expense => {
                                    return expense.id != id;

                                })

                            })
                            .catch(() => {
                                this.$router.push({name: 'expense'})
                            })
                        Swal.fire(
                            'Deleted!',
                            ' Expense deleted.',
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
