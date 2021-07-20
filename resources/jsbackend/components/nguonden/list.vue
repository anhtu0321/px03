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
                                <router-link class="btn btn-primary btn-sm" :to="`/nguonden/edit/${list.id}`" @click.native="loadListNguonDen()">Sửa</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteNguonDen(list.id)">Xóa</button>
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
            return this.$store.getters.getListNguonDen;
        }
    },
    methods:{
        loadListNguonDen(){
            this.idEdit = this.$route.params.id;
            axios.get(`/px03/public/api/editNguonDen/${this.$route.params.id}`)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        deleteNguonDen(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/api/deleteNguonDen/${id}`)
                .then(reponse=>{
                    this.$store.dispatch('acListNguonDen',this.currentPage);
                    if(this.$router.history.current.path !=='/nguonden'){
                        this.$router.push('/nguonden');  
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