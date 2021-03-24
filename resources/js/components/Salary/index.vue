<template>
    <div>
        <div class="row">
            <router-link to="/given-salary" class="btn btn-primary">Pay Salary</router-link>

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
                            <h6 class="m-0 font-weight-bold text-primary">Salaries Details</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Month</th>
                                    <th>Details</th>


                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="salary in filterSearch" :key="salary.id">
                                    <td>{{salary.salary_month}}</td>


                                    <!--                                    <td><span class="badge badge-success">Delivered</span></td>-->
                                    <td>
                                        <router-link :to="{name:'view-salary', params:{id:salary.salary_month}}"
                                                     class="btn btn-sm btn-info">View Salary
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

            this.allSalary();

        },
        data() {
            return {
                salaries: [],
                searchTerm: ''

            }

        },
        computed: {
            filterSearch() {
                return this.salaries.filter(salary => {
                    return salary.salary_month.match(this.searchTerm)

                })
            }
        },
        methods: {
            allSalary() {
                axios.get('/api/salary/')
                    .then(({data}) => (this.salaries = data))
                    .catch()

            },


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
