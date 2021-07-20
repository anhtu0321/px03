<template>
	<div>
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<form method="post" class="form-row" @submit.prevent="add">
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
							<button type="submit" class="btn btn-primary btn-sm">Thêm nguồn</button>
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
                <paginate :last_pages="listData.last_page" @loadData="loadDataNguonDi"></paginate>
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
			tieude:'THÊM NGUỒN VĂN BẢN ĐI',
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
            return this.$store.getters.getListNguonDi;
        }
    },
	methods:{
		add(){
			let data = new FormData;
			data.append('ten_nguon', this.ten_nguon);
			data.append('thu_tu', this.thu_tu);
			axios.post('/px03/public/api/addNguonDi', data)
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
			this.$store.dispatch('acListNguonDi',this.currentPage);
		},
		loadDataNguonDi(){
			this.list();
		},
		reloadData(){
			this.$store.dispatch('acGetPage',1);
			this.list();
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