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
								<div class="form-group col-md-6">
									<label class="col-form-label col-form-label-sm">Tên quyền</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.name)}" 
										v-model="name">
									<p class="thongbao" v-if="error && error.name">{{ error.name[0]}}</p>
								</div>
								<div class="form-group col-md-6">
									<label class="col-form-label col-form-label-sm">Tên Đầy đủ</label>
									<input type="text" class="form-control form-control-sm" 
										:class="{'is-invalid' : (error && error.display_name)}" 
										v-model="display_name">
									<p class="thongbao" v-if="error && error.display_name">{{ error.display_name[0]}}</p>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12 mb-4">
									<input type="checkbox" class="hovered check-all" id="checkall" v-model="check_all" @change="checkAll">
									<label for="checkall" class="p-2 title-card hovered" >Chọn tất cả chức năng</label>
								</div>
								<div class="col-sm-6" v-for="permission in permissions" :key="permission.id">
									<!-- {{ this.per= permission }} -->
									<cardpermission v-bind:per="permission"></cardpermission>	
								</div>
							</div>
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm">Thêm chức năng</button>
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
import cardpermission from './card_permission.vue'
export default {
	data(){
		return{
			tieude:'THÊM PHÂN QUYỀN',
			link:'Thêm',
			name:'',
			display_name:'',
			error:'',
			permissions:'',
			check_all:false,
			
		}
	},
	computed:{
		currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){ //để lấy số trang (last_page)
            return this.$store.getters.getListPhanQuyen;
		},	
    },
	methods:{
		add(){ //thêm dữ liệu vào database
			let data = new FormData;
			data.append('name', this.name);
			data.append('display_name', this.display_name);
			axios.post('/px03/public/api/addPhanQuyen', data)
			.then(response=>{
				this.name = '';
				this.display_name = '';
				this.error = '';
				this.list();
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){ //sử dụng để lấy số trang cho list
			this.$store.dispatch('acListPhanQuyen',this.currentPage);
		},
		
		loadData(){ //khi chọn trang
			this.list();
		},
		reloadData(){ //khi ấn nút tải lại dữ liệu
			this.$store.dispatch('acGetPage',1);
			this.list();
		},
		loadPermission(){ //tải dữ liệu permission
			axios.get('/px03/public/api/listChucNangCha')
			.then(response=>{
				this.permissions = response.data;
			})
		},
		checkAll(){
			var checkConAll = document.getElementsByClassName('check-con');
			for (var i = 0; i < checkConAll.length; i++) {
				checkConAll[i].checked = this.check_all;
			}
		},
		
	},
	components:{contentHeader, list, paginate, cardpermission},
	mounted(){
		this.list();
		this.loadPermission();
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
.hovered:hover{
	cursor: pointer;
}
.title-card{
	font-size: 1.1rem;
	color: rgb(53, 116, 124);
}
</style>