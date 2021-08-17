<template>
    <div id="menu">
        <div class="menu__sub">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <router-link to='/home' class="nav-link" active-class="active">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link to='/vanbanden' class="nav-link" active-class="active">Văn bản đến</router-link>
                </li>
                <li class="nav-item">
                    <router-link to='/vanbandi' class="nav-link" active-class="active">Văn bản đi</router-link>
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