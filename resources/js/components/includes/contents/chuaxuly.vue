<template>
    <div class="content__sub mt-3">
        <div class="content__list mb-3 mt-3">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <th>#</th>
                    <th>Số</th>
                    <th>Ngày</th>
                    <th>Trích yếu</th>
                    <th>Hạn xử lý</th>
                    <th>Trạng thái</th>
                    <th>File</th>
                    <th>Lưu văn bản</th>
                    <th>Cập nhật</th>
                </thead>
                <tbody>
                   <tr v-for="(list, index) in listData.data" :key="list.id">
                       <td>{{ index +1 }}</td>
                        <td>{{ list.so }}</td>
                        <td>{{ list.ngay }}</td>
                        <td>{{ list.trich_yeu }}</td>
                        <td>{{ list.han_xu_ly }}</td>
                        <td :class="trang_thai_color(xuLyTrangThai(list.trang_thai, list.han_xu_ly))">{{ xuLyTrangThai(list.trang_thai, list.han_xu_ly) }}</td>
                        <td v-if="['doc', 'docx', 'xls', 'xlsx'].includes(list.duoi_file)">
                            <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                                <img width="25px" src="/px03/public/images/word-icon.png">
                            </a>
                        </td>
                        <td v-else-if="['pdf'].includes(list.duoi_file)">
                            <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                                <img width="25px" src="/px03/public/images/pdf-icon.png">
                            </a>
                        </td>
                        <td v-else-if="['jpg', 'jpeg', 'png'].includes(list.duoi_file)">
                            <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                                <img width="25px" src="/px03/public/images/img-icon.png">
                            </a>
                        </td>
                        <td v-else-if="(list.file == '') || (list.file == null) "></td>
                        <td v-else>
                            <a :href="`/px03/public/vanbandenupload/${ list.file }`">
                                <img width="25px" src="/px03/public/images/blank-file-icon.png">
                            </a>
                        </td>
                        <td>{{ list.luu_tru }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#capnhattrangthai" @click="getVanBanDenById(list.id)"><i class="far fa-edit"></i></a>
                        </td>
                   </tr>
                </tbody>
            </table>
            <!-- Modal cập nhật trạng thái -->
            <div class="modal fade bd-example-modal-lg" id="capnhattrangthai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cập nhật trạng thái văn bản</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <form style="position:relative" method="post" enctype="multipart/form-data" @submit.prevent="edit">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label>Trạng thái</label>
                                        <select v-model="trang_thai" class="form-control form-control-sm">
                                            <option value="Chưa xử lý">Chưa xử lý</option>
                                            <option value="Đang xử lý">Đang xử lý</option>
                                            <option value="Hoàn thành">Hoàn thành</option>
                                            <option value="Thất bại">Thất bại</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Lưu trữ văn bản</label>
                                        <input type="text" v-model="luu_tru" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3 text-right">
                                        <button class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item" @click.prevent="prev()"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item" :class="{'active': currentPage==page}" @click.prevent="setPage(page)" v-for="page in listData.last_page" :key="page"><a class="page-link" href="#">{{ page }}</a></li>
                    <li class="page-item" @click.prevent="next()"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            listData:'',
            vanBanDenById:'',
            trang_thai:'',
            luu_tru:'',
            id:'',
            currentPage:1,
        }
    },
    methods:{
        trang_thai_color(value){
            switch (value) {
                case 'Chưa xử lý':
                    return "text-warning";
                    break;
                case 'Đang xử lý':
                    return "text-info";
                    break;
                case 'Hoàn thành':
                    return "text-success";
                    break;
                case 'Thất bại':
                    return "text-danger";
                    break;
                case 'Quá hạn':
                    return "text-danger";
                    break;
                default:
                    break;
            }  
        },
        xuLyTrangThai(trangthai, hanxuly){
            let d = new Date();
            let today = new Date(d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate());
            // today = today.getTime(); -> hàm này để chuyển ngày sang miniseconds
            if(hanxuly != undefined) {
                let date = new Date(hanxuly);
                if((['Chưa xử lý', 'Đang xử lý'].includes(trangthai) == true) && (today > date)){
                    return "Quá hạn";
                }
            }
            return trangthai;
        },
        getVanBanDenById(id){
            axios.get('/px03/public/editvanbanden/'+id)
            .then(response=>{
                this.trang_thai = response.data[0].trang_thai;
                this.luu_tru = response.data[0].luu_tru;
                this.id = response.data[0].id;
            })
        },
        edit(){
            let data = new FormData();
            data.append('id', this.id);
            data.append('trang_thai', this.trang_thai);
            data.append('luu_tru', this.luu_tru);
            axios.post('/px03/public/capnhattrangthai', data)
            .then(response=>{
                this.loadData();
            })
        }, 
        loadData(){
            axios.get('/px03/public/chuaxuly?page=' + this.currentPage)
            .then(response=>{
                this.listData = response.data;
                this.$store.dispatch('acLengthBarAlert', response.data.total);
            })
        },
        setPage(newPage){
            this.currentPage = newPage;
            this.loadData();
		},
		prev(){
			if(this.currentPage > 1){
                this.currentPage--;
                this.loadData();
			}
		},
		next(){
			if(this.currentPage < this.last_page){
                this.currentPage++;	
                this.loadData();
			}
		}
    },
    created(){
        this.loadData();
    }

}
</script>

<style>

</style>