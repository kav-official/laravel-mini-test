<template>
    <div class="main-content horizontal-content">
 <!-- container::begin -->
 <div class="container">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Store</h2>
                    <p class="mg-b-0">Store List template.</p>
                    
                </div>
            </div>
            <div class="main-dashboard-header-right">
                <div>
                    <label class="tx-13">Customer Ratings</label>
                    <div class="main-star">
                        <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
                    </div>
                </div>
                <div>
                    <label class="tx-13">Online Sales</label>
                    <h5>563,275</h5>
                </div>
                <div>
                    <label class="tx-13">Offline Sales</label>
                    <h5>783,675</h5>
                </div>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">

                    <div class="breadcrumb-header justify-content-between">
                        <div class="left-content">
                            <div>
                                <h2 class="tx-18 mg-b-1 mg-b-lg-1">(10)</h2>
                            </div>
                        </div>
                        <div class="right-content">

                            <div class="d-flex flex-row mg-b-20">
                                <div class="pd-1">
                                    <button class="btn btn-success btn-block" @click="filterOption='M'"><i class="fa fa-check" v-if="filterOption=='M'"></i> Month</button>
                                </div>
                                <div class="pd-1">
                                    <button class="btn btn-success btn-block" @click="filterOption='Y'"><i class="fa fa-check" v-if="filterOption=='Y'"></i> Year</button>
                                </div>
                                <div class="pd-1">
                                    <input type="date" v-model="dateFilter" class="form-control" />
                                </div>
                                <div class="pd-1">
                                    <button type="button" @click="getData" class="btn btn-info">Filter</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
     
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Tran id</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Tatol Price</th>
                                </tr>
                            </thead>
                            <tbody class="table border">
                                <tr v-for="item in items.data" :key="item.id">
                                    <td>{{ dateFormat(item.created_at) }}</td>
                                    <td>{{ item.tran_id }}</td>
                                    <td>{{ item.product_id }}</td>
                                    <td>{{ item.type }}</td>
                                    <td>{{ item.description }}</td>
                                    <td>{{ formatPrice(item.price) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :pagination="items" @paginate="getData($event)" offset="4" />
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- row closed -->
    </div>
        <!-- container::begin -->
    </div>
    
</template>

<script>
import moment from 'moment'
export default {
    name: 'App01Post',
    components:{
        moment
    },
    data() {
       return{
        items:[],
        filterOption:'Y',
        dateFilter:'',
       }
    },

    mounted() {
        
    },

    methods: {
        dateFormat(value){
            return moment(value).format('DD/MM/YYYY')
        },
        getData(page){
            this.$axios.get("/sanctum/csrf-cookie").then((res) => {
                axios.post(`/api/transection?page=${page}`,{
                    filterOption:this.filterOption,
                    dateFilter:this.dateFilter})
                .then((response)=>{
                    // if(response.data.success){
                        this.items = response.data;
                    // }else{
                        // console.log(response.data.message);
                    // }
                   }).catch((error)=>{
                    console.log(error);
                });
            })
        },


        formatPrice(value) {
            let val = (value/1).toFixed(0).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    },
    computed: {
    
    },
    
    created(){
        this.getData();
    },
    beforeRouteEnter(to,from, next){
        if(!window.Laravel.isLogedin){
            window.location.href="/login";
        }
        next();
    }
};
</script>
