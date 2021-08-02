<template>
	<div v-if="ktquyen('nguonden_xem')">
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<form method="post" class="form-row" @submit.prevent="add">
						<div class="form-group col-md-8">
							<label class="col-form-label col-form-label-sm">Tên Nguồn đến</label>
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
							<button type="submit" class="btn btn-primary btn-sm" v-if="ktquyen('nguonden_them')">Thêm nguồn</button>
							<button type="submit" class="btn btn-warning btn-sm" @click.prevent="reloadData">Tải lại dữ liệu</button>
						</div>
					</form>
					</div>
				</div>
			</div>
  		</section>
		<list></list>
		<div class="row">
            <div class="col-md-8 trang justify-content-end">
                <paginate :last_pages="listData.last_page" @loadData="loadDataNguonDen"></paginate>
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
			tieude:'THÊM NGUỒN VĂN BẢN ĐẾN',
			link:'Thêm',
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
            return this.$store.getters.getListNguonDen;
        },
		listPermissionOfUser(){
			return this.$store.getters.getlistPermissionOfUser;
        }
    },
	methods:{
		add(){
			let data = new FormData;
			data.append('ten_nguon', this.ten_nguon);
			data.append('thu_tu', this.thu_tu);
			axios.post('/px03/public/addNguonDen', data)
			.then(response=>{
				this.ten_nguon = '';
				this.thu_tu = '';
				this.error = '';
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListNguonDen',this.currentPage);
		},
		loadDataNguonDen(){
			this.list();
		},
		reloadData(){
			this.$store.dispatch('acGetPage',1);
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
		this.list();
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