<template>
    <div id="header">
        <div class="header-top">
            <div class="header-top__name">PHẦN MỀM QUẢN LÝ VĂN BẢN</div>
            <div class="header-top__login">
                <i class="fa-solid fa-phone"></i>
                {{ test.fullname }}
            </div>
        </div> 
    </div>
</template>

<script>
export default {
    computed:{
        test(){
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
    }
    .header-top__name{
        font-size: 1.1rem;
        font-weight: 600;
        color:snow;
    }
</style>
