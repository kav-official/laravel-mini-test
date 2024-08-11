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

        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY ORDERS</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">$5,74.12</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY EARNINGS</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">$1,230.17</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TOTAL EARNINGS</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">$7,125.70</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">PRODUCT SOLD</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">$4,820.50</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
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
                        <div class="main-dashboard-header-right">
                            <div>
                               <button v-if="formShow" @click="btnSubmit()" type="button" :class="checkForm" class="btn btn-success me-2">Submit</button>
                               <button v-if="formShow" @click="btnCancel()" type="button" class="btn btn-danger">Cancel</button>
                               <button v-if="!formShow" @click="btnAdd()" type="button" class="btn btn-info">Add new</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="formShow">
                    <div class="col-md-3">
                        <div class="card-body pt-0">
                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <img :src="imagePreview" alt=""/>
                                <input type="file" name="image" class="form-control" @change="onSelect($event)" id="image" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body pt-0">
                                <div class="form-group">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" v-model="formValue.name" id="product_name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="Quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" v-model="formValue.quantity" id="Quantity">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-label">Base Price</label>
                                    <cleave type="text" :options="options" class="form-control" v-model="formValue.base_price" id="base_price" />
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-label">Sale Price</label>
                                    <cleave type="text" :options="options" class="form-control" v-model="formValue.sale_price" id="sale_price" />
                                </div>
                        </div>
                    </div>
                </div>

                <div class="card-body" v-if="!formShow">
                    <div class="table-responsive">

                        <div class="dataTables_wrapper  dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div id="example1_filter" class="dataTables_filter">
                                        <label>
                                            <input type="search" class="form-control form-control-sm" placeholder="Search..." v-model="filter_product" @keyup="getData()" aria-controls="example1">
                                        </label>
                                    </div>
                                </div>      
                            </div>
                        </div>

                        <table class="table mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Base Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in items.data" :key="item.index">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.quantity }}</td>
                                    <td>{{ formatPrice(item.base_price) }}</td>
                                    <td>
                                        <a type="button" @click="btnEdit(item.id)" class="tx-18"> <li class="icons-list-item "><i class="typcn typcn-pencil"></i></li></a>
                                        
                                        <a type="button" @click="btnDelete(item.id)" class="tx-18"> <li class="icons-list-item"><i class="typcn typcn-delete"></i></li></a>
                                    </td>
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

export default {
    name: 'App01Post',

    data() {
       return{
        items:[],
        formID:'',
        FormData:[],
        formShow:false,
        formType:true,
        filter_product:'',
        image_product:'',
        imagePreview : window.location.origin+"/assets/img/add.png",
        formValue:{
            name:'',
            quantity:'',
            base_price:'',
            sale_price:''
        },
        options:{
            // prefix: '$',
            numeral: true,
            numeralIntegerScale:10,
            numeralDecimalScale:2,
            numeralDecimalMark:'.',
            delimiter:','
        }
       }
    },

    mounted() {
        
    },

    methods: {

        getData(page){
            this.$axios.get("/sanctum/csrf-cookie").then((res) => {
                axios.get(`/api/store/get?page=${page}&filter=${this.filter_product}`)
                .then((response)=>{
                    this.items = response.data;
                   }).catch((error)=>{
                    console.log(error);
                });
            })
        },

        btnAdd(){
            this.formShow     = true
            this.imagePreview = window.location.origin+'/assets/img/add.png'
        },
    
        btnCancel(){
            this.formShow = false
        },
        btnSubmit(){
            if(this.formType){
                let formData = new FormData();
                formData.append("name",this.formValue.name);
                formData.append("image",this.image_product);
                formData.append("quantity",this.formValue.quantity);
                formData.append("base_price",this.formValue.base_price);
                formData.append("sale_price",this.formValue.sale_price);
                formData.append('acc_type','expense');

                axios.post('api/store/post',formData,{headers:{'Content-Type':'multipart/form-data'}})
                .then((response)=>{
                    this.getData();
                })
            }else{
                let formData = new FormData();
                formData.append("name",this.formValue.name);
                formData.append("image",this.image_product);
                formData.append("quantity",this.formValue.quantity);
                formData.append("base_price",this.formValue.base_price);
                formData.append("sale_price",this.formValue.sale_price);

                axios.post(`api/store/update/${this.formID}`,formData ,{headers :{"Content-Type":"multyparth/form-data"}})
                .then((response)=>{
                    this.getData();
                }).catch((error)=>{
                    console.log(error)
                })
            }
            
            this.image                = ''
            this.formValue.name       = ''
            this.formValue.quantity   = ''
            this.formValue.base_price = ''
            this.formValue.sale_price = ''
            this.formShow             = false
            this.formType             = true;
            this.formID               = "";
        },

        btnEdit(id){
           axios.get(`api/store/edit/${id}`)
           .then((response)=>{
            
                this.formValue.name       = response.data.name
                this.formValue.quantity   = response.data.quantity
                this.formValue.base_price = response.data.base_price
                this.formValue.sale_price = response.data.sale_price

                if(response.data.image){
                    this.imagePreview = window.location.origin+'/assets/images/'+response.data.image;
                }else{
                    this.imagePreview = window.location.origin+'assets/img/ecommerce/01.jpg';
                }

           }).catch((error)=>{
            console.log(error);
           });
           this.formID      = id
           this.formShow    = true
           this.formType    = false;
        },

        btnDelete(id){
            this.$swal({
                icon:'question',
                title:'Warning!',
                text:'are you sure you want delete!',
                confirmButtonText:'Yes,okay',
                showCancelButton:true
            }).then((result)=>{
                if(result.isConfirmed){
                    this.$swal('Success','Delete Success','success')
                    axios.delete(`api/store/delete/${id}`)
                    .then((response)=>{
                        this.getData();
                    })
                }
            })
        },
       
        onSelect(e){
            this.image_product = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.image_product);
            reader.addEventListener("load", function(){
                this.imagePreview = reader.result;
            }.bind(this), false)

        },

        formatPrice(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    },
    computed: {
        checkForm() {
            if(this.formValue.name == "" || this.formValue.quantity == ""){
                return "disabled";
            }else{
                return "";
            }
        },
    },

    created() {
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
