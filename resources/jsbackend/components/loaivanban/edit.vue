<template>
	<div>
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<form method="post" class="form-row" @submit.prevent="edit">
						<div class="form-group col-md-6">
							<label class="col-form-label col-form-label-sm">Tên Loại</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.ten_loai)}" 
								v-model="ten_loai">
							<p class="thongbao" v-if="error && error.ten_loai">{{ error.ten_loai[0]}}</p>
						</div>
						<div class="form-group col-md-3">
							<label class="col-form-label col-form-label-sm">Thứ tự</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.thu_tu)}" 
								v-model="thu_tu">
							<p class="thongbao" v-if="error && error.thu_tu">{{ error.thu_tu[0]}}</p>
						</div>
						<div class="form-group col-md-3">
							<label class="col-form-label col-form-label-sm">Trạng thái</label>
							<select class="form-control form-control-sm" v-model="trang_thai">
								<option value="1">Sử dụng</option>
								<option value="0">Không Sử dụng</option>
							</select>
						</div>
						<div class="form-group col-md-12 text-right">
							<button type="submit" class="btn btn-primary btn-sm">Sửa loại văn bản</button>
						</div>
					</form>
					</div>
				</div>
			</div>
  		</section>
		<list :listData="listData"></list>
	</div>
	
</template>

<script>
// import các components
import contentHeader from '../content_header.vue'
import list from './list.vue'
export default {
	data(){
		return{
			tieude:'SỬA LOẠI VĂN BẢN',
			link:'Sửa',
			ten_loai:'',
			thu_tu:'',
			trang_thai: 1,
			error:'',
			listData:''
		}
	},
	methods:{
		edit(){
			let data = new FormData;
			data.append('ten_loai', this.ten_loai);
			data.append('thu_tu', this.thu_tu);
			data.append('trang_thai', this.trang_thai);
			axios.post('/px03/public/api/addLoaiVanBan', data)
			.then(response=>{
				this.ten_loai = '';
				this.thu_tu = '';
				this.error = '';
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			axios.get('/px03/public/api/listLoaiVanBan')
			.then(response=>{
				this.listData = response.data;
			})
			.catch();
		},
		loadDataLoaiVanBan(){
			let listLoaiVanBan = this.$store.getters.getListLoaiVanBan;
			this.ten_loai = listLoaiVanBan.ten_loai;
			this.thu_tu = listLoaiVanBan.thu_tu;
			this.trang_thai = listLoaiVanBan.trang_thai;
			console.log(listLoaiVanBan);
		}
	},
	components:{contentHeader, list},
	mounted(){
		this.list();
		this.loadDataLoaiVanBan();
	},
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