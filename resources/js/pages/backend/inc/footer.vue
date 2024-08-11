<template>
    <div class="main-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
            <span>Copyright © {{ getYear() }} <a href="#">Valex</a>. Designed by <a href="https://www.spruko.com/">Spruko</a> All rights reserved.</span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App01Footer',

    data() {
        return {
        };
    },
    methods: {
        getYear(){
            const current = new Date();
            // const date = `${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
            const date = `${current.getFullYear()}`;
            return date;
        }
    },
    mounted(){
        this.getYear()
    }
};
</script>
