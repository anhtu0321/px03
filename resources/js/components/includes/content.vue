<template>
    <div id="content">
        <router-view></router-view>
    </div> 
</template>

<script>

export default {

    async mounted(){
        await this.$store.dispatch('acListPermissionOfUser');
    }
}
</script>

<style>
#content{
    background:#ffffff;
    min-height:500px;
}
.content__sub{
    max-width: 1200px;
    margin:0 auto;
    background: #FFFFFF; 
}
</style>