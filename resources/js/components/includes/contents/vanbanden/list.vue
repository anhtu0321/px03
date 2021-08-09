<template>
    <table class="table table-bordered">
        <thead>
            <th>#</th>
            <th>Cơ quan ban hành</th>
            <th>Loại</th>
            <th>Số</th>
            <th>Ngày</th>
            <th>Trích yếu</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th>File</th>
            <th>Cập nhật</th>
        </thead>
        <tbody>
            <tr v-for="(list, index) in listVanBanDen.data" :key="list.id">
                <td>{{ index +1}}</td>
                <td>{{ list.id_nguon_den }}</td>
                <td>{{ list.id_loai }}</td>
                <td>{{ list.so }}</td>
                <td>{{ list.ngay }}</td>
                <td>{{ list.trich_yeu }}</td>
                <td>{{ list.ghi_chu }}</td>
                <td>{{ list.trang_thai }}</td>
                <td v-if="list.file != ''">{{ list.file }}</td>
                <td v-else></td>
                <td>Chi tiet, sua, xoa</td>
                
                
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data(){
        return{
        }
    },
    computed:{
        listVanBanDen(){
            return this.$store.getters.getListVanBanDen;
        },
        
    },
    filters: {
    
        subStr(string) {
            return string.substring(string.lastIndexOf('.'), string.length);
            }
    
    },
    mounted(){
        this.$store.dispatch('acListVanBanDen', 1);
    }
}
</script>

<style>

</style>