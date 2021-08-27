<template>
    <div class="content__search bg-light">
        <form @submit.prevent="search">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Ngày văn bản</label>
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <span class="mr-2">Từ </span> <input type="date" class="form-control form-control-sm" v-model="date_begin">
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <span class="mr-2">Đến </span><input type="date" class="form-control form-control-sm" v-model="date_end" >
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-3">
                    <label>Trích yếu</label>
                    <input type="text" class="form-control form-control-sm" v-model="trich_yeu">
                </div>
                
            </div>
            <transition name="search-di">
                <div class="form-row content__form-expand" v-if="expand">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Cơ quan ban hành</label>
                        <select v-model="id_nguon_di" class="form-control form-control-sm">
                            <option value="">--- Chọn cơ quan, đơn vị ban hành ---</option>
                            <option v-for="nguondi in listNguonDi.data" :key="nguondi.id" :value="nguondi.id">{{ nguondi.ten_nguon }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom03">Loại Văn bản</label>
                        <select class="form-control form-control-sm" v-model="id_loai">
                            <option value="">--- Chọn Loại văn bản ---</option>
                            <option v-for="loai in listLoai" :key="loai.id" :value="loai.id">{{ loai.ten_loai }}</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom03">Số Văn bản</label>
                        <input type="text" class="form-control form-control-sm" v-model="so">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03">Độ mật</label>
                        <select class="form-control form-control-sm" v-model="do_mat">
                            <option value="">-- Tất cả --</option>
                            <option value="-1">Không mật</option>
                            <option value="1">Mật</option>
                            <option value="2">Tối Mật</option>
                            <option value="3">Tuyệt Mật</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nội dung</label>
                        <input type="text" class="form-control form-control-sm" v-model="noi_dung">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Đơn vị nhận</label>
                        <input type="text" class="form-control form-control-sm" v-model="don_vi_nhan">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Cán bộ tham mưu</label>
                        <input type="text" class="form-control form-control-sm" v-model="can_bo_tham_muu">
                    </div>
        
                </div>
            </transition>
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
</template>

<script>
export default {
    data(){
        return{
            expand: false,
            // Dữ liệu tìm kiếm
            date_begin:'',
            date_end:'',
            trich_yeu:'',
            so:'',
            id_nguon_di:'',
            id_loai:'',
            do_mat:'',
            noi_dung:'',
            don_vi_nhan:'',
            can_bo_tham_muu:'',
        }
    },
    computed:{
        listNguonDi(){
            return this.$store.getters.getListNguonDi;
        },
        listLoai(){
            return this.$store.getters.getListLoai;
        }
    },
    methods:{
        async showExpand(){ //ẩn hiện tìm kiếm
            if(this.expand == true){
                this.expand = !this.expand;
            }else{
                if(this.listNguonDi =='') await this.$store.dispatch('acListNguonDi');
                if(this.listLoai=='') await this.$store.dispatch('acListLoai');
                this.expand = !this.expand;
            }
        },
        search(){
            let data = new FormData();
            data.append('date_begin', this.date_begin);
            data.append('date_end', this.date_end);
            data.append('trich_yeu', this.trich_yeu);
            data.append('so', this.so);
            data.append('id_nguon_di', this.id_nguon_di);
            data.append('id_loai', this.id_loai);
            data.append('do_mat', this.do_mat);
            data.append('noi_dung', this.noi_dung);
            data.append('don_vi_nhan', this.don_vi_nhan);
            data.append('can_bo_tham_muu', this.can_bo_tham_muu);
            this.$store.dispatch('acSearchDi', {data:data, page:1});
            this.$store.dispatch('acRequestSearchDi', data);
        }
    }, 
    
}
</script>

<style scoped>
.content__search{
    width:100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
.search-di-enter-active, .search-di-leave-active {
  transition: opacity .5s;
}
.search-di-enter, .search-di-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>