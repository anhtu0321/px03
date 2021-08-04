<template>
    <div id="menu">
        <div class="menu__sub">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" :class="{'active':getLink=='home'}" @click="setLink('home')">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{'active': getLink=='vanbanden'}" @click="setLink('vanbanden')">Văn bản đến</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{'active': getLink=='vanbandi'}" @click="setLink('vanbandi')">Văn bản đi</a>
                </li>
            </ul>
        </div>
    </div> 
</template>

<script>
export default {
    data(){
        return{

        }
    },
    computed:{
        getLink(){
            return this.$store.getters.getLink;
        }
    },
    methods:{
        setLink(link){
            this.$store.dispatch('acLink', link);
        },
    }
}
</script>

<style>
#menu{
    background:#3c8dc5;
    height:50px;
}
.menu__sub{
    max-width: 1200px;
    margin:0 auto;
    height:50px;
}
.menu__sub ul li{
    cursor: pointer;
}
.menu__sub a{
    color:#f2f7fb;
    font-weight: bold;
 }

.nav-link{
    height:51px;
    padding:15px;
}
</style>