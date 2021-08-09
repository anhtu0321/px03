<template>
    <div class="content__sub mt-3">
        <div class="content__search">
            <form>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label>Ngày văn bản</label>
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center">
                                <span class="mr-2">Từ </span> <input type="date" class="form-control form-control-sm" >
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <span class="mr-2">Đến </span><input type="date" class="form-control form-control-sm"  >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label>Trích yếu</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    
                </div>
                <div class="form-row content__form-expand" :class="classexpand" v-if="expand">
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03">Số Văn bản</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Loại Văn bản</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Nguồn văn bản</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03">Độ mật</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Loại Văn bản</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Nguồn văn bản</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03">Độ mật</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Tìm kiếm</button>
                    </div>
                    <div class="col-md-6 mb-3 text-right">
                        <button class="btn btn-default" @click.prevent="showExpand">
                            <div v-if="expand">
                                <i class="fas fa-search-minus"></i> Tìm đơn giản <i class="fas fa-caret-up"></i>
                            </div>
                            <div v-else>
                                <i class="fas fa-search-plus"></i> Tìm kiếm nâng cao <i class="fas fa-caret-down"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
                                <input type="text" class="form-control form-control-sm" v-model="trich_yeu">
                            </div>
                            <!-- <div class="col-md-12 mb-3">
                                <label>Nội dung</label>
                                <editor 
                                    api-key="qp0azz3bxgs5kvvmhnnh0fno0i1pmcnbfaty2wgefpgvmojc"
                                    :init="{
                                        height: 250,
                                        menubar: false,
                                        plugins: [
                                        'advlist autolink lists link image charmap print preview anchor',
                                        'searchreplace visualblocks code fullscreen',
                                        'insertdatetime media table paste code help wordcount'
                                        ],
                                        toolbar:
                                        'undo redo | formatselect | bold italic backcolor | \
                                        alignleft aligncenter alignright alignjustify | \
                                        bullist numlist outdent indent | removeformat | help'
                                    }">
                                </editor>
                                
                            </div> -->
                            <div class="col-md-4 mb-3">
                                <label>Độ mật</label>
                                <select class="form-control form-control-sm" v-model="do_mat">
                                    <option value="0">--- Chọn độ mật ---</option>
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
        <div class="content__list mb-3 mt-3">
            <listcomponent></listcomponent>
        </div>
    </div>
</template>

<script>
import editor from '@tinymce/tinymce-vue';
import listcomponent from './vanbanden/list.vue';
export default {
    data(){
        return{
            // dùng để ẩn hiện tìm kiếm nâng cao
            expand: false,
            classexpand:'',
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
        showAdd(){ //ẩn hiện form thêm
            if(this.show == false){
                this.show = true;
                setTimeout(()=>{this.classadd='active'},200);
            }else{
                this.classadd = '';
                setTimeout(()=>{this.show = false},500);
            }
        },
        showExpand(){ //ẩn hiện tìm kiếm
            if(this.expand == true){
                this.classexpand = '';
                setTimeout(()=>{this.expand = !this.expand;},500);
                
            }else{
                this.expand = !this.expand;
                setTimeout(()=>{this.classexpand='active'},200);
            }
        },
        // lay thong tin file dinh kem vao bien file
        getFile(e){
            this.file = e.target.files[0];
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
            .then(response=>{
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
            })
        }
    },
    components:{
        editor, 
        listcomponent,
    },
    mounted(){
        this.$store.dispatch('acListUser');
        this.$store.dispatch('acListNguonDen');
        this.$store.dispatch('acListLoai');   
    }
}
</script>

<style>
.content__search{
    width:100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
.content__add{
    width:100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
.content__form-expand{
    opacity: 0;
    margin-top: -138px;
    transition: all 0.5s ease;
}
.content__form-add{
    opacity: 0;
    margin-top: -120px;
    transition: all 0.5s ease;
}
.active{
    opacity:1;
    margin-top:0;
}
.tieude{
    font-size: 1.2rem;
    color: #ffffff;
    font-weight: bold;
}
.content__list{
    width: 100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}

</style>