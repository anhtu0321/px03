<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 list">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên nguồn</th>
                            <th>Thứ tự</th>
                            <th>Cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                            <td>{{index + 1}}</td>
                            <td>{{list.ten_nguon}}</td>
                            <td>{{list.thu_tu}}</td>
                            <td>
                                <router-link class="btn btn-primary btn-sm" :to="`/nguondi/edit/${list.id}`" @click.native="loadListNguonDi()">Sửa</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteNguonDi(list.id)">Xóa</button>
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
            return this.$store.getters.getListNguonDi;
        }
    },
    methods:{
        loadListNguonDi(){
            this.idEdit = this.$route.params.id;
            axios.get(`/px03/public/api/editNguonDi/${this.$route.params.id}`)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        deleteNguonDi(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/api/deleteNguonDi/${id}`)
                .then(reponse=>{
                    this.$store.dispatch('acListNguonDi',this.currentPage);
                    if(this.$router.history.current.path !=='/nguondi'){
                        this.$router.push('/nguondi');  
                    }
                })
            }
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