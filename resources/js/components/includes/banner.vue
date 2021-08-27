<template>
    <div id="banner">
        <div class="banner__content">
            <div class="banner__left">
                <img src="/px03/public/images/cand.png"/>
                <h1>CÔNG AN TỈNH HƯNG YÊN</h1>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
#banner{
    height:240px;
    box-sizing: border-box;
    background-image: url('/px03/public/images/4.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    position: relative;
    z-index:0;
}
#banner::before{
    content:'';
    position: absolute;
    left: 0;
    top:0;
    right:0;
    bottom:0;
    background: #000000;
    opacity: 0.4;
    z-index:-1;
}
.banner__content{
    position:relative;
    max-width:1200px;
    height:240px;
    margin:0 auto;
    box-sizing: border-box;
    display: flex;
    justify-content: space-between;
    z-index: 1;
}
.banner__content::before{
    position:absolute;
    content:'';
    left:0;
    right:0;
    top:0;
    bottom:0;
    background:#e6e6e6;
    opacity: 0.2;
    z-index: -1;
}
.banner__left{
    width: 20%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.banner__left img{
    margin-top:10px;
    margin-bottom:10px;
    width:150px;
    height:50%;
}
.banner__left h1{
    font-size:1.2rem;
    color:blanchedalmond;
    font-weight: 400;
}
.banner__right{
    display: flex;
    flex-direction: row-reverse;
    width: 25%;
}
.banner__right img{
    width: 250px;
    height:100%;
}
</style>>
