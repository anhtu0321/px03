<template>
	<div v-if="ktquyen('phanquyen_xem')">
		<content-header :tieude="tieude" :link="link"></content-header>
        <section class="content">
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 main">
						<!-- form -->
						<form method="post" @submit.prevent="edit">

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
								<!-- row for permission -->
								<div class="col-md-12 mb-4">
									<input type="checkbox" class="hovered check-all" id="checkall" v-model="check_all" @change="checkAll">
									<label for="checkall" class="p-2 title-card hovered" >Chọn tất cả chức năng</label>
								</div>
								<div class="col-sm-3" v-for="permission in permissions" :key="permission.id">
									<div class="card border-info mb-4">
										<div class="card-header">
											<input type="checkbox" class="hovered check-cha" :id="permission.id" @change="checkModule(permission.id)">
											<label :for="permission.id" class="p-2 title-card hovered">{{permission.name}}</label>
										</div>
										<div class="card-body text-info">
											<div class="row">
												<div class="col-md-6" v-for="percon in permission.chucnangcon" :key="percon.id">
													<input type="checkbox" :value="percon.id" :id="percon.id" class="hovered check-con" v-model="mangchucnang">
													<label :for="percon.id" class="card-text p-2 hovered">{{ percon.name }}</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-12 text-right">
								<button type="submit" class="btn btn-primary btn-sm" v-if="ktquyen('phanquyen_sua')">Sửa phân quyền</button>
								<router-link to="/phanquyen" class="btn btn-warning btn-sm">Quay lại</router-link>
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
					<list @dataById="updateById"></list>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-8 trang justify-content-end">
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
			tieude:'SỬA PHÂN QUYỀN',
			link:'Sửa',
			name:'',
			display_name:'',
			error:'',
			permissions:'',
			check_all:false,
			mangchucnang:[],
		}
	},
	computed:{
		currentPage(){
            return this.$store.getters.getPage;
        },
        listData(){ //để lấy số trang (last_page)
            return this.$store.getters.getListPhanQuyen;
		},	
		perChild(){ // Lấy ra mảng id tất cả các chức năng (permissions)
			var arr = [];
			for( var i in this.permissions){
				for(var j in this.permissions[i].chucnangcon){
					arr.push(this.permissions[i].chucnangcon[j].id);
				}
			}
			return arr;
		},
		listPermissionOfUser(){
			return this.$store.getters.getlistPermissionOfUser;
        }
    },
	methods:{
		edit(){ //sửa dữ liệu database
			let data = new FormData;
			data.append('name', this.name);
			data.append('display_name', this.display_name);
			for(var i in this.mangchucnang){
				data.append('mangchucnang[]', this.mangchucnang[i]);
			}
			axios.post('/px03/public/updatePhanQuyen/'+this.$route.params.id, data)
			.then(response=>{
				this.list();
				this.$store.dispatch('aclistPermissionOfUser');
				alert("Sửa thành công !");
			})
			.catch(error=>{
				this.error = error.response.data.errors;
			});
		},
		list(){ //sử dụng để lấy số trang cho list
			this.$store.dispatch('acListPhanQuyen',this.currentPage);
		},
		updateById(data){// Lấy thông tin dữ liệu đang sửa
			this.name = data.data[0].name;
			this.display_name = data.data[0].display_name;
			this.mangchucnang= data.data[0].permissions.map(function(e){
				return e.id;
			});
		},
		loadData(){ //khi chọn trang
			this.list();
		},
		reloadData(){ //khi ấn nút tải lại dữ liệu
			this.$store.dispatch('acGetPage',1);
			this.list();
		},
		loadPermission(){ //tải dữ liệu permission
			axios.get('/px03/public/listChucNangCha')
			.then(response=>{
				this.permissions = response.data;
			})
		},
		checkAll(){ //Khi click vào nút chọn tất cả chức năng
			this.mangchucnang=[];
			for (var i in this.perChild) {
				if(this.check_all){
					this.mangchucnang.push(this.perChild[i]);
				}
			}
		},
		checkModule(id){ //Khi click vào check box cha trong các module
			var checkCha = document.getElementById(id);
			var checkCon = checkCha.parentNode.parentNode.getElementsByClassName('check-con');
			for (var i = 0; i < checkCon.length; i++) {
				if(checkCha.checked == true && this.mangchucnang.indexOf(parseInt(checkCon[i].value)) == -1){
					this.mangchucnang.push(parseInt(checkCon[i].value));
				}
				if(checkCha.checked == false && this.mangchucnang.indexOf(parseInt(checkCon[i].value)) != -1){
					this.mangchucnang.splice(this.mangchucnang.indexOf(parseInt(checkCon[i].value)),1);
				}
			}
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
		this.list(); //Gọi danh sách dữ liệu đưa vào component list
		this.loadPermission(); //Lấy dữ liệu đổ vào các module chức năng
		axios.get(`/px03/public/editPhanQuyen/${this.$route.params.id}`) //Lấy thông tin dữ liệu sửa khi chuyển từ trang add sang
        .then(response=>{
            this.name = response.data[0].name;
			this.display_name = response.data[0].display_name;
			this.mangchucnang= response.data[0].permissions.map(function(e){
				return e.id;
			});
		});
		this.$store.dispatch('aclistPermissionOfUser');
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