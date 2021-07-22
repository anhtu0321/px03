<template>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Cấp bậc</th>
                <th>Chức vụ</th>
                <th>Thứ tự</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                <td>{{index + 1}}</td>
                <td>{{list.ho_ten}}</td>
                <td>{{list.cap_bac}}</td>
                <td>{{list.chuc_vu}}</td>
                <td>{{list.thu_tu}}</td>
                <td>{{list.trang_thai == 1? "Sử dụng" : "Không sử dụng"}}</td>
                <td>
                    <router-link class="btn btn-primary btn-sm" :to="`/lanhdao/edit/${list.id}`" @click.native="loadDataById()">Sửa</router-link>
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteData(list.id)">Xóa</button>
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
            return this.$store.getters.getListLanhDao;
        },
    },
    methods:{
        loadDataById(){
            this.idEdit = this.$route.params.id;
            axios.get(`/px03/public/api/editLanhDao/${this.$route.params.id}`)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/api/deleteLanhDao/${id}`)
                .then(reponse=>{
                    this.$store.dispatch('acListLanhDao',this.currentPage);
                    if(this.$router.history.current.path !=='/lanhdao'){
                        this.$router.push('/lanhdao');
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

.trang{
    margin:0 auto;
    padding:0;
}
.tractive, .tractive:hover{
    background:rgb(171, 204, 178);
}
</style>