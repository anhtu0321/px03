<template>
    <div id="header">
        <div class="header-top">
            <div class="header-top__name">PHẦN MỀM QUẢN LÝ VĂN BẢN</div>
            <div class="header-top__login">
                <div>
                    <i class="fas fa-user"></i>
                    <router-link to="/">{{ userDetails.fullname }} <i class="fas fa-angle-down"></i></router-link> 
                </div>
                <div class="header-top__alert">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            
        </div> 
    </div>
</template>

<script>
export default {
    computed:{
        userDetails(){
            return this.$store.state.userDetails;
        }
    }
}
</script>

<style scoped>
    #header{
        background: rgba(100, 115, 131,0.7);
        height:50px;
    }
    .header-top{
        max-width: 1200px;
        height:50px;
        margin:0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* background: black;
        opacity: 0.2; */
    }
    .header-top__name{
        font-size: 1.1rem;
        font-weight: 600;
        color:snow;
    }
    .header-top__login{
        width:35%;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }
    .header-top__login, .header-top__login a{
        font-size: 1.1rem;
        font-weight: 600;
        color:snow;
        text-decoration: none;
    }
    .header-top__alert{
        margin-left:30px;
    }
</style>
