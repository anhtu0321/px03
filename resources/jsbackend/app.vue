<template>
    <router-view></router-view>
</template>

<script>
export default {
    mounted(){
        this.$store.dispatch('aclistPermissionOfUser');
    }
}
</script>

<style>

</style>

