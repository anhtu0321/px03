<template>
    <div class="content__sub mt-3">
        <div class="content__search">
            <form>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">Ngày đến</label>
                        <div class="row">
                            <div class="col-md-6" style="display:flex; flex-direction:row">
                                <span>Từ </span><input type="date" class="form-control" >
                            </div>
                            <div class="col-md-6">
                                Đến <input type="date" class="form-control"  >
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto">
                        
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend">
                            
                        </div>
                    </div>
                </div>
                <div class="form-row" v-if="expand">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">City</label>
                        <input type="text" class="form-control" id="validationCustom03" placeholder="City">
                        
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom04">State</label>
                        <input type="text" class="form-control" id="validationCustom04" placeholder="State">
                        
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom05">Zip</label>
                        <input type="text" class="form-control" id="validationCustom05" placeholder="Zip">
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                    </div>
                    <div class="col-md-6 mb-3 text-right">
                        <button class="btn btn-default" @click.prevent="expand = !expand">
                            <div v-if="expand">
                                Tìm nhanh <i class="fas fa-caret-up"></i>
                            </div>
                            <div v-else>
                                Tìm kiếm nâng cao <i class="fas fa-caret-down"></i>
                            </div>
                        </button>
                    </div>
                </div>
                
            </form>

        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            expand:false
        }
    },
    methods:{

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
.form-row{
    transition: display 2s;
}
</style>