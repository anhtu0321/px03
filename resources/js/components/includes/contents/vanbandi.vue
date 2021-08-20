<template>
    <div class="content__sub mt-3">
        <search-component v-if="ktquyen('vanbandi_xem')"></search-component>
        <add-component v-if="ktquyen('vanbandi_them')"></add-component>
        <listcomponent @dataById="loadDataById" @viewDataById="loadViewDataById" :id="e_id" @getPage="setPage" v-if="ktquyen('vanbandi_xem')"></listcomponent>
        <!-- modal sửa văn bản đi -->
        <div class="content__modal-edit">
            <div class="modal fade bd-example-modal-lg" id="suavanbandi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa Văn bản đi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="edit">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label>Cơ quan ban hành</label>
                                        <select v-model="e_id_nguon_di" class="form-control form-control-sm">
                                            <option value="">--- Chọn cơ quan, đơn vị ban hành ---</option>
                                            <option v-for="nguondi in listNguonDi.data" :key="nguondi.id" :value="nguondi.id">{{ nguondi.ten_nguon }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Số văn bản</label>
                                        <input type="text" v-model="e_so" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Ngày văn bản</label>
                                        <input type="date" v-model="e_ngay" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Loại văn bản</label>
                                        <select class="form-control form-control-sm" v-model="e_id_loai">
                                            <option value="">--- Chọn Loại văn bản ---</option>
                                            <option v-for="loai in listLoai" :key="loai.id" :value="loai.id">{{ loai.ten_loai }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Trích yếu</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_trich_yeu" :class="{'is-invalid':(error && error.trich_yeu)}" @focus="removeErr">
                                        <p class="thongbao" v-if="error && error.trich_yeu">{{ error.trich_yeu[0] }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Nội dung</label>
                                        <!-- <editor 
                                            v-model="e_noi_dung"
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
                                        </editor> -->
                                        
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Độ mật</label>
                                        <select class="form-control form-control-sm" v-model="e_do_mat">
                                            <option value="">Không mật</option>
                                            <option value="1">Mật</option>
                                            <option value="2">Tối Mật</option>
                                            <option value="3">Tuyệt Mật</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Lãnh đạo ký</label>
                                        <select class="form-control form-control-sm" v-model="e_id_lanh_dao">
                                            <option value="">--- Chọn Lãnh đạo ký ---</option>
                                            <option v-for="lanhdao in listLanhDao.data" :key="lanhdao.id" :value="lanhdao.id">{{ lanhdao.cap_bac }} {{ lanhdao.ho_ten }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label>File đính kèm</label>
                                        <input type="file" class="form-control form-control-sm" @change="getFileEdit">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Đơn vị nhận</label>
                                        <div class="form-row">
                                            <select class="form-control form-control-sm col-md-5" v-model="e_don_vi_nhan" multiple>
                                                <option v-for="donvi in listDonVi" :key="donvi.id" :value="donvi.id">{{ donvi.ten_phong }}</option>
                                            </select>
                                            <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                                <button class="btn mb-3 btn-info" style="width:50px" @click.prevent="addListOneDV">></button>
                                                <button class="btn mb-3 btn-info" style="width:50px" @click.prevent="addListAllDV">>></button>
                                                <button class="btn mb-3 btn-warning" style="width:50px" @click.prevent="removeListOneDV"><</button>
                                                <button class="btn mb-3 btn-warning" style="width:50px" @click.prevent="removeListAllDV"><<</button>
                                            </div>
                                            <select class="form-control form-control-sm col-md-5" v-model="e_don_vi_nhan_ed" multiple>
                                                <option v-for="donvi in e_listDonViEd" :key="donvi.id" :value="donvi.id">{{ donvi.ten_phong }}</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Cán bộ tham mưu</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_can_bo_tham_muu">
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <label>Lưu trữ</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_luu_tru">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Ghi chú</label>
                                        <input type="text" class="form-control form-control-sm" v-model="e_ghi_chu">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3 text-right">
                                        <button class="btn btn-primary">Sửa Văn bản</button>
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
        <!-- <div class="content__modal-edit">
            <div class="modal fade bd-example-modal-lg" id="xemvanbandi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Chi tiết Văn bản đến</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          
                                <div class="form-row details">
                                    <div class="col-md-3 mb-3">
                                        <label>Cơ quan ban hành</label>
                                        <div class="text-primary" >{{v_ten_nguon}}</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Số văn bản</label>
                                        <div class="text-primary" >{{v_so}}</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Ngày văn bản</label>
                                        <div class="text-primary" >{{v_ngay}}</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Loại văn bản</label>
                                        <div class="text-primary" >{{v_ten_loai}}</div>  
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Trích yếu</label>
                                        <div class="text-primary" >{{v_trich_yeu}}</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Độ mật</label>
                                        <div class="text-primary" > {{ getNameDoMat(v_do_mat) }}</div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Người ký</label>
                                        <div class="text-primary" >{{v_nguoi_ky}}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>File đính kèm</label>
                                        <div class="text-primary" >
                                            <span v-if="['doc', 'docx', 'xls', 'xlsx'].includes(v_duoi_file)">
                                                <a :href="`/px03/public/vanbandiupload/${ v_file }`">
                                                    <img width="25px" src="/px03/public/images/word-icon.png"> {{v_file}}
                                                </a>
                                            </span>
                                            <span v-else-if="['pdf'].includes(v_duoi_file)">
                                                <a :href="`/px03/public/vanbandiupload/${ v_file }`"> {{v_file}}
                                                    <img width="25px" src="/px03/public/images/pdf-icon.png">
                                                </a>
                                            </span>
                                            <span v-else-if="['jpg', 'jpeg', 'png'].includes(v_duoi_file)">
                                                <a :href="`/px03/public/vanbandiupload/${ v_file }`">
                                                    <img width="25px" src="/px03/public/images/img-icon.png"> {{v_file}}
                                                </a>
                                            </span>
                                            <span v-else-if="(v_file == '') || (v_file == null) "></span>
                                            <span v-else>
                                                <a :href="`/px03/public/vanbandiupload/${ v_file }`">
                                                    <img width="25px" src="/px03/public/images/blank-file-icon.png"> {{v_file}}
                                                </a>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Ghi chú</label>
                                        <div class="text-primary">{{v_ghi_chu}}</div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Phê duyệt của lãnh đạo</label>
                                        <div class="text-primary">{{v_phe_duyet}}</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Cán bộ xử lý</label>
                                        <div class="text-primary">{{v_user_xu_ly}}</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Hạn xử lý</label>
                                        <div class="text-primary">{{v_han_xu_ly}}</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Trạng thái</label>
                                        <div class="text-primary" :class="trang_thai_color(xuLyTrangThai(v_trang_thai, v_han_xu_ly))">{{xuLyTrangThai(v_trang_thai, v_han_xu_ly)}}</div>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label>Lưu trữ</label>
                                        <div class="text-primary">{{v_luu_tru}}</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Người nhập</label>
                                        <div class="text-primary">{{v_nguoi_nhap}}</div>
                                    </div>
                                </div>
  
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
// import editor from '@tinymce/tinymce-vue';
import listcomponent from './vanbandi/list.vue';
import addComponent from './vanbandi/add.vue';
import searchComponent from './vanbandi/search.vue';
export default {
    data(){
        return{
            page:1,
            // Dữ liệu sửa văn bản
            e_id:'',
            e_id_nguon_di:'',
            e_so:'',
            e_ngay:'',
            e_id_loai:'',
            e_trich_yeu:'',
            e_noi_dung:'',
            e_do_mat:'',
            e_id_lanh_dao:'',
            e_don_vi_nhan:[],
            e_don_vi_nhan_ed:[],
            e_can_bo_tham_muu:'',
            e_luu_tru:'',
            e_ghi_chu:'',
            e_listDonViEd:'',
             // Dữ liệu xem văn bản
           
            v_id:'',
            v_id_nguon_di:'',
            v_so:'',
            v_ngay:'',
            v_id_loai:'',
            v_trich_yeu:'',
            v_noi_dung:'',
            v_do_mat:'',
            v_id_lanh_dao:'',
            v_don_vi_nhan:[],
            v_don_vi_nhan_ed:[],
            v_can_bo_tham_muu:'',
            v_luu_tru:'',
            v_ghi_chu:'',
            v_listDonViEd:'',
            // Bắt lỗi
            error:'',
        }
    },
    computed:{
       
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
		listPermissionOfUser(){
			return this.$store.getters.getListPermissionOfUser;
        },
        dataRequestSearchDi(){
            return this.$store.state.dataRequestSearchDi;
        }
    },
    methods:{
        getNameDoMat(domat){
            switch (domat) {
                case 1:
                    return "Mật";
                    break;
                case 2:
                    return "Tối mật";
                    break;
                case 3:
                    return "Tuyệt mật";
                    break;
                default:
                    return "Không mật";
                    break;
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
            axios.post('/px03/public/updatevanbandi/'+this.e_id, data)
            .then(async response=>{
                alert('Update thành công !');
                await this.$store.dispatch('acSearch', {data:this.dataRequestSearchDi, page:this.page});
            })
        },
        // Load dữ liệu sau khi ấn sửa
        loadDataById(data){     
            this.e_id='';
            this.e_id_nguon_di='';
            this.e_so='';
            this.e_ngay='';
            this.e_id_loai='';
            this.e_trich_yeu='';
            this.e_noi_dung='';
            this.e_do_mat='';
            this.e_id_lanh_dao='';
            this.e_don_vi_nhan=[];
            this.e_don_vi_nhan_ed=[];
            this.e_can_bo_tham_muu='';
            this.e_luu_tru='';
            this.e_ghi_chu='';
            this.e_listDonViEd='';
            if(data.data[0].id) this.e_id = data.data[0].id;
            if(data.data[0].id_nguon_di) this.e_id_nguon_di = data.data[0].id_nguon_di;
            if(data.data[0].so) this.e_so = data.data[0].so;
            if(data.data[0].ngay) this.e_ngay = data.data[0].ngay;
            if(data.data[0].id_loai) this.e_id_loai = data.data[0].id_loai;
            if(data.data[0].trich_yeu) this.e_trich_yeu = data.data[0].trich_yeu;
            if(data.data[0].noi_dung) this.e_noi_dung = data.data[0].noi_dung;
            if(data.data[0].do_mat) this.e_do_mat = data.data[0].do_mat;
            if(data.data[0].id_lanh_dao) this.e_id_lanh_dao = data.data[0].id_lanh_dao;

            if(data.data[0].don_vi_nhan) {
                var don_vi_nhan = data.data[0].don_vi_nhan.replace(/, /g, ',').split(',');
                this.e_listDonViEd = this.listDonVi.filter( e=>{
                    return don_vi_nhan.includes(e.ky_hieu);
                });
            }

            if(data.data[0].can_bo_tham_muu)this.e_can_bo_tham_muu = data.data[0].can_bo_tham_muu;
            if(data.data[0].luu_tru) this.e_luu_tru = data.data[0].luu_tru;
            if(data.data[0].ghi_chu) this.e_ghi_chu = data.data[0].ghi_chu;
        },
        loadViewDataById(data){
            this.v_ten_nguon = data.data[0].ten_nguon;
            this.v_so = data.data[0].so;
            this.v_ngay = data.data[0].ngay;
            this.v_ten_loai = data.data[0].ten_loai;
            this.v_trich_yeu = data.data[0].trich_yeu;
            this.v_do_mat = data.data[0].do_mat;
            this.v_file = data.data[0].file;
            this.v_duoi_file = data.data[0].duoi_file;
            this.v_nguoi_ky = data.data[0].nguoi_ky;
            this.v_phe_duyet = data.data[0].phe_duyet;
            this.v_user_xu_ly = data.data[0].fullname;
            this.v_han_xu_ly = data.data[0].han_xu_ly;
            this.v_ghi_chu = data.data[0].ghi_chu;
            this.v_nguoi_nhap = data.data[0].nguoi_nhap;
            this.v_luu_tru = data.data[0].luu_tru;
            this.v_trang_thai = data.data[0].trang_thai;
        },
        trang_thai_color(value){
            switch (value) {
                case 'Chưa xử lý':
                    return "text-warning";
                    break;
                case 'Đang xử lý':
                    return "text-info";
                    break;
                case 'Hoàn thành':
                    return "text-success";
                    break;
                case 'Thất bại':
                    return "text-danger";
                    break;
                case 'Quá hạn':
                    return "text-danger";
                    break;
                default:
                    break;
            }  
        },
        xuLyTrangThai(trangthai, hanxuly){
            let d = new Date();
            let today = new Date(d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate());
            // today = today.getTime(); -> hàm này để chuyển ngày sang miniseconds
            if(hanxuly != undefined) {
                let date = new Date(hanxuly);
                if((['Chưa xử lý', 'Đang xử lý'].includes(trangthai) == true) && (today > date)){
                    return "Quá hạn";
                }
            }
            return trangthai;
        },
        setPage(page){
            this.page = page;
        },
		ktquyen(key_code){
			for(var i in this.listPermissionOfUser){
				if(this.listPermissionOfUser[i].key_code == key_code){
					return true;
				}
			}
			return false;
        },
        removeErr(){
            this.error ='';
        },
        addListOneDV(){
            var listChon = this.listDonVi.filter(list=>{
                return this.don_vi_nhan.includes(list.id);
            });
            var listConLai = this.listDonVi.filter(list =>{
                return this.don_vi_nhan.includes(list.id) == false;
            });
            this.listDonViEd = this.listDonViEd.concat(listChon);
            this.$store.dispatch('acChangeListDonVi', {'data':listConLai});
        },
        async addListAllDV(){
            if(this.listDonVi.length != 0){
                this.listDonViEd = await this.listDonVi.concat(this.listDonViEd);
            }
            await this.$store.dispatch('acChangeListDonVi', {'data':[]});
        },
        removeListOneDV(){
            // xử lý các đơn vị chưa được chọn
            var listChon = this.listDonViEd.filter(list=>{
                return this.don_vi_nhan_ed.includes(list.id);
            });
            var listConLai = this.listDonVi.concat(listChon);
            this.$store.dispatch('acChangeListDonVi', {'data':listConLai});
            // xử lý các đơn vị được chọn
            this.listDonViEd = this.listDonViEd.filter(list=>{
                return this.don_vi_nhan_ed.includes(list.id) == false;
            });
        },
        removeListAllDV(){
            var listConLai = this.listDonVi.concat(this.listDonViEd);
            this.$store.dispatch('acChangeListDonVi', {'data':listConLai});
            this.listDonViEd = [];
        },
    },
    components:{
        // editor, 
        listcomponent,
        searchComponent,
        addComponent,
    },

}
</script>

<style>
.form-row.details>div{
    border-top:1px dashed rgb(219, 222, 248);
    border-radius:3px;
    padding:5px;
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
</style>