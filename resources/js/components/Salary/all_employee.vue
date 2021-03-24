<template>
    <div>
        <div class="row">
<!--            <router-link to="/pay-salary" class="btn btn-primary">Pay Salary</router-link>-->

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
                            <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Job</th>
                                    <th>Photo</th>
                                    <th>Phone No.</th>
                                    <th>Sallery</th>
                                    <th>Joining Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="employee in filterSearch" :key="employee.id">
                                    <td>{{employee.name}}</td>
                                    <td>{{employee.nid}}</td>

                                    <td><img :src="employee.photo" id="em_photo"></td>
                                    <td>{{employee.phone}}</td>
                                    <td>{{employee.sallery}}</td>
                                    <td>{{employee.joining_date}}</td>
                                    <!--                                    <td><span class="badge badge-success">Delivered</span></td>-->
                                    <td>
                                        <router-link :to="{name:'pay-salary', params:{id:employee.id}}" class="btn btn-sm btn-danger">Pay Salary</router-link>

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

            this.allEmployee();

        },
        data() {
            return {
                employees: [],
                searchTerm: ''

            }

        },
        computed: {
            filterSearch() {
                return this.employees.filter(employee => {
                    return employee.name.match(this.searchTerm)

                })
            }
        },
        methods: {
            allEmployee() {
                axios.get('/api/employee/')
                    .then(({data}) => (this.employees = data))
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
