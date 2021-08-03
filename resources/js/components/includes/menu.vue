<template>
    <div>
        <a href="#" @click="setLink('vanbanden')">Văn bản đến</a>
        <a href="#" @click="setLink('vanbandi')">Văn bản đi</a>
    </div> 
</template>

<script>
export default {
    methods:{
        setLink(link){
            this.$store.dispatch('acLink', link);
        },
    }
}
</script>

<style>

</style>