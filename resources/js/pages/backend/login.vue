<template>
    <div class="container">
        <div class="breadcrumb-header justify-content-center">
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Vertical Form</h4>
                        <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
                    </div>
                    <div class="card-body pt-0">
                        <form>
                            <div class="">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" v-model="email" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" v-model="password" id="exampleInputPassword1" v-on:keyup="signup($event)" placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                        <label for="checkbox-1" class="custom-control-label mt-1">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-primary mt-3 mb-0" @click="btnLogin()">LOGIN</button>
                                <router-link to="/register" class="btn btn-success mt-3 mb-0">Register</router-link>
                            </div>
                        </form>
                        <div class="alert alert-warning text-center mt-4" v-if="textShow">{{ textError }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'App01Login',

    data() {
        return {
            email:'',
            password:'',
            textShow:false,
            textError:''
        };
    },

    methods: {
        signup(e){
            console.log('Enter login')
            if( e.which == 13 ){
                this.btnLogin();
            }
        },

        btnLogin(){
            if(this.email != "" && this.password != ""){
               if(this.password.length > 6){
                    this.$axios.get('/sanctum/csrf-cookie').then(res => {
                        this.$axios.post(`api/login`, {
                            email   : this.email,
                            password: this.password
                        }).then(response => {
                            if(response.data.success){
                                // this.$router.push('store')
                                window.location.href = "/store"
                            }else{
                                this.textShow = true; 
                                this.textError = response.data.message;
                            }
                        }).catch((error)=>{
                            console.log(error)
                        })

                    })

                }else{
                    this.textShow = true;
                    this.textError = 'Please enter password more then 6';
                }
            }else{
                this.textShow = true;
                this.textError = 'Invalide pass/email please try again';
            }
        }
    },

    beforeRouteEnter(to, from, next){
        if(window.Laravel.isLogedin){
            // this.$router.push('store');
            window.location.href="/store";
        }
        next();
    }
};
</script>
<style lang="scss" scoped></style>