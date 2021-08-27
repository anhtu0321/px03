<template>
    <div class="content__add mt-3 bg-light">
        <button class="btn btn-danger btn-sm mb-3" @click.prevent="showAdd" v-if="show">
            <i class="fas fa-times"></i> Đóng
        </button>
        <button class="btn btn-success btn-sm mb-3" @click.prevent="showAdd" v-else>
            <i class="fas fa-plus-square"></i> Thêm Văn bản đi
        </button>
        <transition name="add-di">
            <div class="content__form-add" v-if="show">
                <div class="bg-info d-flex justify-content-center align-items-center mb-3 p-2 tieude">
                    THÊM VĂN BẢN ĐI
                </div>
                
                <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="add">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Cơ quan ban hành</label>
                            <select v-model="id_nguon_di" class="form-control form-control-sm">
                                <option value="">--- Chọn cơ quan, đơn vị ban hành ---</option>
                                <option v-for="nguondi in listNguonDi.data" :key="nguondi.id" :value="nguondi.id">{{ nguondi.ten_nguon }}</option>
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
                        <div class="col-md-12 mb-3">
                            <label>Nội dung</label>
                            <froala :tag="'textarea'" :config="config" v-model="noi_dung"></froala>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Độ mật</label>
                            <select class="form-control form-control-sm" v-model="do_mat">
                                <option value="">Không mật</option>
                                <option value="1">Mật</option>
                                <option value="2">Tối Mật</option>
                                <option value="3">Tuyệt Mật</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Lãnh đạo ký</label>
                            <select class="form-control form-control-sm" v-model="id_lanh_dao">
                                <option value="">--- Chọn Lãnh đạo ký ---</option>
                                <option v-for="lanhdao in listLanhDao.data" :key="lanhdao.id" :value="lanhdao.id">{{ lanhdao.cap_bac }} {{ lanhdao.ho_ten }}</option>
                            </select>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label>File đính kèm</label>
                            <input type="file" class="form-control form-control-sm" @change="getFile">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Đơn vị nhận</label>
                            <div class="form-row">
                                <select class="form-control form-control-sm col-md-5" v-model="don_vi_nhan" multiple>
                                    <option v-for="donvi in listDonViFirst" :key="donvi.id" :value="donvi.id">{{ donvi.ky_hieu }}</option>
                                </select>
                                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                    <button class="btn mb-3 btn-info" style="width:50px" @click.prevent="addListOneDV">></button>
                                    <button class="btn mb-3 btn-info" style="width:50px" @click.prevent="addListAllDV">>></button>
                                    <button class="btn mb-3 btn-warning" style="width:50px" @click.prevent="removeListOneDV"><</button>
                                    <button class="btn mb-3 btn-warning" style="width:50px" @click.prevent="removeListAllDV"><<</button>
                                </div>
                                <select class="form-control form-control-sm col-md-5" v-model="don_vi_nhan_ed" multiple>
                                    <option v-for="donvi in listDonViEd" :key="donvi.id" :value="donvi.id">{{ donvi.ky_hieu }}</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Cán bộ tham mưu</label>
                            <input type="text" class="form-control form-control-sm" v-model="can_bo_tham_muu">
                        </div>
                        <div class="col-md-9 mb-3">
                            <label>Lưu trữ</label>
                            <input type="text" class="form-control form-control-sm" v-model="luu_tru">
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
        </transition>
    </div>
</template>

<script>
// import tiptap editor
// import VueFroala from 'vue-froala-wysiwyg';
 
