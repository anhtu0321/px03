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
            <listcomponent @dataById="loadDataById" @viewDataById="loadViewDataById" :id="e_id"></listcomponent>
        </div>
  
        <!-- modal sửa văn bản đến -->
        <div class="content__modal-edit">
            <div class="modal fade bd-example-modal-lg" id="suavanbanden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa Văn bản đến</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="edit">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>Cơ quan ban hành</label>
                                        <select v-model="e_id_nguon_den" class="form-control form-control-sm">
                                            <option value="">--- Chọn cơ quan, đơn vị ban hành ---</option>
                                            <option v-for="nguonden in listNguonDen.data" :key="nguonden.id" :value="nguonden.id">{{ nguonden.ten_nguon }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Số văn bản</label>
                                        <input type="text" v-model="e_so" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Ngày văn bản</label>
                                        <input type="date" v-model="e_ngay" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Loại văn bản</label>
                                        <select class="form-control form-control-sm" v-model="e_id_loai">
                                            <option value="">--- Chọn Loại văn bản ---</option>
                                            <option v-for="loai in listLoai" :key="loai.id" :value="loai.id">{{ loai.ten_loai }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Trích yếu</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_trich_yeu">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Độ mật</label>
                                        <select class="form-control form-control-sm" v-model="e_do_mat">
                                            <option value="0">--- Chọn độ mật ---</option>
                                            <option value="1">Mật</option>
                                            <option value="2">Tối Mật</option>
                                            <option value="3">Tuyệt Mật</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Người ký</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_nguoi_ky">
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label>File đính kèm</label>
                                        <input type="file" class="form-control form-control-sm" @change="getFileEdit">
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label>Phê duyệt của lãnh đạo</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_phe_duyet">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Cán bộ xử lý</label>
                                        <select class="form-control form-control-sm" v-model="e_id_user_xu_ly">
                                            <option value="">--- Chọn Cán bộ xử lý ---</option>
                                            <option v-for="user in listUser.data" :key="user.id" :value="user.id">{{ user.fullname }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Hạn xử lý</label>
                                        <input type="date" class="form-control form-control-sm" v-model="e_han_xu_ly">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Ghi chú</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_ghi_chu">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3 text-right">
                                        <button class="btn btn-primary">Cập nhật Văn bản</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal Xem chi tiết văn bản đến -->
        <div class="content__modal-edit">
            <div class="modal fade bd-example-modal-lg" id="xemvanbanden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Chi tiết Văn bản đến</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="edit">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>Cơ quan ban hành</label>
                                        <input type="text" v-model="v_ten_nguon" class="form-control form-control-sm">
                                            
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Số văn bản</label>
                                        <input type="text" v-model="v_so" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Ngày văn bản</label>
                                        <input type="date" v-model="v_ngay" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Loại văn bản</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_ten_loai">
                                           
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Trích yếu</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_trich_yeu">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Độ mật</label>
                                        <select class="form-control form-control-sm" v-model="v_do_mat">
                                            <option value="0">--- Chọn độ mật ---</option>
                                            <option value="1">Mật</option>
                                            <option value="2">Tối Mật</option>
                                            <option value="3">Tuyệt Mật</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Người ký</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_nguoi_ky">
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label>File đính kèm</label>
                                        <input type="file" class="form-control form-control-sm" @change="getFileEdit">
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label>Phê duyệt của lãnh đạo</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_phe_duyet">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Cán bộ xử lý</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_user_xu_ly">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Hạn xử lý</label>
                                        <input type="date" class="form-control form-control-sm" v-model="v_han_xu_ly">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Ghi chú</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_ghi_chu">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Người nhập</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_nguoi_nhap">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Lưu trữ</label>
                                        <input type="text" class="form-control form-control-sm" v-model="v_luu_tru">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
            // Dữ liệu sửa văn bản
            e_id:'',
            e_id_nguon_den:'',
            e_so:'',
            e_ngay:'',
            e_id_loai:'',
            e_trich_yeu:'',
            e_do_mat:'',
            e_nguoi_ky:'',
            e_file:'',
            e_phe_duyet:'',
            e_id_user_xu_ly:'',
            e_han_xu_ly:'',
            e_ghi_chu:'',
             // Dữ liệu xem văn bản
           
            v_ten_nguon:'',
            v_so:'',
            v_ngay:'',
            v_ten_loai:'',
            v_trich_yeu:'',
            v_do_mat:'',
            v_nguoi_ky:'',
            v_file:'',
            v_phe_duyet:'',
            v_user_xu_ly:'',
            v_han_xu_ly:'',
            v_ghi_chu:'',
            v_luu_tru:'',
            v_nguoi_nhap:'',
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
            if(e.target.files[0] != undefined){
                this.file = e.target.files[0];
            }else{
                this.file = '';
            }
        },
         getFileEdit(e){
            if(e.target.files[0] != undefined){
                this.e_file = e.target.files[0];
            }else{
                this.e_file = '';
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
                await this.$store.dispatch('acListVanBanDen', 1);
            })
        },
        // Luu van ban den vao co so du lieu
        edit(){
            // console.log(this.e_id);
            var data = new FormData();
            data.append('id_nguon_den', this.e_id_nguon_den);
            data.append('so', this.e_so);
            data.append('ngay', this.e_ngay);
            data.append('id_loai', this.e_id_loai);
            data.append('trich_yeu', this.e_trich_yeu);
            data.append('do_mat', this.e_do_mat);
            data.append('nguoi_ky', this.e_nguoi_ky);
            data.append('file', this.e_file);
            data.append('phe_duyet', this.e_phe_duyet);
            data.append('id_user_xu_ly', this.e_id_user_xu_ly);
            data.append('han_xu_ly', this.e_han_xu_ly);
            data.append('ghi_chu', this.e_ghi_chu);
            axios.post('/px03/public/updatevanbanden/'+this.e_id, data)
            .then(async response=>{
                alert('Update thành công !');
                await this.$store.dispatch('acListVanBanDen', 1);
            })
        },
        // Load dữ liệu sau khi ấn sửa
        loadDataById(data){
            if(data.data[0].id) this.e_id = data.data[0].id;
            if(data.data[0].id_nguon_den) this.e_id_nguon_den = data.data[0].id_nguon_den;
            if(data.data[0].so) this.e_so = data.data[0].so;
            if(data.data[0].ngay) this.e_ngay = data.data[0].ngay;
            if(data.data[0].id_loai) this.e_id_loai = data.data[0].id_loai;
            if(data.data[0].trich_yeu) this.e_trich_yeu = data.data[0].trich_yeu;
            if(data.data[0].do_mat) this.e_do_mat = data.data[0].do_mat;
            if(data.data[0].nguoi_ky) this.e_nguoi_ky = data.data[0].nguoi_ky;
            if(data.data[0].phe_duyet)this.e_phe_duyet = data.data[0].phe_duyet;
            if(data.data[0].id_user_xu_ly) this.e_id_user_xu_ly = data.data[0].id_user_xu_ly;
            if(data.data[0].han_xu_ly) this.e_han_xu_ly = data.data[0].han_xu_ly;
            if(data.data[0].ghi_chu) this.e_ghi_chu = data.data[0].ghi_chu;
        },
        loadViewDataById(data){
            this.v_ten_nguon = data.data[0].ten_nguon;
            this.v_so = data.data[0].so;
            this.v_ngay = data.data[0].ngay;
            this.v_ten_loai = data.data[0].ten_loai;
            this.v_trich_yeu = data.data[0].trich_yeu;
            this.v_do_mat = data.data[0].do_mat;
            this.v_nguoi_ky = data.data[0].nguoi_ky;
            this.v_phe_duyet = data.data[0].phe_duyet;
            this.v_user_xu_ly = data.data[0].fullname;
            this.v_han_xu_ly = data.data[0].han_xu_ly;
            this.v_ghi_chu = data.data[0].ghi_chu;
            this.v_luu_tru = data.data[0].luu_tru;
            this.v_nguoi_nhap = data.data[0].nguoi_nhap;
        }
    },
    components:{
        editor, 
        listcomponent,
    },

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