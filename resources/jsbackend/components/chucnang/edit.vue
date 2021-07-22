<template>
	<div>
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-10 main">
						<form method="post" @submit.prevent="edit">
							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Tên chức năng</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.name)}" 
										v-model="name">
									<p class="thongbao" v-if="error && error.name">{{ error.name[0]}}</p>
								</div>
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Tên Đầy đủ</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.display_name)}" 
										v-model="display_name">
									<p class="thongbao" v-if="error && error.display_name">{{ error.display_name[0]}}</p>
								</div>
								<div class="form-group col-md-2">
									<label class="col-form-label col-form-label-sm">Key Code</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.key_code)}" 
										v-model="key_code">
									<p class="thongbao" v-if="error && error.key_code">{{ error.key_code[0]}}</p>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-5">
									<label class="col-form-label col-form-label-sm">Chức năng cha</label>
									<select class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.parent_id)}" 
										v-model="parent_id">
										<option value="0">Chọn chức năng cha</option>
										<option v-for="listCha in chuc_nang_cha" :key="listCha.id" :value="listCha.id">{{listCha.name}}</option>
									</select>
									<p class="thongbao" v-if="error && error.parent_id">{{ error.parent_id[0]}}</p>
								</div>
								
							</div>
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-success btn-sm">Sửa loại văn bản</button>
								<router-link to="/chucnang" class="btn btn-warning btn-sm">Quay lại</router-link>
							</div>
					</form>
					</div>
				</div>
			</div>
  		</section>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10 list">
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
			tieude:'SỬA CHỨC NĂNG',
			link:'Sửa',
			name:'',
			display_name:'',
			key_code:'',
			parent_id:'',
			error:'',
			chuc_nang_cha:'',
		}
	},
	computed:{
		currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){
            return this.$store.getters.getListChucNang;
        }
	},
	methods:{
		edit(){
			let data = new FormData;
			data.append('name', this.name);
			data.append('display_name', this.display_name);
			data.append('key_code', this.key_code);
			data.append('parent_id', this.parent_id);
			axios.post(`/px03/public/api/updateChucNang/${this.$route.params.id}`, data)
			.then(response=>{
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListChucNang',this.currentPage);
		},
		listChucNangCha(){
			axios.get('/px03/public/api/listChucNangCha')
			.then(response=>{
				this.chuc_nang_cha = response.data;
			})
		},
		updateById(data){
			this.name = data.data[0].name;
			this.display_name = data.data[0].display_name;
			this.key_code = data.data[0].key_code;
			this.parent_id = data.data[0].parent_id;
		},
		loadData(){
			this.list();
		}
	},
	components:{contentHeader, list, paginate},
	mounted(){
		// this.list();
		axios.get(`/px03/public/api/editChucNang/${this.$route.params.id}`)
        .then(response=>{
            this.name = response.data[0].name;
			this.display_name = response.data[0].display_name;
			this.key_code = response.data[0].key_code;
			this.parent_id = response.data[0].parent_id;
		});
		this.listChucNangCha();
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
.list{
    margin:0 auto;
    margin-top:30px;
    padding:0;
}
</style>