// end tiptap
export default {
    data(){
        return{
             // dùng để ẩn hiện form thêm
            show:false,
            //dữ liệu thêm văn bản 
            id_nguon_di:'',
            so:'',
            ngay:'',
            id_loai:'',
            trich_yeu:'',
            noi_dung:'',
            do_mat:'',
            id_lanh_dao:'',
            file:'',
            listDonViEd:[],
            listDonViFirst:[],
            can_bo_tham_muu:'',
            luu_tru:'',
            ghi_chu:'',
            // mang don vi nhan
            don_vi_nhan:[],
            don_vi_nhan_ed:[],
            // bắt lỗi
            error:'',
            // trình soạn thảo
            config: {
                events: {
                    'froalaEditor.initialized': function () {
                    console.log('initialized')
                    }
                }
            },
        }
    },
    computed:{
        listUser(){
            return this.$store.getters.getListUser;
        },
        listNguonDi(){
            return this.$store.getters.getListNguonDi;
        },
        listLoai(){
            return this.$store.getters.getListLoai;
        },
        listLanhDao(){
            return this.$store.state.listLanhDao;
        },
        listDonVi(){
            return this.$store.state.listDonVi;
        },
        // computed for quill
        
    },
    methods:{
        async showAdd(){ //ẩn hiện form thêm
            if(this.show == false){
                this.show = true;
                if(this.listNguonDi=='') await this.$store.dispatch('acListNguonDi');
                if(this.listLoai=='') await this.$store.dispatch('acListLoai');
                if(this.listLanhDao=='') await this.$store.dispatch('acListLanhDao');
                if(this.$store.state.listDonVi =='') await this.$store.dispatch('acListDonVi');
                this.listDonViFirst = this.listDonVi;
                this.listDonViEd='';
            }else{
                this.show = false;
            }
        },
        // Luu van ban den vao co so du lieu
        add(){
            var listNameDonVi = this.listDonViEd.map( e=>{
                return e.ky_hieu;
            });
            var donViNhan = listNameDonVi.join(', ');
            var data = new FormData();
            data.append('id_nguon_di', this.id_nguon_di);
            data.append('so', this.so);
            data.append('ngay', this.ngay);
            data.append('id_loai', this.id_loai);
            data.append('trich_yeu', this.trich_yeu);
            data.append('noi_dung', this.noi_dung);
            data.append('do_mat', this.do_mat);
            data.append('id_lanh_dao', this.id_lanh_dao);
            data.append('file', this.file);
            data.append('don_vi_nhan', donViNhan);
            data.append('can_bo_tham_muu', this.can_bo_tham_muu);
            data.append('luu_tru', this.luu_tru);
            data.append('ghi_chu', this.ghi_chu);

            axios.post('/px03/public/addvanbandi', data)
            .then(async response=>{
                this.id_nguon_den='';
                this.so='';
                this.ngay='';
                this.id_loai='';
                this.trich_yeu='';
                this.noi_dung=' ';
                this.do_mat='';
                this.id_lanh_dao='';
                this.file='';
                this.removeListAllDV();
                this.can_bo_tham_muu='';
                this.luu_tru='';
                this.ghi_chu='';
                this.$store.dispatch('acSearchDi', {data:this.dataRequestSearch, page:1});
            })
            .catch(error=>{
                this.error = error.response.data.errors;
                console.log(this.error);
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
        addListOneDV(){
            var listChon = this.listDonViFirst.filter(list=>{
                return this.don_vi_nhan.includes(list.id);
            });
            var listConLai = this.listDonViFirst.filter(list =>{
                return this.don_vi_nhan.includes(list.id) == false;
            });
            if(this.listDonViEd != []) {this.listDonViEd = this.listDonViEd.concat(listChon);}
            else{this.listDonViEd = listChon;}
            this.listDonViFirst = listConLai;
        },
        async addListAllDV(){
            this.listDonViEd = await this.listDonVi;
            this.listDonViFirst = [];
        },
        removeListOneDV(){
            // xử lý các đơn vị chưa được chọn
            var listChon = this.listDonViEd.filter(list=>{
                return this.don_vi_nhan_ed.includes(list.id);
            });
            this.listDonViFirst = this.listDonViFirst.concat(listChon);
            // xử lý các đơn vị được chọn
            this.listDonViEd = this.listDonViEd.filter(list=>{
                return this.don_vi_nhan_ed.includes(list.id) == false;
            });
        },
        removeListAllDV(){
            this.listDonViFirst = this.listDonVi;
            this.listDonViEd = [];
        },
        removeErr(){
            this.error ='';
        },
        
    },
    components:{
        
    }, 
    
}
</script>

<style scoped>

.content__add{
    width:100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
.thongbao{
	color:crimson;
	font-size:0.8rem;
	margin-top: 5px;
}
.add-di-enter-active, .add-di-leave-active {
  transition: opacity .5s;
}
.add-di-enter, .add-di-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>