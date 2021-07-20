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
							<button type="submit" class="btn btn-success btn-sm">Sửa loại văn bản</button>
							<router-link to="/loaivanban" class="btn btn-warning btn-sm">Quay lại</router-link>
						</div>
					</form>
					</div>
				</div>
			</div>
  		</section>
		<list @dataById="updateLoaiById"></list>
		<div class="row">
            <div class="col-md-8 trang justify-content-end">
                <paginate :last_pages="listData.last_page" @loadData="loadDataLoai"></paginate>
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
			tieude:'SỬA LOẠI VĂN BẢN',
			link:'Sửa',
			ten_loai:'',
			thu_tu:'',
			trang_thai: 1,
			error:'',
		}
	},
	computed:{
		currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){
            return this.$store.getters.getListLoai;
        }
	},
	methods:{
		edit(){
			let data = new FormData;
			data.append('ten_loai', this.ten_loai);
			data.append('thu_tu', this.thu_tu);
			data.append('trang_thai', this.trang_thai);
			axios.post(`/px03/public/api/updateLoaiVanBan/${this.$route.params.id}`, data)
			.then(response=>{
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListLoai',this.currentPage);
		},
		updateLoaiById(data){
			this.ten_loai = data.data[0].ten_loai;
			this.thu_tu = data.data[0].thu_tu;
			this.trang_thai = data.data[0].trang_thai;
		},
		loadDataLoai(){
			this.list();
		}
	},
	components:{contentHeader, list, paginate},
	mounted(){
		// this.list();
		axios.get(`/px03/public/api/editLoaiVanBan/${this.$route.params.id}`)
        .then(response=>{
            this.ten_loai = response.data[0].ten_loai;
			this.thu_tu = response.data[0].thu_tu;
			this.trang_thai = response.data[0].trang_thai;
		});
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