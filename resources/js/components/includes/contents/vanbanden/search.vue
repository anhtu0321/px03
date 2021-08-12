<template>
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
</template>

<script>
export default {
    data(){
        return{
            expand: false,
            classexpand:'',
        }
    },
    methods:{
        showExpand(){ //ẩn hiện tìm kiếm
            if(this.expand == true){
                this.classexpand = '';
                setTimeout(()=>{this.expand = !this.expand;},500);
                
            }else{
                this.expand = !this.expand;
                setTimeout(()=>{this.classexpand='active'},200);
            }
        },
    }
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