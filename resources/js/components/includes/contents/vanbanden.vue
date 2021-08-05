<template>
    <div class="content__sub mt-3">
        <div class="content__search">
            <form>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Ngày đến</label>
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
                        <label for="validationCustom02">Trích yếu</label>
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
                    
                    <form style="position:relative">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Ngày đến</label>
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
                                <label for="validationCustom02">Trích yếu</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            expand: false,
            classexpand:'',

            show:false,
            classadd:'',
        }
    },
    methods:{
        showAdd(){
            if(this.show == false){
                this.show = true;
                setTimeout(()=>{this.classadd='active'},200);
            }else{
                this.classadd = '';
                setTimeout(()=>{this.show = false},500);
            }
        },
        showExpand(){
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


</style>