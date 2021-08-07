<template>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên đơn vị</th>
                <th>Tên đầy đủ</th>
                <th>Ký hiệu</th>
                <!-- <th>Khối</th> -->
                <th>Thứ tự</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                <td>{{index + 1}}</td>
                <td>{{list.ten_phong}}</td>
                <td>{{list.ten_phong_full}}</td>
                <td>{{list.ky_hieu}}</td>
                <!-- <td>{{list.khoi}}</td> -->
                <td>{{list.thu_tu}}</td>
                <td>{{list.trang_thai == 1? "Sử dụng" : "Không sử dụng"}}</td>
                <td>
                    <router-link class="btn btn-primary btn-sm" :to="`/donvi/edit/${list.id}`" @click.native="loadDataById()" v-if="ktquyen('donvi_sua')">Sửa</router-link>
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteData(list.id)" v-if="ktquyen('donvi_xoa')">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
export default {
    data(){
        return{
            idEdit:'',
        }
    },
    computed:{
        currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){
            return this.$store.getters.getListDonVi;
        },
		listPermissionOfUser(){
			return this.$store.getters.getlistPermissionOfUser;
        }
    },
    methods:{
        loadDataById(){
            this.idEdit = this.$route.params.id;
            axios.get(`/px03/public/editDonVi/${this.$route.params.id}`)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/deleteDonVi/${id}`)
                .then(reponse=>{
                    this.$store.dispatch('acListDonVi',this.currentPage);
                    if(this.$router.history.current.path !=='/DonVi'){
                        this.$router.push('/DonVi');
                    }
                })
            }
        },
        ktquyen(key_code){
			for(var i in this.listPermissionOfUser){
				if(this.listPermissionOfUser[i].key_code == key_code){
					return true;
				}
			}
			return false;
		}
    },
    mounted(){
        this.idEdit = this.$route.params.id;
    }
}
</script>

<style>

.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>