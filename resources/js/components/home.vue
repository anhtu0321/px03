<template>
    <div class="container-fluid p-0 m-0">
        <header-component></header-component>
        <banner-component></banner-component>
        <!-- <div id="menu" class="bg-success">menu</div>
        <div id="content" class="bg-info">content</div>
        <div id="footer" class="bg-warning">footer</div> -->
    </div>
    
</template>

<script>
import headerComponent from './includes/header.vue';
import bannerComponent from './includes/banner.vue';

export default {
    components:{headerComponent, bannerComponent},
    mounted(){
        this.$store.dispatch('acUserDetails');
    }
}
</script>

<style>
*{
    padding:0;
    margin:0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}
html{
    font-size: 14px;
}
</style>