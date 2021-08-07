<template>
	<div v-if="ktquyen('nguondi_xem')">
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<form method="post" class="form-row" @submit.prevent="edit">
						<div class="form-group col-md-8">
							<label class="col-form-label col-form-label-sm">Tên Nguồn đi</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.ten_nguon)}" 
								v-model="ten_nguon">
							<p class="thongbao" v-if="error && error.ten_nguon">{{ error.ten_nguon[0]}}</p>
						</div>
						<div class="form-group col-md-4">
							<label class="col-form-label col-form-label-sm">Thứ tự</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.thu_tu)}" 
								v-model="thu_tu">
							<p class="thongbao" v-if="error && error.thu_tu">{{ error.thu_tu[0]}}</p>
						</div>
						<div class="form-group col-md-12 text-right">
							<button type="submit" class="btn btn-primary btn-sm" v-if="ktquyen('nguondi_them')">Sửa nguồn</button>
                            <router-link to="/nguondi" class="btn btn-warning btn-sm">Quay lại</router-link>
						</div>
					</form>
					</div>
				</div>
			</div>
  		</section>
		<list @dataById="updateNguonDiById" :currentPage="currentPage"></list>
		<div class="row">
            <div class="col-md-8 trang justify-content-end">
                <paginate :last_pages="listData.last_page" @loadData="loadDataNguonDi"></paginate>
            </div>
        </div>
	</div>
	<div v-else>
		<div class="container-fluid">
			<div class="row">
				<div class="mt-2 mr-2 alert" style="font-size:2rem; color:red">
					Bạn không có quyền xem mục này !
				</div>
			</div>
		</div>
	</div>
	
</template>

<script>
// import các components
import contentHeader from '../content_header.vue'
import list from './list.vue'
import paginate from '../page.vue'
export default {
	data(){
		return{
			tieude:'SỬA NGUỒN VĂN BẢN ĐI',
			link:'Sửa',
			ten_nguon:'',
			thu_tu:'',
			error:'',
		}
	},
	computed:{
		currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){
            return this.$store.getters.getListNguonDi;
        },
		listPermissionOfUser(){
			return this.$store.getters.getlistPermissionOfUser;
        }
    },
	methods:{
		edit(){
			let data = new FormData;
			data.append('ten_nguon', this.ten_nguon);
			data.append('thu_tu', this.thu_tu);
			axios.post(`/px03/public/updateNguonDi/${this.$route.params.id}`, data)
			.then(response=>{
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListNguonDi',this.currentPage);
        },
        updateNguonDiById(data){
			this.ten_nguon = data.data[0].ten_nguon;
			this.thu_tu = data.data[0].thu_tu;
		},
		loadDataNguonDi(){
			this.list();
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
	components:{contentHeader, list, paginate},
	mounted(){
        axios.get(`/px03/public/editNguonDi/${this.$route.params.id}`)
        .then(response=>{
            this.ten_nguon = response.data[0].ten_nguon;
			this.thu_tu = response.data[0].thu_tu;
         })
	}
}
</script>

<style>
.main{
	margin:0 auto;
	box-shadow: -5px -5px 10px #ffffffe3, 5px 5px 8px rgba(94, 104, 121, 0.288);
	border-radius: 10px;
	padding:15px;
}
.thongbao{
	color:crimson;
	font-size:0.8rem;
	margin:0;
}

</style>