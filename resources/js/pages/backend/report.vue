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
                <div class="d-flex flex-row mg-b-20">
                    <div class="pd-1">
                        <button class="btn btn-success btn-block" @click="monthtype='m'"><i class="fa fa-check" v-if="monthtype=='m'"></i> Month</button>
                    </div>
                    <div class="pd-1">
                        <button class="btn btn-success btn-block" @click="monthtype='y'"><i class="fa fa-check" v-if="monthtype=='y'"></i> Year</button>
                    </div>
                    <div class="pd-1">
                        <input type="date" v-model="dmy" class="form-control" />
                    </div>
                    <div class="pd-1">
                        <button type="button" @click="getReport" class="btn btn-info">Filter</button>
                    </div>
                </div>
                
             

            </div>
        </div>
        <div class="row row-sm">

            <div class="col-md-12 col-lg-12 col-xl-12  col-sm-12">
                <div class="card">
                   
                    <linechart
                        :charData="chdata"
                        :chartOptions="chdataop"
                        :update="update_chart"
                        :key="key"
                        v-if="shchart"
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row row-sm">
                    <div class="col-xl-12 col-lg-6 col-sm-6 col-md-6">
                        <div class="card text-center">
                            <div class="card-body ">
                                <div class="feature widget-2 text-center mt-0 mb-3">
                                    <i class="ti-bar-chart project bg-primary-transparent mx-auto text-primary "></i>
                                </div>
                                <h6 class="mb-1 text-muted">Income</h6>
                                <h3 class="fw-semibold">{{ formatPrice(sum_income) }} ກີບ</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-sm-6 col-md-6">
                        <div class="card text-center">
                            <div class="card-body ">
                                <div class="feature widget-2 text-center mt-0 mb-3">
                                    <i class="ti-pulse  project bg-teal-transparent mx-auto text-teal "></i>
                                </div>
                                <h6 class="mb-1 text-muted">Expense</h6>
                                <h3 class="fw-semibold">{{ formatPrice(sum_expense) }} ກີບ</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-sm-6 col-md-6">
                        <div class="card text-center">
                            <div class="card-body ">
                                <div class="feature widget-2 text-center mt-0 mb-3">
                                    <i class="ti-stats-up project bg-success-transparent mx-auto text-success "></i>
                                </div>
                                <h6 class="mb-1 text-muted">Profit</h6>
                                <h3 class="fw-semibold">{{formatPrice(sum_profit)}} </h3>
                            </div>
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
<script>


import linechart from '../../components/chartcomponent.vue'
import moment from 'moment'

