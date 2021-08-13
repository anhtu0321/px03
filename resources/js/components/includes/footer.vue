<template>
    <div id="footer">
        <div class="col-sm-12 footer-bar"></div>
        <div class="footer__sub">
            <p>CÔNG AN TỈNH HƯNG YÊN</p>
            <p>Số 45 Hải Thượng Lãn Ông -Thành Phố Hưng Yên</p>
            <p>PHẦN MỀM QUẢN LÝ VĂN BẢN</p> 
            <p>Bản quyền thuộc - PX03</p>
            <p>Điện thoại: 069.2849...</p>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>
#footer{
    height:250px;
    background: url('/px03/public/images/3.jpg');
    background-size: cover;
    position: relative;
    /* background: #313131; */
    z-index:1;
}
#footer::before{
    content:'';
    position: absolute;
    background: black;
    width: 100%;
    height: 100%;
    left:0;
    top:0;
    opacity: 0.8;
    z-index:-1;
}
.footer-bar {
    background: #08324b;
    height: 35px;
    margin-top: 35px;
}
.footer__sub{
    max-width: 1200px;
    margin:0 auto;
    color:#dad599;
    padding-top: 25px;
    padding-bottom: 25px;
    margin-bottom: 25px;
}

.footer__sub p {
    line-height: 15px;
}

.footer__sub p:first-child {
    font-weight: bold;
}
</style>