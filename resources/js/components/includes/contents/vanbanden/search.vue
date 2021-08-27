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
            <transition name="search">
                <div class="form-row content__form-expand" v-if="show">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">Cơ quan ban hành</label>
                        <select v-model="id_nguon_den" class="form-control form-control-sm">
                            <option value="">--- Chọn cơ quan, đơn vị ban hành ---</option>
                            <option v-for="nguonden in listNguonDen.data" :key="nguonden.id" :value="nguonden.id">{{ nguonden.ten_nguon }}</option>
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
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03">Trạng thái xử lý</label>
                        <select class="form-control form-control-sm" v-model="trang_thai">
                            <option value="">-- Tất cả --</option>
                            <option value="Hoàn thành">Hoàn thành</option>
                            <option value="Thất bại">Thất bại</option>
                            <option value="Chưa xử lý">Chưa xử lý</option>
                            <option value="Đang xử lý">Đang xử lý</option>
                            <option value="Quá hạn">Quá hạn</option>
                        </select>
                    </div>
                </div>
            </transition>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Tìm kiếm</button>
                </div>
                <div class="col-md-6 mb-3 text-right">
                    <button class="btn btn-default" @click.prevent="showExpand">
                        <div v-if="show">
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
            show: false,
            classexpand:'',
            // Dữ liệu tìm kiếm
            date_begin:'',
            date_end:'',
            trich_yeu:'',
            so:'',
            id_nguon_den:'',
            id_loai:'',
            do_mat:'',
            trang_thai:'',
        }
    },
    computed:{
        listNguonDen(){
            return this.$store.getters.getListNguonDen;
        },
        listLoai(){
            return this.$store.getters.getListLoai;
        }
    },
    methods:{
        async showExpand(){ //ẩn hiện tìm kiếm
            if(this.show == true){
                this.show = !this.show
            }else{
                if(this.listNguonDen =='') await this.$store.dispatch('acListNguonDen');
                if(this.listLoai=='') await this.$store.dispatch('acListLoai');
                this.show = !this.show;
            }
        },
        search(){
            let data = new FormData();
            data.append('date_begin', this.date_begin);
            data.append('date_end', this.date_end);
            data.append('trich_yeu', this.trich_yeu);
            data.append('so', this.so);
            data.append('id_nguon_den', this.id_nguon_den);
            data.append('id_loai', this.id_loai);
            data.append('do_mat', this.do_mat);
            data.append('trang_thai', this.trang_thai);
            this.$store.dispatch('acSearch', {data:data, page:1});
            this.$store.dispatch('acRequestSearch', data);
        }
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
.search-enter-active, .search-leave-active {
  transition: opacity .5s;
}
.search-enter, .search-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>