<template>
	<div>
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<!-- form -->
						<form method="post" @submit.prevent="add">

							<div class="form-row">
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Tên hiển thị</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.fullname)}" 
										v-model="fullname">
									<p class="thongbao" v-if="error && error.fullname">{{ error.fullname[0]}}</p>
								</div>
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Tài khoản</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.username)}" 
										v-model="username">
									<p class="thongbao" v-if="error && error.username">{{ error.username[0]}}</p>
								</div>
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Mật khẩu</label>
									<input type="password" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.password)}" 
										v-model="password">
									<p class="thongbao" v-if="error && error.password">{{ error.password[0]}}</p>
								</div>
							</div>
							
							<div class="form-row">
								<div class="form-group col-md-4">
									<label class="col-form-label col-form-label-sm">Phân quyền</label>
									<v-select multiple v-model="roles" :options="listRoles.data" :reduce="role => role.id" label="name" />
								</div>
							</div>

							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm">Thêm tài khoản</button>
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
				<div class="col-md-8 list">
					<list></list>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-8 trang justify-content-end">
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
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
export default {
	data(){
		return{
			tieude:'THÊM TÀI KHOẢN',
			link:'Thêm',
			fullname:'',
			username:'',
			password:'',
			error:'',
			roles:[],
		}
	},
	computed:{
		currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){
            return this.$store.getters.getListTaiKhoan;
		},
		listRoles(){
            return this.$store.getters.getListPhanQuyen;
        }
    },
	methods:{
		add(){
			let data = new FormData;
			data.append('fullname', this.fullname);
			data.append('username', this.username);
			data.append('password', this.password);
			for(var i in this.roles){
				data.append('roles[]', this.roles[i]);
			}
			axios.post('/px03/public/addTaiKhoan', data)
			.then(response=>{
				this.fullname = '';
				this.username = '';
				this.password = '';
				this.roles ='',
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){
			this.$store.dispatch('acListTaiKhoan',this.currentPage);
			
		},

		loadData(){
			this.list();
		},
		reloadData(){
			this.$store.dispatch('acGetPage',1);
			this.list();
		}
	},
	components:{contentHeader, list, paginate, vSelect},
	mounted(){
		this.list();
		this.$store.dispatch('acListPhanQuyen',1);
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
.select2-selection__choice__display{
	background: rgb(43, 92, 95);
	padding:3px;
	margin-left:5px;
}
</style>