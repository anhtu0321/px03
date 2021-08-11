<template>
    <table class="table table-bordered table-sm">
        <thead class="thead-light">
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
            <tr v-for="(list, index) in listVanBanDen.data" :key="list.id" :class="list.id == id ? 'tractive':''">
                <td>{{ index + 1}}</td>
                <td>{{ list.ten_nguon }}</td>
                <td>{{ list.ten_loai }}</td>
                <td>{{ list.so }}</td>
                <td>{{ list.ngay }}</td>
                <td>{{ list.trich_yeu }}</td>
                <td>{{ list.ghi_chu }}</td>
                <td>{{ list.trang_thai }}</td>
                <td v-if="['doc', 'docx', 'xls', 'xlsx'].includes(list.duoi_file)">
                    <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                        <img width="25px" src="/px03/public/images/word-icon.png">
                    </a>
                </td>
                <td v-else-if="['pdf'].includes(list.duoi_file)">
                    <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                        <img width="25px" src="/px03/public/images/pdf-icon.png">
                    </a>
                </td>
                <td v-else-if="['jpg', 'jpeg', 'png'].includes(list.duoi_file)">
                    <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                        <img width="25px" src="/px03/public/images/img-icon.png">
                    </a>
                </td>
                <td v-else-if="(list.file == '') || (list.file == null) "></td>
                <td v-else>
                    <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                        <img width="25px" src="/px03/public/images/blank-file-icon.png">
                    </a>
                </td>

                <td>
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#xemvanbanden" @click="viewVanBanDenById(list.id)"><i class="fas fa-binoculars"></i></a>
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#suavanbanden" @click="getVanBanDenById(list.id)"><i class="far fa-edit"></i></a>
                    <button class="btn btn-warning btn-sm"><i class="far fa-trash-alt"></i></button>
                </td>

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
    props:['id'],
    computed:{
        listVanBanDen(){
            return this.$store.getters.getListVanBanDen;
        },
    },
    methods: {
        async getVanBanDenById(id){
            await this.$store.dispatch('acListUser');
            await this.$store.dispatch('acListNguonDen');
            await this.$store.dispatch('acListLoai');
            await axios.get('/px03/public/editvanbanden/'+id)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        async viewVanBanDenById(id){
            await axios.get('/px03/public/viewvanbanden/'+id)
            .then(response=>{
                this.$emit('viewDataById', response);
            })
        }
    },
    mounted(){
        this.$store.dispatch('acListVanBanDen', 1);
    }
}
</script>

<style>
.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>