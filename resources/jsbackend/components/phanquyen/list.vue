<template>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên quyền</th>
                <th>Tên đầy đủ</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                <td>{{index + 1}}</td>
                <td>{{list.name}}</td>
                <td>{{list.display_name}}</td>
                <td>
                    <router-link class="btn btn-primary btn-sm" :to="`/phanquyen/edit/${list.id}`" @click.native="loadDataById()" v-if="ktquyen('phanquyen_sua')">Sửa</router-link>
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteData(list.id)" v-if="ktquyen('phanquyen_xoa')">Xóa</button>
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
            return this.$store.getters.getListPhanQuyen;
        },
		listPermissionOfUser(){
			return this.$store.getters.getlistPermissionOfUser;
        }
    },
    methods:{
        loadDataById(){
            this.idEdit = this.$route.params.id;
            axios.get(`/px03/public/editPhanQuyen/${this.$route.params.id}`)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/deletePhanQuyen/${id}`)
                .then(reponse=>{
                    this.$store.dispatch('acListPhanQuyen',this.currentPage);
                    if(this.$router.history.current.path !=='/phanquyen'){
                        this.$router.push('/phanquyen');
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
.list{
    margin:0 auto;
    margin-top:30px;
    padding:0;
}
.trang{
    margin:0 auto;
    padding:0;
}
.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>