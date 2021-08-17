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
                    <th>Cập nhật</th>
                </thead>
                <tbody>
                   <tr v-for="(list, index) in listData" :key="list.id">
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
                        <td>Cập nhật</td>
                   </tr>
                </tbody>
            </table>
            
        </div>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            listData:'',
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
    },
    created(){
        axios.get('/px03/public/vanbanxuly')
        .then(response=>{
            this.listData = response.data.data;
        })
        .catch()
    }

}
</script>

<style>

</style>