<template>
    <div>
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
    components:{vanbanden, vanbandi}
}
</script>

<style>

</style>