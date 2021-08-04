<template>
    <div class="container-fluid p-0 m-0">
        <header-component></header-component>
        <banner-component></banner-component>
        <menu-component></menu-component>
        <content-component></content-component>
        <footer-component></footer-component>
    </div>
    
</template>

<script>
import headerComponent from './includes/header.vue';
import bannerComponent from './includes/banner.vue';
import menuComponent from './includes/menu.vue';
import contentComponent from './includes/content.vue';
import footerComponent from './includes/footer.vue';




export default {
    components:{headerComponent, bannerComponent, menuComponent, contentComponent, footerComponent},
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