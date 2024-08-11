<template>
    <div class="main-content horizontal-content">
    <!-- container::begin -->
    <div class="container">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Post</h2>
                <p class="mg-b-0">Post List template.</p>
                
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
    <div class="row row-sm">
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="input-group">
                    <input type="text" @keyup="getData()" v-model="filter" class="form-control" placeholder="Search ...">
                    <span class="input-group-text p-0">
                        <button class="btn btn-primary" type="button">Search</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-sm" style="height:67vh;overflow:auto">

            <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6" v-for="item in items.data" :key="item.id">
                <div class="card">
                    <div class="card-body h-100 cursor-pointer" @click="addCart(item.id)">
                        <div class="pro-img-box">
                            <div class="d-flex product-sale">
                                <div class="badge bg-pink">New</div>
                                <span v-for="oritem in orderItems" :key="oritem.id">
                                    <span v-if="oritem.id == item.id" class="ms-auto wishlist" style="background-color: #ffffff;padding: 10px;">{{ oritem.qty }}</span>
                                </span>
                            </div>
                            <img v-if="item.image" class="w-100" :src="imageURL+'/'+item.image" :alt="item.name">
                            <img v-else class="w-100" src="assets/img/ecommerce/01.jpg" :alt="item.name">
                            <a href="#" class="adtocart"> <i class="las la-shopping-cart "></i>
                            </a>
                        </div>
                        <div class="text-center pt-3">
                            <h3 class="h6 mb-2 mt-4 fw-bold text-uppercase">{{ item.name }}</h3>
                            <h4 class="h5 mb-0 mt-2 text-center fw-bold text-danger">${{ formatPrice(item.sale_price) }} <span class="text-secondary fw-normal tx-13 ms-1 prev-price">
                            {{ item.quantity }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
        <div class="card">
            <div class="card-header border-bottom pt-3 pb-3 mb-0 fw-bold text-uppercase">Taltol: {{ formatPrice(taltolAmount)}}
            </div>
            <div class="card-body pb-0">
                <span class="input-group-text p-0 ">
                    <!-- <a class="modal-effect btn btn-outline-primary btn-block" @click="btnPaynow" :disabled="checkPay" style="width:100%;background-color: chocolate;border: none;" data-bs-effect="effect-rotate-bottom" data-bs-toggle="modal">Rotate Bottom</a> -->
                        <button class="btn-pay m-2" @click="btnPaynow" :disabled="checkPay" style="width:100%;background-color: chocolate;border: none;" type="button">pay now</button>
                </span>
            </div>
            <table class="table mb-0 text-md-nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>
                            Sume <i class="cursor-pointer" @click="removeAll()">- X -</i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in orderItems" :key="item.id">
                        <th>{{ item.name }}</th>
                        <th>{{ formatPrice(item.sale_price) }}
                            <br />
                            <i @click="deCrease(item.id)" class="mid mid-minus-circle text-info cursor-pointer">-</i>
                            {{ item.qty }}
                            <i @click="inCrease(item.id)" class="mid mid-minus-circle text-info cursor-pointer">+</i> | 
                            <i @click="removeOne(item.id)" class="mid mid-minus-circle text-info cursor-pointer">x</i>
                        </th>
                        <th>{{ formatPrice(item.sale_price * item.qty) }}</th>
                    </tr>
                </tbody>
            </table>   
        </div>
    </div>

    <dov class="row">

        <!-- <a class="modal-effect btn btn-outline-primary btn-block" data-bs-effect="effect-rotate-bottom" data-bs-toggle="modal" href="#modaldemo8">Rotate Bottom</a> -->


    <!-- Basic modal -->
        <div class="modal fade" id="modalPay">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h1 class="modal-title">Paid</h1><button aria-label="Close" class="close"
							data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h4><span><trong>Tatol: {{ formatPrice(taltolAmount) }}</trong></span></h4>
						<h4><span><trong>Recive:</trong></span><span style="text-align:right">{{ formatPrice(cashAmount) }}</span></h4>
						<h4 v-if="withDrawal > 0"><span><trong>Withdrawal: {{ formatPrice(withDrawal) }}</trong></span></h4>
                        <div class="form-group text-right">
                            <input v-model="cashAmount" style="text-align:right" class="form-control" />
                        </div>
                        <div class="row text-center">
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(1)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">1</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(2)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">2</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(3)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">3</div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(4)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">4</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(5)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">5</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(6)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">6</div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(7)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">7</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(8)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">8</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(9)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">9</div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4 p-1 cursor-pointer" @click="addNum(0)" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">0</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum('00')" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">00</div>
                            <div class="col-4 p-1 cursor-pointer" @click="addNum('-')" style="background-color: darkorange; border-style: solid;border-color: #ffffff;">Delete</div>
                        </div>
					</div>
					<div class="modal-footer text-center">
						<button class="btn ripple btn-secondary" @click="conFirmpay" type="button">Confirm payment</button>
					</div>
				</div>
			</div>
		</div>
        <!-- End Basic modal -->
    </dov>
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
        return {
            items:[],
            orderItems:[],
            filter:'',
            cashAmount:'',
            imageURL : window.location.origin+"/assets/images/",
        };
    },

    computed:{ // ຄຳນວນ
        taltolAmount(){
            return this.orderItems.reduce((num,item)=> num + item.sale_price * item.qty, 0);
        },
        checkPay(){
            if(this.taltolAmount > 0){
                return false
            }else{
                return true
            }
        },
        withDrawal(){
            // return 100
            return parseInt(this.cashAmount)-parseInt(this.taltolAmount)
        }
    },

    watch(){// ຕິດຕາມ variable

    },

    methods: {
      conFirmpay(){
        this.$axios.get('sanctum/csrf-cookie').then((res)=>{
            axios.post('/api/transection/add',{
                acc_type :'income',
                orderItem : this.orderItems})
            .then((res)=>{
                if(res.data.success){
                    $("#modalPay").modal('hide');
                    this.orderItems = [],
                    this.cashAmount = '',
                    this.getData()
                }else{
                    console.log(res.data.message)
                }
            })
        })
      },
      addNum(num){
        if(num == '-'){
            this.cashAmount = this.cashAmount.slice(0,-1)
        }else{
            this.cashAmount = this.cashAmount + num
        }
      },
      btnPaynow(){
        $("#modalPay").modal('show');
      },
      inCrease(id){
        let item = this.items.data.find((i)=>i.id == id);
        if(this.orderItems.find((i)=>i.id == id)){
            let old_quantity = this.orderItems.find((i)=>i.id == id).qty;
            if(item.quantity-old_quantity > 0){
                this.orderItems.find((i)=>i.id == id).qty = old_quantity + 1;
            }else{
                console.log()
            }
        }
      },
      deCrease(id){
        // let item = this.items.data.find((i)=>i.id == id);
        if(this.orderItems.find((i)=>i.id == id)){
            let old_quantity = this.orderItems.find((i)=>i.id == id).qty;
            if(old_quantity - 1 > 0){
                this.orderItems.find((i)=>i.id == id).qty = old_quantity - 1;
            }else{
                this.orderItems.splice(this.orderItems.map(i=>i.id).indexOf(id),1);
            }
        }
      },
      removeOne(id){
        this.orderItems.splice(this.orderItems.map(i=>i.id).indexOf(id),1);
      },
      removeAll(){

      },
      getData(page){
        this.$axios.get('sanctum/csrf-cookie').then((res)=>{
            this.$axios.get(`api/store/get?page=${page}&filter=${this.filter}`).then((res)=>{
                this.items = res.data
            }).catch((error)=>{
                console.log(error)
            })
        })
      },
      addCart(id){
        let item = this.items.data.find((i)=>i.id == id);
        if(this.orderItems.find((i)=>i.id == id)){
           
            let chectQty = this.orderItems.find((i)=>i.id == id).qty;
            if(item.quantity - chectQty > 0){
                this.orderItems.find((i)=>i.id==id).qty = chectQty+1;
            }else{
                this.$swal('Waring','Out of stock','waring');
            }
        }else{
            if(item.quantity > 0){
                this.orderItems.push({
                    id        : item.id,
                    name      : item.name,
                    sale_price: item.sale_price,
                    qty       : 1
                });
            }else{
                this.$swal('Waring','out of stock','waring');
            }
        }
      },
      formatPrice(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },

    },

    created(){
        this.getData()
    },

    beforeRouteEnter(to,from,next){
        if(!window.Laravel.isLogedin){
            window.location.href="/login";
        }
        next();
    }
};
</script>

<style lang="scss" scoped>

</style>