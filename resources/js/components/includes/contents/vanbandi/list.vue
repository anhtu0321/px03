<template>
<div>
    <div class="content__list mb-3 mt-3 bg-light">
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <th>#</th>
                <th>Cơ quan ban hành</th>
                <th>Loại</th>
                <th>Số</th>
                <th>Ngày</th>
                <th>Trích yếu</th>
                <th>Độ mật</th>
                <th>Lãnh đạo ký</th>
                <th>File</th>
                <th>Cập nhật</th>
            </thead>
            <tbody>
                <tr v-for="(list, index) in listVanBanDi.data" :key="list.id" :class="list.id == id ? 'tractive':''">
                    <td>{{ index + 1}}</td>
                    <td>{{ list.ten_nguon }}</td>
                    <td>{{ list.ten_loai }}</td>
                    <td>{{ list.so }}</td>
                    <td>{{ xulyNgayThang(list.ngay) }}</td>
                    <td>{{ list.trich_yeu }}</td>
                    <td>{{ getNameDoMat(list.do_mat) }}</td>
                    <td>{{ list.cap_bac }} {{ list.ho_ten }}</td>
                    <td v-if="['doc', 'docx', 'xls', 'xlsx'].includes(list.duoi_file)">
                        <a :href="`/px03/public/vanbandinupload/${ list.file }`">
                            <img width="25px" src="/px03/public/images/word-icon.png">
                        </a>
                    </td>
                    <td v-else-if="['pdf'].includes(list.duoi_file)">
                        <a :href="`/px03/public/vanbandinupload/${ list.file }`">
                            <img width="25px" src="/px03/public/images/pdf-icon.png">
                        </a>
                    </td>
                    <td v-else-if="['jpg', 'jpeg', 'png'].includes(list.duoi_file)">
                        <a :href="`/px03/public/vanbandinupload/${ list.file }`">
                            <img width="25px" src="/px03/public/images/img-icon.png">
                        </a>
                    </td>
                    <td v-else-if="(list.file == '') || (list.file == null) "></td>
                    <td v-else>
                        <a :href="`/px03/public/vanbandinupload/${ list.file }`">
                            <img width="25px" src="/px03/public/images/blank-file-icon.png">
                        </a>
                    </td>

                    <td>
                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#xemvanbandi" @click="viewVanBanDiById(list.id)" v-if="ktquyen('vanbandi_xem')"><i class="fas fa-binoculars"></i></a>
                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#suavanbandi" @click="getVanBanDiById(list.id)" v-if="ktquyen('vanbandi_sua')"><i class="far fa-edit"></i></a>
                        <button class="btn btn-warning btn-sm" @click="deleteData(list.id)" v-if="ktquyen('vanbandi_xoa')"><i class="far fa-trash-alt"></i></button>
                    </td>

                </tr>
            </tbody>
        </table>
        
    </div>
    <page :last_pages="listVanBanDi.last_page" @getPage="setPage"></page>
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
        listVanBanDi(){
            return this.$store.state.listVanBanDi;
        },
		listPermissionOfUser(){
			return this.$store.getters.getListPermissionOfUser;
        },
        dataRequestSearch(){
            return this.$store.getters.getDataRequestSearch;
        }
    },
    methods: {
        getVanBanDiById(id){
            // await this.$store.dispatch('acListUser');
            this.$emit('dataById', id);
        },
        async viewVanBanDiById(id){
            await axios.get('/px03/public/viewvanbandi/'+id)
            .then(response=>{
                this.$emit('viewDataById', response);
            })
        },
       
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/deletevanbandi/${id}`)
                .then(async reponse=>{
                    await this.$store.dispatch('acSearchDi', {data:this.dataRequestSearch, page:this.page});
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
        getNameDoMat(domat){
            switch (domat) {
                case 1:
                    return "C";
                    break;
                case 2:
                    return "B";
                    break;
                case 3:
                    return "A";
                    break;
                default:
                    return "-";
                    break;
            }
        },
        loadData(){
            this.$store.dispatch('acSearchDi', {data:this.dataRequestSearch, page:page});
        },
        xulyNgayThang(date){
            var d = new Date(date);
            return d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear();
        }
        
    },
    components:{
        page,
    },
    created(){
        this.loadData();
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