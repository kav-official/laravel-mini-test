<template>
    <div class="container">
        <div class="mt-4 justify-content-center">
        <div class="row row-lg">
            <div class="col-lg-12 col-xl-12 col-md-12 col-lg-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Vertical Form</h4>
                        <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
                    </div>
                    <div class="card-body pt-0">
                        <form>
                            <div>
                              <div class="row row-sm">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input class="form-control" v-model="name" type="text">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div> -->
                            </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" v-model="email" id="exampleInputEmail1">
                                </div>
                
                                <div class="row row-sm">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" v-model="password" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" v-model="confirm_password" type="text">
                                    </div>
                                </div>
                            </div>

                                <div class="checkbox">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                        <label for="checkbox-1" class="custom-control-label mt-1">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" @click="btnRegister()" class="btn btn-success mt-3 mb-0">Submit</button>
                            </div>
                            <div class="alert alert-danger text-center mt-4" v-if="messageShow">{{ messageError }}</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: 'App01Register',

    data() {
        return {
            name:'',
            email:'',
            password:'',
            confirm_password:'',
            messageError:'',
            messageShow:false
        };
    },

    methods: {
        btnRegister(){
            if(this.password == this.confirm_password){
                this.$axios.get('/sanctum/crsf-cookie').then(res =>{
                    this.$axios.post('api/register', {
                    name    : this.name,
                    email   : this.email,
                    password: this.password
                }).then(res =>{
                    if(res.data.success){
                        this.$router.push('/')
                    }else{
                        this.messageShow = true;
                        this.messageError = res.data.message;
                    }
                })
             })
            }else{
                this.messageShow  = true;
                this.messageError = 'Password not match please try again'
            }
        }
    },
};
</script>

<style lang="scss" scoped>

</style>