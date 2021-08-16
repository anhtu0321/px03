<template>
    <div id="header">
        <div class="header-top">
            <div class="header-top__name">PHẦN MỀM QUẢN LÝ VĂN BẢN</div>
            <div class="header-top__login">
                <div class="dropdown-vue" :id='id'>
                    <div @click="showDropdown = !showDropdown" >
                        <div>
                            <i class="fas fa-user"></i>
                            <a href="#" >{{ userDetails.fullname }} <i class="fas fa-angle-down"></i></a> 
                        </div>
                    </div>
                    <div class="dropdown-vue__content" v-if="showDropdown">
                        <ul>
                            <li @click="hideDropdown"><a href="ádasds"><i class="fas fa-list-ul"></i> Danh sách Văn bản xử lý</a></li>
                            <li><a href="/px03/public/admin"><i class="fas fa-cogs"></i> Trang quản trị</a></li>
                            <li @click="hideDropdown" data-toggle="modal" data-target="#doimatkhau"><a href="#"><i class="fas fa-key"></i> Đổi mật khẩu</a></li>
                            <li><a href="/px03/public/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
                <div class="header-top__alert">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
        </div> 
        <!-- Modal Đổi mật khẩu -->
        <div class="modal fade" id="doimatkhau" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Đổi mật khẩu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="doimatkhau">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>Mật khẩu cũ</label>
                                        <input type="password" class="form-control form-control-sm" v-model="oldpass" :class="{'is-invalid':(error && error.oldpass)}" @focus="removeErr">
                                        <p class="thongbao" v-if="error && error.oldpass">{{ error.oldpass[0]}}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" class="form-control form-control-sm" v-model="newpass" :class="{'is-invalid':(error && error.newpass)}" @focus="removeErr">
                                        <p class="thongbao" v-if="error && error.newpass">{{ error.newpass[0]}}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Nhập lại mật khẩu mới</label>
                                        <input type="password" class="form-control form-control-sm" v-model="renewpass" :class="{'is-invalid':(error && error.renewpass)}" @focus="removeErr">
                                        <p class="thongbao" v-if="error && error.renewpass">{{ error.renewpass[0]}}</p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3 text-right">
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-key"></i> Đổi mật khẩu</button>
                                    </div>
                                </div>
                                <div class="form-row" v-if="alertChangePass != ''">
                                    <div class="col-md-12 mb-3 ">
                                        <div class="alert alert-success">{{alertChangePass}}</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            showDropdown:false,
            id:'dropdownUser',
            oldpass:'',
            newpass:'',
            renewpass:'',
            error:'',
            alertChangePass:'',
        }
    },
    computed:{
        userDetails(){
            return this.$store.state.userDetails;
        }
    },
    methods:{
        hideDropdown(){
            this.showDropdown = false;
        },
        clickBenNgoai(e){
            if(!document.getElementById(this.id).contains(event.target)){
               this.showDropdown = false;
            }
        }
        ,
        doimatkhau(){
            if(this.newpass != this.renewpass){
                this.error = {
                    renewpass:['Nhập lại mật khẩu mới không khớp !']
                }
                return;
            }
            let data = new FormData();
            data.append('oldpass', this.oldpass);
            data.append('newpass', this.newpass);
            data.append('renewpass', this.renewpass);
            axios.post('/px03/public/doimatkhau', data)
            .then(response=>{
                this.alertChangePass = 'Đổi mật khẩu thành công !'
            })
            .catch(error=>{
                this.error = this.error = error.response.data.errors;
                console.log(error);
            });
        },
        removeErr(){
            this.error ='';
        }
    },
    created(){
        window.addEventListener('click', this.clickBenNgoai);
    },
    beforeDestroy(){
        window.removeEventListener('click', this.clickBenNgoai);
    }

}
</script>

<style scoped>
    #header{
        background: #f9f9f9;
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
        color:#353535;
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
        color:#353535;
        text-decoration: none;
    }
    .header-top__alert{
        margin-left:30px;
    }
    .header-top__login .dropdown-vue{
        position: relative;
       
    }
    .header-top__login .dropdown-vue:hover > div > div > i, .header-top__login .dropdown-vue:hover > div > div > a{
        color:tomato;
    }
    .header-top__login .dropdown-vue__content{
        position: absolute;
        top:35px;
        right:0;
        z-index: 2;
        background: rgb(252, 251, 251);
        color:rgb(1, 1, 46);
        box-shadow: 2px 3px 8px 2px rgb(67, 67, 68);
        min-width: 230px;
    }
    .header-top__login .dropdown-vue__content::before{
        content:'';
        position: absolute;
        right: 20px;
        top:-20px;
        border:10px solid transparent;
        border-bottom: 10px solid white;
        z-index: 3;
    }
    .dropdown-vue__content ul{
        list-style: none;
    }
    .dropdown-vue__content ul li{
        padding:5px 10px;
    }
    .dropdown-vue__content ul li a{
        display: block;
    }
    .dropdown-vue__content ul li:hover{
        background:tomato;
    }
    .dropdown-vue__content ul li:hover a{
        color: yellow;
    }
    .thongbao{
	color:crimson;
	font-size:0.8rem;
	margin-top: 5px;
}
</style>
