<template>
	<div v-if="ktquyen('donvi_xem')">
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-10 main">
						<!-- form -->
						<form method="post" @submit.prevent="add">

							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Tên đơn vị</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.ten_phong)}" 
										v-model="ten_phong">
									<p class="thongbao" v-if="error && error.ten_phong">{{ error.ten_phong[0]}}</p>
								</div>
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Tên Đầy đủ</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.ten_phong_full)}" 
										v-model="ten_phong_full">
									<p class="thongbao" v-if="error && error.ten_phong_full">{{ error.ten_phong_full[0]}}</p>
								</div>
								<div class="form-group col-md-2">
									<label class="col-form-label col-form-label-sm">Ký hiệu</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.ky_hieu)}" 
										v-model="ky_hieu">
									<p class="thongbao" v-if="error && error.ky_hieu">{{ error.ky_hieu[0]}}</p>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Khối</label>
									<select class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.khoi)}" 
										v-model="khoi">
										<option value="1">Ban Giám đốc</option>
										<option value="2">Khối Xây dựng lực lượng</option>
										<option value="3">Khối An ninh</option>
										<option value="4">Khối Cảnh sát</option>
										<option value="5">Khối huyện, thành phố</option>
									</select>
									<p class="thongbao" v-if="error && error.khoi">{{ error.khoi[0]}}</p>
								</div>
								<div class="form-group col-md-2">
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
							</div>
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm" v-if="ktquyen('donvi_them')">Thêm đơn vị</button>
								<button type="submit" class="btn btn-warning btn-sm" @click.prevent="reloadData">Tải lại dữ liệu</button>
							</div>

					</form>
					<!-- end form -->
					</div>
				</div>
			</div>
  		</section>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 list">
					<list></list>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-10 trang justify-content-end">
                <paginate :last_pages="listData.last_page" @loadData="loadData"></paginate>
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
			tieude:'THÊM ĐƠN VỊ',
			link:'Thêm',
			ten_phong:'',
			ten_phong_full:'',
			ky_hieu:'',
			khoi:'',
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
            return this.$store.getters.getListDonVi;
        },
		listPermissionOfUser(){
			return this.$store.getters.getlistPermissionOfUser;
        }
    },
	methods:{
		add(){
			let data = new FormData;
			data.append('ten_phong', this.ten_phong);
			data.append('ten_phong_full', this.ten_phong_full);
			data.append('ky_hieu', this.ky_hieu);
			data.append('khoi', this.khoi);
			data.append('thu_tu', this.thu_tu);
			data.append('trang_thai', this.trang_thai);
			axios.post('/px03/public/addDonVi', data)
			.then(response=>{
				this.ten_phong = '';
				this.ten_phong_full = '';
				this.ky_hieu = '';
				this.thu_tu = '';
				this.error = '';
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListDonVi',this.currentPage);
		},
		loadData(){
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
.list{
    margin:0 auto;
    margin-top:30px;
    padding:0;
}
</style>