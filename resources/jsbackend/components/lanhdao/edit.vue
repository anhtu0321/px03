<template>
	<div>
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<form method="post" class="form-row" @submit.prevent="edit">
						<div class="form-group col-md-3">
							<label class="col-form-label col-form-label-sm">Họ tên</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.ho_ten)}" 
								v-model="ho_ten">
							<p class="thongbao" v-if="error && error.ho_ten">{{ error.ho_ten[0]}}</p>
						</div>
						<div class="form-group col-md-2">
							<label class="col-form-label col-form-label-sm">Cấp bậc</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.cap_bac)}" 
								v-model="cap_bac">
							<p class="thongbao" v-if="error && error.cap_bac">{{ error.cap_bac[0]}}</p>
						</div>
						<div class="form-group col-md-3">
							<label class="col-form-label col-form-label-sm">Chức vụ</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.chuc_vu)}" 
								v-model="chuc_vu">
							<p class="thongbao" v-if="error && error.chuc_vu">{{ error.chuc_vu[0]}}</p>
						</div>
						<div class="form-group col-md-2">
							<label class="col-form-label col-form-label-sm">Thứ tự</label>
							<input type="text" class="form-control form-control-sm" 
								:class="{'is-invalid' : (error && error.thu_tu)}" 
								v-model="thu_tu">
							<p class="thongbao" v-if="error && error.thu_tu">{{ error.thu_tu[0]}}</p>
						</div>
						<div class="form-group col-md-2">
							<label class="col-form-label col-form-label-sm">Trạng thái</label>
							<select class="form-control form-control-sm" v-model="trang_thai">
								<option value="1">Sử dụng</option>
								<option value="0">Không Sử dụng</option>
							</select>
						</div>
						<div class="form-group col-md-12 text-right">
							<button type="submit" class="btn btn-success btn-sm">Sửa loại văn bản</button>
							<router-link to="/lanhdao" class="btn btn-warning btn-sm">Quay lại</router-link>
						</div>
					</form>
					</div>
				</div>
			</div>
  		</section>
		<div class="container-fluid">
        	<div class="row">
            	<div class="col-md-8 list">
					<list @dataById="updateById"></list>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-10 trang justify-content-end">
                <paginate :last_pages="listData.last_page" @loadData="loadData"></paginate>
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
			tieude:'SỬA LÃNH ĐẠO',
			link:'Sửa',
			ho_ten:'',
			cap_bac:'',
			chuc_vu:'',
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
            return this.$store.getters.getListLanhDao;
        }
	},
	methods:{
		edit(){
			let data = new FormData;
			data.append('ho_ten', this.ho_ten);
			data.append('cap_bac', this.cap_bac);
			data.append('chuc_vu', this.chuc_vu);
			data.append('thu_tu', this.thu_tu);
			data.append('trang_thai', this.trang_thai);
			axios.post(`/px03/public/api/updateLanhDao/${this.$route.params.id}`, data)
			.then(response=>{
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListLanhDao',this.currentPage);
		},
		updateById(data){
			this.ho_ten = data.data[0].ho_ten;
			this.cap_bac = data.data[0].cap_bac;
			this.chuc_vu = data.data[0].chuc_vu;
			this.thu_tu = data.data[0].thu_tu;
			this.trang_thai = data.data[0].trang_thai;
		},
		loadData(){
			this.list();
		}
	},
	components:{contentHeader, list, paginate},
	mounted(){
		// this.list();
		axios.get(`/px03/public/api/editLanhDao/${this.$route.params.id}`)
        .then(response=>{
            this.ho_ten = response.data[0].ho_ten;
            this.cap_bac = response.data[0].cap_bac;
            this.chuc_vu = response.data[0].chuc_vu;
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