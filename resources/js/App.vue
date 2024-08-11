<template>
    <div>
        <div class="page">
            <!-- BEGIN::TOPNAV -->
            <topnavComponent v-if="isLogedin" />
            <!-- END::TOPNAV -->
            <!--BEGIN::NAV -->
            <navComponent v-if="isLogedin"  />
            <!--END::NAV -->
            <!-- main-content opened -->
            <router-view />
            <!-- Container closed -->
            <!-- Footer opened -->
            <footerComponent v-if="isLogedin"  />
            <!-- Footer closed -->
        </div>
    </div>
</template>

<script>

import footerComponent from './pages/backend/inc/footer.vue'
import navComponent from './pages/backend/inc/nav.vue'
import topnavComponent from './pages/backend/inc/topnav.vue'
export default {

    name: 'App01',
    components:{
        footerComponent,
        navComponent,
        topnavComponent
    },
    
    data() {
        return{
            isLogedin:false
        }
    },
    mounted() {
    },
    methods: {
     
    },
    created(){
        if(window.Laravel.isLogedin){
            this.isLogedin = true
        }
    }
};
</script>
<style>
 .cursor-pointer{
    cursor:pointer
 }
</style>