export default {
    name: 'App01Post',
    components:{
        linechart,
        moment
    },
    data() {
        return {
            shchart:false,
            update_chart:null,
            chdata:[],
            chdataop:{
                 responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      yAxes: [
                          {
                          ticks: {
                              display: true,
                              beginAtZero: false,
                              callback: function (value, index, values) {
                              return ( Number(value) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                              },
                          },
                          gridLines: {
                              show: true,
                          },
                          },
                      ],
                    },
                    tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                        return (
                            Number(tooltipItem.yLabel) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                        },
                    },
                    mode: "index",
                    intersect: false,
                },
            },
            monthtype:'m',
            dmy:'',
            key: 0,
            data_income:[],
            data_expense:[],
        };
    },

    computed:{

      sum_income(){
        return this.data_income.reduce((num, item) => num + item.price,0);
      },
      sum_expense(){
        return this.data_expense.reduce((num, item) => num + item.price,0);
      },
      sum_profit(){
        return this.sum_income-this.sum_expense
      }

    },

    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        
      getReport(){
        this.$axios.get('sanctum/csrf-cookie').then((res)=>{
              axios.post(`/api/report`,{
                monthtype: this.monthtype,
                      dmy: this.dmy}).then((res)=>{
                   
                    if(res.data.success){
                        this.data_income = res.data.income
                        this.data_expense = res.data.expense
                        this.GenGrap()
                      // alert(res.data.income);
                    }
            }).catch((error)=>{
                console.log(error)
            })
        })
      },
    
      GenGrap() {
        this.shchart = true;
        if (this.monthtype == "m") {
            this.key++;
            let re_income = [];
            let re_expense = [];
            let y = this.dmy.split("-")[0];
            let m = this.dmy.split("-")[1];
            let lastday = this.Getlastday(y, m);
            let chart_label = [];

            for (let i = 0; i < lastday; i++) {
            chart_label.push("ວັນທີ່ " + (i + 1));
            }

            re_income  = this.Get_data_chart(lastday, this.data_income) || 0;
            re_expense = this.Get_data_chart(lastday, this.data_expense) || 0;
        
            this.chdata = {
            labels: chart_label,
            datasets: [
                {
                  label: "ລາຍຮັບ",
                  fill: false,
                  borderColor: "#3366CC",
                  data: re_income,
                },
                {
                  label: "ລາຍຈ່າຍ",
                  fill: false,
                  borderColor: "#DC3912",
                  data: re_expense,
                },

            ],
            };
            this.update_chart = Math.floor(Math.random() * 100);
            // ສ້າງກຼາບໃນຮູບແບບຂອງປີ
        } else if (this.monthtype == "y") {
            this.key++;
            let re_income = [];
            let re_expense = [];

            let chart_label = [
              "ເດືອນ 1",
              "ເດືອນ 2",
              "ເດືອນ 3",
              "ເດືອນ 4",
              "ເດືອນ 5",
              "ເດືອນ 6",
              "ເດືອນ 7",
              "ເດືອນ 8",
              "ເດືອນ 9",
              "ເດືອນ 10",
              "ເດືອນ 11",
              "ເດືອນ 12",
            ];

            re_income = this.Get_data_chart_y(12, this.data_income) || 0;
            re_expense = this.Get_data_chart_y(12, this.data_expense) || 0;

            this.chdata = {
            labels: chart_label,
            datasets: [
                {
                  label: "ລາຍຮັບ",
                  fill: false,
                  borderColor: "#3366CC",
                  data: re_income,
                },
                {
                  label: "ລາຍຈ່າຍ",
                  fill: false,
                  borderColor: "#DC3912",
                  data: re_expense,
                },
            ],
            };
            this.update_chart = Math.floor(Math.random() * 100);
          }
    },

    Getlastday(y, m) {
      let dd = new Date(y, m , 0).getDate();
      return dd
    },
    Getday(value) {
      return moment(value).format("DD");
    },
    Getmonth(value) {
      return moment(value).format("MM");
    },
    Getyear(value) {
      return moment(value).format("YYYY");
    },

    Get_data_chart(date, data) {
      let new_db_in = [];
      let databack = [];
      for (let y = 0; y < data.length; y++) {
        if (data[y] != "") {
          let day = this.Getday(data[y].created_at);

          new_db_in.push({ price: data[y].price, day: day });
        }
      }
       
      let update_db_in = new_db_in.reduce((a, c) => {
        let filtered = a.filter((el) => el.day === c.day);
        if (filtered.length > 0) {
          a[a.indexOf(filtered[0])].price =
            parseInt(a[a.indexOf(filtered[0])].price) + parseInt(c.price);
        } else {
          a.push(c);
        }
        return a;
      }, []);

      for (let i = 0; i < date; i++) {
        let type = true;
        for (let k = 0; k < update_db_in.length; k++) {
          if (update_db_in[k].day == i + 1) {
            if (type) {
              databack.push(update_db_in[k].price);
              type = false;
            }
          }
        }
        if (type) {
          databack.push(0);
          type = false;
        }
      }
      return databack;
    },
    Get_data_chart_y(monthchart, data) {
      let new_db_in = [];
      let databack = [];
      for (let y = 0; y < data.length; y++) {
        if (data[y] != "") {
          let month = this.Getmonth(data[y].created_at);
          new_db_in.push({ price: data[y].price, month: month });
        }
      }

      let update_db_in = new_db_in.reduce((a, c) => {
        let filtered = a.filter((el) => el.month == c.month);
        if (filtered.length > 0) {
          a[a.indexOf(filtered[0])].price =
            parseInt(a[a.indexOf(filtered[0])].price) + parseInt(c.price);
        } else {
          a.push(c);
        }
        return a;
      }, []);

      for (let i = 0; i < monthchart; i++) {
        let type = true;
        for (let k = 0; k < update_db_in.length; k++) {
          if (update_db_in[k].month == i + 1) {
            if (type) {
              databack.push(update_db_in[k].price);
              type = false;
            }
          }
        }
        if (type) {
          databack.push(0);
          type = false;
        }
      }
      return databack;
    },
    },

    created(){
        // this.getReport()
    },

    beforeRouteEnter(to,from,next){
        if(!window.Laravel.isLogedin){
            window.location.href="/login";
        }
        next();
    }
};
</script>
<style lang="scss" scoped></style>