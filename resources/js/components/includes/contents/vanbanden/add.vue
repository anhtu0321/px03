<template>
    <div class="content__add mt-3">
        <button class="btn btn-danger btn-sm mb-3" @click.prevent="showAdd" v-if="show">
            <i class="fas fa-times"></i> Đóng
        </button>
        <button class="btn btn-success btn-sm mb-3" @click.prevent="showAdd" v-else>
            <i class="fas fa-plus-square"></i> Thêm Văn bản đến
        </button>
        <div class="content__form-add" :class="classadd" v-if="show">
            <div class="bg-info d-flex justify-content-center align-items-center mb-3 p-2 tieude">
                THÊM VĂN BẢN ĐẾN
            </div>
            
            <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="add">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label>Cơ quan ban hành</label>
                        <select v-model="id_nguon_den" class="form-control form-control-sm">
                            <option value="">--- Chọn cơ quan, đơn vị ban hành ---</option>
                            <option v-for="nguonden in listNguonDen.data" :key="nguonden.id" :value="nguonden.id">{{ nguonden.ten_nguon }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Số văn bản</label>
                        <input type="text" v-model="so" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Ngày văn bản</label>
                        <input type="date" v-model="ngay" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Loại văn bản</label>
                        <select class="form-control form-control-sm" v-model="id_loai">
                            <option value="">--- Chọn Loại văn bản ---</option>
                            <option v-for="loai in listLoai" :key="loai.id" :value="loai.id">{{ loai.ten_loai }}</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Trích yếu</label>
                        <input type="text" class="form-control form-control-sm" v-model="trich_yeu" :class="{'is-invalid':(error && error.trich_yeu)}" @focus="removeErr">
                        <p class="thongbao" v-if="error && error.trich_yeu">{{ error.trich_yeu[0] }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Độ mật</label>
                        <select class="form-control form-control-sm" v-model="do_mat">
                            <option value="">Không mật</option>
                            <option value="1">Mật</option>
                            <option value="2">Tối Mật</option>
                            <option value="3">Tuyệt Mật</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Người ký</label>
                        <input type="text" class="form-control form-control-sm" v-model="nguoi_ky">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label>File đính kèm</label>
                        <input type="file" class="form-control form-control-sm" @change="getFile">
                    </div>
                    <div class="col-md-7 mb-3">
                        <label>Phê duyệt của lãnh đạo</label>
                        <input type="text" class="form-control form-control-sm" v-model="phe_duyet">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Cán bộ xử lý</label>
                        <select class="form-control form-control-sm" v-model="id_user_xu_ly">
                            <option value="">--- Chọn Cán bộ xử lý ---</option>
                            <option v-for="user in listUser.data" :key="user.id" :value="user.id">{{ user.fullname }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Hạn xử lý</label>
                        <input type="date" class="form-control form-control-sm" v-model="han_xu_ly">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control form-control-sm" v-model="ghi_chu">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3 text-right">
                        <button class="btn btn-primary">Thêm Văn bản</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
             // dùng để ẩn hiện form thêm
            show:false,
            classadd:'',
            //dữ liệu thêm văn bản 
            id_nguon_den:'',
            so:'',
            ngay:'',
            id_loai:'',
            trich_yeu:'',
            do_mat:'',
            nguoi_ky:'',
            file:'',
            phe_duyet:'',
            id_user_xu_ly:'',
            han_xu_ly:'',
            ghi_chu:'',
            // bắt lỗi
            error:'',
        }
    },
    computed:{
        listUser(){
            return this.$store.getters.getListUser;
        },
        listNguonDen(){
            return this.$store.getters.getListNguonDen;
        },
        listLoai(){
            return this.$store.getters.getListLoai;
        }
    },
    methods:{
        async showAdd(){ //ẩn hiện form thêm
            if(this.show == false){
                this.show = true;
                await setTimeout(()=>{this.classadd='active'},200);
                await this.$store.dispatch('acListUser');
                await this.$store.dispatch('acListNguonDen');
                await this.$store.dispatch('acListLoai');
            }else{
                this.classadd = '';
                setTimeout(()=>{this.show = false},500);
            }
        },
        // Luu van ban den vao co so du lieu
        add(){
            var data = new FormData();
            data.append('id_nguon_den', this.id_nguon_den);
            data.append('so', this.so);
            data.append('ngay', this.ngay);
            data.append('id_loai', this.id_loai);
            data.append('trich_yeu', this.trich_yeu);
            data.append('do_mat', this.do_mat);
            data.append('nguoi_ky', this.nguoi_ky);
            data.append('file', this.file);
            data.append('phe_duyet', this.phe_duyet);
            data.append('id_user_xu_ly', this.id_user_xu_ly);
            data.append('han_xu_ly', this.han_xu_ly);
            data.append('ghi_chu', this.ghi_chu);
            axios.post('/px03/public/addvanbanden', data)
            .then(async response=>{
                this.id_nguon_den='';
                this.so='';
                this.ngay='';
                this.id_loai='';
                this.trich_yeu='';
                this.do_mat='';
                this.nguoi_ky='';
                this.file='';
                this.phe_duyet='';
                this.id_user_xu_ly='';
                this.han_xu_ly='';
                this.ghi_chu='';
                await this.$store.dispatch('acSearch', {data:this.dataRequestSearch, page:1});
            })
            .catch(error=>{
                this.error = error.response.data.errors;
            })
        },
        // lay thong tin file dinh kem vao bien file
        getFile(e){
            if(e.target.files[0] != undefined){
                this.file = e.target.files[0];
            }else{
                this.file = '';
            }
        },
        removeErr(){
            this.error ='';
        },
    }
}
</script>

<style>
.content__add{
    width:100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
.content__form-add{
    opacity: 0;
    margin-top: -436px;
    transition: all 0.5s ease;
}
.thongbao{
	color:crimson;
	font-size:0.8rem;
	margin-top: 5px;
}
</style>