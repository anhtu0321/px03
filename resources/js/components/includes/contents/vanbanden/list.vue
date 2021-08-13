<template>
<div>
    <div class="content__list mb-3 mt-3">
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <th>#</th>
                <th>Cơ quan ban hành</th>
                <th>Loại</th>
                <th>Số</th>
                <th>Ngày</th>
                <th>Trích yếu</th>
                <!-- <th>Độ mật</th> -->
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
                    <!-- <td>{{ getNameDoMat(list.do_mat) }}</td> -->
                    
                    <td>{{ list.ghi_chu }}</td>
                    <td :class="trang_thai_color(xuLyTrangThai(list.trang_thai, list.han_xu_ly))">{{ xuLyTrangThai(list.trang_thai, list.han_xu_ly) }}</td>
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
                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#xemvanbanden" @click="viewVanBanDenById(list.id)" v-if="ktquyen('vanbanden_xem')"><i class="fas fa-binoculars"></i></a>
                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#suavanbanden" @click="getVanBanDenById(list.id)" v-if="ktquyen('vanbanden_sua')"><i class="far fa-edit"></i></a>
                        <button class="btn btn-warning btn-sm" @click="deleteData(list.id)" v-if="ktquyen('vanbanden_xoa')"><i class="far fa-trash-alt"></i></button>
                    </td>

                </tr>
            </tbody>
        </table>
        
    </div>
    <page :last_pages="listVanBanDen.last_page" @getPage="setPage"></page>
</div>  

</template>

<script>
import page from './page.vue';
export default {
    data(){
        return{
            page:1,
        }
    },
    props:['id'],
    computed:{
        listVanBanDen(){
            return this.$store.getters.getListVanBanDen;
        },
		listPermissionOfUser(){
			return this.$store.getters.getListPermissionOfUser;
        },
        dataRequestSearch(){
            return this.$store.getters.getDataRequestSearch;
        }
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
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/deletevanbanden/${id}`)
                .then(async reponse=>{
                    await this.$store.dispatch('acSearch', {data:this.dataRequestSearch, page:this.page});
                })
            }
        },
        setPage(page){
            this.page = page;
            this.$emit('getPage',page);
        },
		ktquyen(key_code){
			for(var i in this.listPermissionOfUser){
				if(this.listPermissionOfUser[i].key_code == key_code){
					return true;
				}
			}
			return false;
        },
        // getNameDoMat(domat){
        //     switch (domat) {
        //         case 1:
        //             return "Mật";
        //             break;
        //         case 2:
        //             return "Tối mật";
        //             break;
        //         case 3:
        //             return "Tuyệt mật";
        //             break;
        //         default:
        //             return "Không mật";
        //             break;
        //     }
        // },
    },
    components:{
        page,
    },
    async created(){
        await this.$store.dispatch('acSearch', {data:this.dataRequestSearch, page:page});
    }
}
</script>

<style>

.content__list{
    width: 100%;
    border:1px solid #ebebeb;
    border-radius:5px;
    padding:10px;
}
.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>