<template>
    <div class="content__search">
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
            <div class="form-row content__form-expand" :class="classexpand" v-if="expand">
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
</template>

<script>
export default {
    data(){
        return{
            expand: false,
            classexpand:'',
            // Dữ liệu tìm kiếm
            date_begin:'',
            date_end:'',
            trich_yeu:'',
            so:'',
            id_nguon_den:'',
            id_loai:'',
            do_mat:'',
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
            if(this.expand == true){
                this.classexpand = '';
                setTimeout(()=>{this.expand = !this.expand;},500);
                
            }else{
                await setTimeout(()=>{this.classexpand='active'},200);
                await this.$store.dispatch('acListNguonDen');
                await this.$store.dispatch('acListLoai');
                this.expand = !this.expand;
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
            this.$store.dispatch('acSearch', data);
        }
    }, 
    
}
</script>

<style>
.content__form-expand{
    opacity: 0;
    margin-top: -138px;
    transition: all 0.5s ease;
}
.content__search{
    width:100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
</style>