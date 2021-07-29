<template>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên chức năng</th>
                <th>Tên đầy đủ</th>
                <th>Key Code</th>
                <th>Chức năng cha</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(list, index) in listData.data" :key="list.id" :class="list.id == idEdit? 'tractive':''">
                <td>{{index + 1}}</td>
                <td>{{list.name}}</td>
                <td>{{list.display_name}}</td>
                <td>{{list.key_code}}</td>
                <td v-if="list.chucnangcha != null">{{list.chucnangcha.name}}</td>
                <td v-else></td>
                <td>
                    <router-link class="btn btn-primary btn-sm" :to="`/chucnang/edit/${list.id}`" @click.native="loadDataById()">Sửa</router-link>
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
            return this.$store.getters.getListChucNang;
        },
    },
    methods:{
        loadDataById(){
            this.idEdit = this.$route.params.id;
            axios.get(`/px03/public/editChucNang/${this.$route.params.id}`)
            .then(response=>{
                this.$emit('dataById', response);
            })
        },
        deleteData(id){
            if(confirm('ban muon xoa that a ?') == true){
                axios.get(`/px03/public/deleteChucNang/${id}`)
                .then(reponse=>{
                    this.$store.dispatch('acListChucNang',this.currentPage);
                    if(this.$router.history.current.path !=='/chucnang'){
                        this.$router.push('/chucnang');
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