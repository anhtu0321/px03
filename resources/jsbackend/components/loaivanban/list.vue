<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 list">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên loại</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, index) in listData.data" :key="list.id">
                            <td>{{index + 1}}</td>
                            <td>{{list.ten_loai}}</td>
                            <td>{{list.thu_tu}}</td>
                            <td>{{list.trang_thai == 1? "Sử dụng" : "Không sử dụng"}}</td>
                            <td>
                                <router-link class="btn btn-primary btn-sm" @click.native="loadLoaiVanBan()" :to="`/loaivanban/edit/${list.id}`" >Sửa</router-link>
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['listData'],
    methods:{
        loadLoaiVanBan(){
            alert("den day");
            // this.$store.dispatch('getListLoaiVanBanAc',id);
        }
    }
}
</script>

<style>
.list{
    margin:0 auto;
    margin-top:30px;
    padding:0;
}
</style>