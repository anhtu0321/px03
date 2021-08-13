<template>
    <div id="content">
        <vanbanden v-if="getLink == 'vanbanden'"></vanbanden>
        <vanbandi v-if="getLink == 'vanbandi'"></vanbandi>
    </div> 
</template>

<script>
import vanbanden from './contents/vanbanden.vue'
import vanbandi from './contents/vanbandi.vue'
export default {
    computed:{
        getLink(){
            return this.$store.getters.getLink;
        } 
    },
    components:{vanbanden, vanbandi},
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