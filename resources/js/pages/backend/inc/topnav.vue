<template>
    <div class="main-header nav nav-item hor-header">
            <div class="container">
                <div class="main-header-left ">
                    <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
                    <router-link class="header-brand" to="/admin">
                        <img src="assets/img/brand/logo-white.png" class="desktop-dark">
                        <img src="assets/img/brand/logo.png" class="desktop-logo">
                        <img src="assets/img/brand/favicon.png" class="desktop-logo-1">
                        <img src="assets/img/brand/favicon-white.png" class="desktop-logo-dark">
                    </router-link>
                    <div class="main-header-center  ms-4">
                        <input class="form-control" placeholder="Search for anything..." type="search"><button class="btn"><i class="fe fe-search"></i></button>
                    </div>
                </div><!-- search -->
                <div class="main-header-right">
                    <ul class="nav nav-item  navbar-nav-right ms-auto">
                        <li class="nav">
                        <div class="dropdown  nav-itemd-none d-md-flex">
                            <a href="#" class="d-flex  nav-item country-flag1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="avatar country-Flag me-0 align-self-center bg-transparent"><img src="assets/img/flags/us_flag.jpg" alt="img"></span>
                            </a>
                        </div>
                        </li>
                    
                        <li class="dropdown nav-item main-header-message ">
                            <a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class=" pulse-danger"></span></a>
                            <div class="dropdown-menu">
                                <div class="menu-header-content bg-primary text-start">
                                    <div class="d-flex">
                                        <h6 class="dropdown-title mb-1 tx-15 text-white fw-semibold">Messages</h6>
                                        <span class="badge rounded-pill bg-warning ms-auto my-auto float-end">Mark All Read</span>
                                    </div>
                                    <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread messages</p>
                                </div>
                                <div class="text-center dropdown-footer">
                                    <a href="text-center">VIEW ALL</a>
                                </div>
                            </div>
                        </li>
                        
                        <li class="nav-item full-screen fullscreen-button">
                            <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
                        </li>
                        <li class="dropdown main-profile-menu nav nav-item nav-link">
                            <a class="profile-user d-flex" href=""><img alt="" src="assets/img/faces/6.jpg"></a>
                            <div class="dropdown-menu">
                                <div class="main-header-profile bg-primary p-3">
                                    <div class="d-flex wd-100p">
                                        <div class="main-img-user"><img alt="" src="assets/img/faces/6.jpg" class=""></div>
                                        <div class="ms-3 my-auto">
                                            <h6>{{ USER_NAME }}</h6><span>Premium Member</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
                                <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
                                <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
                                <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
                                <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
                                <a class="dropdown-item" href="#" @click="btnLogout()"><i class="bx bx-log-out"></i> Sign Out</a>
                            </div>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: 'App01Topnav',

    data() {
        return {
            USER_NAME:''
        };
    },

    methods: {
        btnLogout(){
            this.$swal({
                icon:'question',
                title:'Warning',
                text:'Are you sure you want to logout',
                showCancelButton:true,
            }).then((result)=>{
                if(result.isConfirmed){
                    this.$axios.get('/sanctum/csrf-cookie').then(res => {
                        this.$axios.post('/api/logout').then(res=>{
                            if(res.data.success){
                                // this.$router.push('/');
                                window.location.href="/login";
                            }else{
                                this.$swal('Error','some thing wrong','error');
                            }
                        })
                    })
                }
            })
        }
    },

    created(){
        if(window.Laravel.isLogedin){
            this.isLogedin = true
            this.USER_NAME = window.Laravel.user.name
        }
    }

};
</script>

<style lang="scss" scoped>

</style>