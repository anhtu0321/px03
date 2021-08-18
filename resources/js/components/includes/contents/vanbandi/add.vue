<template>
    <div class="content__add mt-3">
        <button class="btn btn-danger btn-sm mb-3" @click.prevent="showAdd" v-if="show">
            <i class="fas fa-times"></i> Đóng
        </button>
        <button class="btn btn-success btn-sm mb-3" @click.prevent="showAdd" v-else>
            <i class="fas fa-plus-square"></i> Thêm Văn bản đi
        </button>
        <div class="content__form-add" :class="classadd" v-if="show">
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
                        <input type="text" class="form-control form-control-sm" v-model="trich_yeu">
                    </div>
                    <div class="col-md-12 mb-3">
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
                    <div class="col-md-7 mb-3">
                        <label>Đơn vị nhận</label>
                        <input type="text" class="form-control form-control-sm" v-model="phe_duyet">
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label>Ghi chú</label>
                        <input type="text" class="form-control form-control-sm" v-model="ghi_chu" @click="test">
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
import Editor from '@tinymce/tinymce-vue'
export default {
    data(){
        return{
             // dùng để ẩn hiện form thêm
            show:false,
            classadd:'',
            //dữ liệu thêm văn bản 
            id_nguon_di:'',
            so:'',
            ngay:'',
            id_loai:'',
            trich_yeu:'',
            do_mat:'',
            id_lanh_dao:'',
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
        listNguonDi(){
            return this.$store.getters.getListNguonDi;
        },
        listLoai(){
            return this.$store.getters.getListLoai;
        },
        listLanhDao(){
            return this.$store.state.listLanhDao;
        }
    },
    methods:{
        async showAdd(){ //ẩn hiện form thêm
            if(this.show == false){
                this.show = true;
                await setTimeout(()=>{this.classadd='active'},200);
                await this.$store.dispatch('acListNguonDi');
                await this.$store.dispatch('acListLoai');
                await this.$store.dispatch('acListLanhDao');
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
        },
        // lay thong tin file dinh kem vao bien file
        getFile(e){
            if(e.target.files[0] != undefined){
                this.file = e.target.files[0];
            }else{
                this.file = '';
            }
        },
        test(e){
             console.log(e.target.ClassName);
        }
    },
    components:{
        'editor': Editor
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
</style>